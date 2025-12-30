<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class GenieController extends Controller
{
 public function showRegisterForm() {
        return view('auth.register'); 
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
    User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => 'user',
    ]);
       return redirect()->route('user.index')
    ->with('success', 'User registered successfully!');
    }
        // Show users list (non-admin users only)
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('Genie.user', compact('users'));
    }

    // Update role via AJAX
    public function updateUserRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string'
        ]);

        $user = User::find($request->user_id);
        $user->role = $request->role;
        $user->save();

        return response()->json(['success' => true]);
    }

    // Delete user via AJAX
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }
    public function categoryForm()
{
    return view('genie.category');
}

public function saveCategory(Request $request)
{
    $request->validate([
        'name' => 'required'
    ]);

    // Save category
    $category = Category::create([
        'name' => $request->name
    ]);

    // ✅ Redirect to subcategory form for this category
    return redirect()->route('genie.subcategory.create', $category->id)
                     ->with('success', 'Category added successfully. Now add subcategories.');
}

public function storeSubCategory(Request $request)
{
    $file = $request->file('image');
    $filename = $file->getClientOriginalName();
    $file->move(public_path('subcategories'),$filename);

    $subcategory = SubCategory::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'image' => $filename
    ]);

    return redirect()->route('genie.product.form', $subcategory->id);
}
public function create($category_id)
{
    return view('genie.subcategory', compact('category_id'));
}
public function storeProduct(Request $request)
{
    $file = $request->file('image');
    $filename = $file->getClientOriginalName();
    $file->move(public_path('products'),$filename);

    Product::create([
        'sub_category_id' => $request->sub_category_id,
        'name' => $request->name,
        'image' => $filename,
        'price' => $request->price,
        'sale_start' => $request->sale_start,
        'sale_end' => $request->sale_end,
        'sale_percentage' => $request->sale_percentage,
        'sale_amount' => $request->sale_amount,
        'sku' => $request->sku
    ]);

    return back()->with('success','Product added');
}
public function productForm($subcategory_id)
{
    // Fetch the subcategory from DB
    $subcategory = SubCategory::findOrFail($subcategory_id);

    // Pass it to the view
    return view('Genie.product', compact('subcategory'));
}

}
