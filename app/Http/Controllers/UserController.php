<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Cart;
use App\Models\GenieNotification;
use App\Models\Vendor;
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
}
