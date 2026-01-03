<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
        protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp_number',
        'subcategory_id'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
