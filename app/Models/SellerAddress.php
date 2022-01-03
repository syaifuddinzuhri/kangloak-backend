<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerAddress extends Model
{
    protected $fillable = [
        'district',
        'city',
        'provincy',
        'postal_code',
        'address',
        'seller_id'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
