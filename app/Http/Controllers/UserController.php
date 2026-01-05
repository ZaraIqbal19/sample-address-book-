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
    $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.cart')->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();
    try {
        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'subtotal' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'tax' => 0,
            'shipping' => 200,
            'grand_total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 200,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear user cart
        Cart::where('user_id', $user->id)->delete();

        DB::commit();

        return redirect()->route('user.orders')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('user.cart')->with('error', 'Failed to place order: ' . $e->getMessage());
    }
}
public function index()
{
    $bestSellers = Product::whereIn('id', \DB::table('best_sellers')->pluck('product_id'))->get();
    $newArrivals = Product::whereIn('id', \DB::table('new_arrivals')->pluck('product_id'))->get();
    $onSale = Product::whereNotNull('discount_price')->whereColumn('discount_price','<','price')->get();
    $inStock = Product::where('sku', '>', 0)->get();

    return view('user.index', compact('bestSellers','newArrivals','onSale','inStock'));
}

}
