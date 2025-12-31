<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\NewArrival;
use App\Models\BestSeller;
class UserController extends Controller
{
public function userProducts(Request $request)
{
    // ✅ Fetch UNIQUE subcategories (no duplicates)
    $subcategories = SubCategory::select('name')
        ->distinct()
        ->orderBy('name')
        ->get();

    // ✅ Fetch products (filter by subcategory name if selected)
    $products = Product::with('subCategory')
        ->when($request->subcategory_name, function ($query) use ($request) {
            $query->whereHas('subCategory', function ($q) use ($request) {
                $q->where('name', $request->subcategory_name);
            });
        })
        ->get();

    return view('user.products', compact('products', 'subcategories'));
}




}
