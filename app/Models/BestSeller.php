<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    use HasFactory;

    protected $table = 'best_sellers';

    protected $fillable = [
        'product_id'
    ];

    public $timestamps = false;
}
