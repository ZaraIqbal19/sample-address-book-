<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    protected $table = 'new_arrivals'; // matches your migration table
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
