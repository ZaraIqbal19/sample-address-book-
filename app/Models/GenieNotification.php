<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenieNotification extends Model
{
    protected $fillable = [
        'user_id','product_id','requested_qty','available_qty','status'
    ];
}
