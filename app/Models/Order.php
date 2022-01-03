<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'buyer_id',
        'junk_seller_id',
        'weight',
        'status',
        'total'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function junk_seller()
    {
        return $this->belongsTo(JunkSeller::class, 'junk_seller_id');
    }
}
