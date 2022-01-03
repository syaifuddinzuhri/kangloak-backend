<?php

namespace App\Models;

use App\Constant\UploadPathConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class PaymentAccount extends Model
{
    protected $fillable = [
        'name',
        'code',
        'account_name',
        'account_number',
        'status',
        'qr_code',
        'logo',
    ];

    public function setQrCodeAttribute($value)
    {
        if ($value != null) {
            $this->attributes['qr_code'] = UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_QR_CODE . $value;
        }
    }

    public function getQrCodeAttribute()
    {
        return $this->attributes['qr_code'] ?  URL::to('/') . '/' . $this->attributes['qr_code'] : null;
    }

    public function setLogoAttribute($value)
    {
        if ($value != null) {
            $this->attributes['logo'] = UploadPathConstant::PAYMENT_ACCOUNT_IMAGE_LOGO . $value;
        }
    }

    public function getLogoAttribute()
    {
        return $this->attributes['logo'] ?  URL::to('/') . '/' . $this->attributes['logo'] : null;
    }
}
