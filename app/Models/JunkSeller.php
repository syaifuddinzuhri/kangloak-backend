<?php

namespace App\Models;

use App\Constant\UploadPathConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class JunkSeller extends Model
{
    protected $fillable = [
        'junk_id',
        'seller_id',
        'seller_address_id',
        'image',
        'description',
        'status'
    ];

    public function setImageAttribute($value)
    {
        if ($value != null) {
            $this->attributes['image'] = UploadPathConstant::JUNK . $value;
        }
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ?  URL::to('/') . '/' . $this->attributes['image'] : null;
    }

    public function junk()
    {
        return $this->belongsTo(Junk::class, 'junk_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function seller_address()
    {
        return $this->belongsTo(SellerAddress::class, 'seller_address_id');
    }
}
