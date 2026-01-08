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

public function placeOrder()
{
    $user = auth()->user();

    $cartItems = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $user->id)
        ->select(
            'carts.id',
            'carts.product_id',
            'carts.quantity',
            'products.price'
        )
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.products')
            ->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        $subtotal = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
        $tax = 0;
        $shipping = 200;
        $grandTotal = $subtotal + $tax + $shipping;

        // ✅ INSERT ORDER (ALL REQUIRED FIELDS)
        $orderId = DB::table('orders')->insertGetId([
            'user_id'        => $user->id,
            'order_number'   => 'ORD-' . strtoupper(Str::random(10)),
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            
            'discount'       => 0,
            'total_amount'     => $grandTotal,
            'payment_method' => 'COD',
            'status' => 'pending',
            
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        foreach ($cartItems as $item) {
    DB::table('order_items')->insert([
        'order_id'   => $orderId,
        'product_id' => $item->product_id,
        'quantity'   => $item->quantity,
        'price'      => $item->price,
        'total'      => $item->price * $item->quantity, // ✅ REQUIRED
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


        // ✅ CLEAR CART
        DB::table('carts')
            ->where('user_id', $user->id)
            ->delete();

        DB::commit();

        return redirect()->route('user.products')
            ->with('success', 'Order Placed Successfully!');

    } catch (\Throwable $e) {
        DB::rollBack();

        // 🔴 TEMPORARY DEBUG (REMOVE AFTER TESTING)
        dd($e->getMessage());

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
    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn ($item) =>
            $item->product->price * $item->quantity
        );

        $tax = 0;
        $shipping = 200;
        $grandTotal = $subtotal + $tax + $shipping;

        return view('user.checkout', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'grandTotal'
        ));
    }
    public function ordershow()
    {
        $userId = auth()->id();

        // Fetch logged-in user's orders
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch order items for those orders
        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->whereIn('order_items.order_id', $orders->pluck('id'))
            ->select(
                'order_items.order_id',
                'products.name as product_name',
                'order_items.quantity',
                'order_items.price'
            )
            ->get()
            ->groupBy('order_id');

        return view('user.my orders', compact('orders', 'orderItems'));
    }
}
