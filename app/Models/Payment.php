<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constant\UploadPathConstant;
use Illuminate\Support\Facades\URL;

class Payment extends Model
{
    protected $fillable = [
        'buyer_id',
        'payment_account_id',
        'nominal_fee',
        'nominal',
        'nominal_pay',
        'status',
        'uniq_num',
        'no_trx',
        'date',
        'payment_slip'
    ];

    public function setPaymentSlipAttribute($value)
    {
        if ($value != null) {
            $this->attributes['payment_slip'] = UploadPathConstant::PAYMENT_SLIP . $value;
        }
    }

    public function getPaymentSlipAttribute()
    {
        return $this->attributes['payment_slip'] ?  URL::to('/') . '/' . $this->attributes['payment_slip'] : null;
    }

    public function payment_account()
    {
        return $this->belongsTo(PaymentAccount::class, 'payment_account_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
}
