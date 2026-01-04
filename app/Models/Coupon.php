<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'expiry_date',
        'is_active',
    ];

    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expiry_date && Carbon::now()->gt($this->expiry_date)) {
            return false;
        }

        return true;
    }
}
