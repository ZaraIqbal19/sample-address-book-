<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\NewArrival;
use App\Models\BestSeller;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;


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
    // selected subcategory (for default selection)
    $subcategory = SubCategory::findOrFail($subcategory_id);

    // fetch ALL subcategories for dropdown
    $subcategories = SubCategory::all();

    return view('Genie.product', compact('subcategory', 'subcategories'));
}

public function productList(Request $request)
{
    // Fetch unique subcategory names for dropdown
    $subcategories = \DB::table('sub_categories')
        ->select('name')
        ->distinct()
        ->orderBy('name')
        ->get();

    // Filter products by selected subcategory name
    $products = Product::with(['subCategory','newArrival','bestSeller'])
        ->when($request->subcategory_name, function($query) use ($request) {
            $query->whereHas('subCategory', function($q) use ($request) {
                $q->where('name', $request->subcategory_name);
            });
        })
        ->get();

    return view('genie.product_info', compact('products','subcategories'));
}



public function toggleNewArrival(Request $request)
{
    $productId = $request->product_id;

    $exists = NewArrival::where('product_id', $productId)->first();

    if ($exists) {
        $exists->delete();
        return response()->json(['status' => 'removed']);
    }

    NewArrival::create(['product_id' => $productId]);
    return response()->json(['status' => 'added']);
}

    public function toggleBestSeller_old(Request $request)
    {
        $productId = $request->product_id;

        $exists = BestSeller::where('product_id', $productId)->first();

        if ($exists) {
            $exists->delete();
            return response()->json(['status' => 'removed']);
        }

        BestSeller::create(['product_id' => $productId]);
        return response()->json(['status' => 'added']);
    }

    public function toggleBestSeller(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $bestSeller = BestSeller::where('product_id', $request->product_id)->first();

        if ($bestSeller) {
            $bestSeller->delete();
            return response()->json(['status' => 'removed']);
        }

        BestSeller::create([
            'product_id' => $request->product_id
        ]);

        return response()->json(['status' => 'added']);
    }
       public function vendorAdd()
    {
        $subcategories = SubCategory::orderBy('name')->get();

        return view('Genie.vendoradd', compact('subcategories'));
    }
    public function vendorStore(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:vendors,email',
            'whatsapp_number'  => 'required|regex:/^[0-9+\s\-]{10,20}$/',
            'subcategory_id'   => 'required|exists:sub_categories,id',
        ]);

        Vendor::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'subcategory_id'  => $request->subcategory_id,
        ]);

        return redirect()->back()->with('success', 'Vendor added successfully');
    }
    public function vendorshow()
{
    $vendors = Vendor::with('subcategory.products')->get();

    return view('Genie.vendorshow', compact('vendors'));
}

public function orders()
{
    // Fetch all orders with user info
    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'orders.id as order_id',
            'orders.order_number',
            'orders.subtotal',
            'orders.discount',
            'orders.tax',
            'orders.total_amount',  // matches migration
            'orders.payment_method',
            'orders.status',        // matches migration
            'orders.created_at',
            'users.name as customer_name',
            'users.email as customer_email'
        )
        ->orderBy('orders.created_at', 'desc')
        ->get();

    // Fetch order items for each order
    $orderItems = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'order_items.order_id',
            'products.name as product_name',
            'order_items.quantity',
            'order_items.price'
        )
        ->get()
        ->groupBy('order_id'); // group items by order

    // Pass orders and their items to the admin view
    return view('genie.orders', compact('orders', 'orderItems'));
}


}
