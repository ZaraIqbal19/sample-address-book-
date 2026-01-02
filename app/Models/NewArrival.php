<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    use HasFactory;

    protected $table = 'new_arrivals';

    protected $fillable = [
        'product_id'
    ];

    public $timestamps = false;
}
