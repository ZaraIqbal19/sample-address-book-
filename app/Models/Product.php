<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewArrival;
use App\Models\BestSeller;
use App\Models\SubCategory;
use App\Models\OrderItem;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class Product extends Model
{
    
    protected $fillable = [
        'sub_category_id','name','image','description','price','sale_start','sale_end','sale_percentage','sale_amount','sku'
    ];
    // New Arrival relation
    public function newArrival()
    {
        return $this->hasOne(NewArrival::class, 'product_id');
    }
    // Best Seller relation
    public function bestSeller()
    {
        return $this->hasOne(BestSeller::class, 'product_id');
    }
    // Sub Category relation
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function getNew_ArrivalAttribute()
    {
        return $this->newArrival;
    }
    public function getBest_SellerAttribute()
    {
        return $this->bestSeller;
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

public function isInWishlist()
{
    $user = Auth::user();
    if(!$user) return false; // Guest users can't have a wishlist

    return \App\Models\Wishlist::where('user_id', $user->id)
                               ->where('product_id', $this->id)
                               ->exists();
}
}
