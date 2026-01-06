<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Cart;
use App\Models\GenieNotification;
use App\Models\Vendor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function userProducts(Request $request)
    {
        $subcategories = SubCategory::select('name')
            ->distinct()
            ->orderBy('name')
            ->get();

        $products = Product::with('subCategory')
            ->when($request->subcategory_name, function ($query) use ($request) {
                $query->whereHas('subCategory', function ($q) use ($request) {
                    $q->where('name', $request->subcategory_name);
                });
            })
            ->get(); // Fetch all columns

        return view('user.products', compact('products', 'subcategories'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $requestedQty = (int)$request->quantity;
        $availableQty = $product->sku;

        $addQty = min($requestedQty, $availableQty);

        Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ],
            ['quantity' => $addQty]
        );

        $remainingQty = max(0, $requestedQty - $availableQty);

        if ($remainingQty > 0) {
            GenieNotification::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'requested_qty' => $requestedQty,
                'available_qty' => $availableQty,
            ]);
        }

        return response()->json([
            'added_qty' => $addQty,
            'remaining_qty' => $remainingQty
        ]);
    }

    public function increaseCart(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $request->product_id)
                    ->firstOrFail();

        $product = $cart->product;
        $cart->quantity += 1;
        $cart->save();

        $remainingQty = max(0, $cart->quantity - $product->sku);

        if ($remainingQty > 0) {
            GenieNotification::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'requested_qty' => $cart->quantity,
                'available_qty' => $product->sku,
            ]);
        }

        return response()->json([
            'added_qty' => min($cart->quantity, $product->sku),
            'remaining_qty' => $remainingQty
        ]);
    }

    public function decreaseCart(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $request->product_id)
                    ->firstOrFail();

        if ($cart->quantity <= 1) {
            $cart->delete();
            return response()->json(['added_qty' => 0, 'remaining_qty' => 0]);
        }

        $cart->quantity -= 1;
        $cart->save();

        $product = $cart->product;
        $remainingQty = max(0, $cart->quantity - $product->sku);

        return response()->json([
            'added_qty' => $cart->quantity,
            'remaining_qty' => $remainingQty
        ]);
    }

    public function removeFromCart(Request $request)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['removed' => true]);
    }

    public function productDescription(Product $product)
    {
        return view('user.product-description', compact('product'));
    }
public function toggleWishlist(Request $request)
{
    $user = Auth::user();
    if(!$user) {
        return response()->json(['added' => false, 'message' => 'Login required'], 401);
    }

    $product_id = $request->product_id;

    $wishlistItem = Wishlist::where('user_id', $user->id)
                            ->where('product_id', $product_id)
                            ->first();

    if($wishlistItem){
        // Remove from wishlist
        $wishlistItem->delete();
        return response()->json(['added' => false]);
    } else {
        // Add to wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product_id,
        ]);
        return response()->json(['added' => true]);
    }
}
public function cart()
{
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    return view('user.cart', compact('cartItems'));
}
// Update quantity
public function updateCart(Request $request){
    $cart = Cart::find($request->cart_id);
    if($cart){
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json(['success'=>true]);
    }
    return response()->json(['success'=>false], 404);
}

// Remove cart item
public function removeCart(Request $request){
    $cart = Cart::find($request->cart_id);
    if($cart){
        $cart->delete();
        return response()->json(['success'=>true]);
    }
    return response()->json(['success'=>false], 404);
}

public function checkout()
{
    $cartItems = Cart::with('product')
                     ->where('user_id', auth()->id())
                     ->get();

    if($cartItems->isEmpty()){
        return redirect()->route('user.cart')->with('error', 'Your cart is empty.');
    }

    $subtotal = $cartItems->sum(function($item){
        return $item->product->price * $item->quantity;
    });

    $tax = 0;
    $shipping = 200;
    $grandTotal = $subtotal + $tax + $shipping;

    return view('user.checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'grandTotal'));
}

public function placeOrder()
{
    $user = auth()->user();

    // Fetch cart items
    $cartItems = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $user->id)
        ->select('carts.id', 'carts.product_id', 'carts.quantity', 'products.price')
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.products')
            ->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        $subtotal = $cartItems->sum(fn ($item) => $item->price * $item->quantity);

        // Insert order
        $orderId = DB::table('orders')->insertGetId([
            'user_id'        => $user->id,
            'order_number'   => 'ORD-' . strtoupper(Str::random(10)),
            'subtotal'       => $subtotal,
            'discount'       => 0,
            'tax'            => 0,
            'grandTotal'     => $subtotal, // your column name in migration
            'payment_method' => 'COD',
            'order_status'   => 'pending', // match your migration
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Insert order items
        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id'   => $orderId,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Delete cart items by IDs
        $cartIds = $cartItems->pluck('id')->toArray();
        DB::table('carts')->whereIn('id', $cartIds)->delete();

        DB::commit();

        // ✅ Redirect to GET route properly
        return redirect()->route('user.products')
            ->with('success', 'Order Placed Successfully!');

    } catch (\Throwable $e) {
        DB::rollBack();

        return redirect()->back()
            ->with('error', 'Something went wrong while placing order.');
    }
}


public function index()
{
    $bestSellers = Product::whereIn('id', \DB::table('best_sellers')->pluck('product_id'))->get();
    $newArrivals = Product::whereIn('id', \DB::table('new_arrivals')->pluck('product_id'))->get();
    $onSale = Product::whereNotNull('discounted_price')->whereColumn('discounted_price','<','price')->get();
    $inStock = Product::where('sku', '>', 0)->get();

    return view('user.index', compact('bestSellers','newArrivals','onSale','inStock'));
}
 public function showContactForm()
    {
        return view('User.contact');
    }

    // Handle form submission
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database using DB facade
        DB::table('contacts')->insert([
            'name'      => $request->name,
            'email'     => $request->email,
            'subject'   => $request->subject,
            'message'   => $request->message,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
