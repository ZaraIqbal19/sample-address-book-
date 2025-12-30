<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
        'sub_category_id','name','image','price',
        'sale_start','sale_end','sale_percentage',
        'sale_amount','sku'
    ];
}
