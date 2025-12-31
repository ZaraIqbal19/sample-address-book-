<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    protected $table = 'best_sellers';
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
