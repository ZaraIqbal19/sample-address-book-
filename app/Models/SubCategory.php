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

}
