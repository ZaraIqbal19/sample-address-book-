<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
   protected $fillable = ['category_id', 'name', 'image'];
   public function vendors()
{
    return $this->hasMany(Vendor::class);
}

    public function products()
    {
        return $this->hasMany(Product::class,'sub_category_id');
    }
}
