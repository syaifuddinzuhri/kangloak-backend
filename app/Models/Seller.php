<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;
use App\Constant\UploadPathConstant;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'phone',
        'balance',
        'address',
        'date_of_birth',
        'ktp',
        'firebase_uid',
        'google_pic',
        'is_verify',
        'is_banned',
        'banned_at',
        'verify_at',
        'is_verify_ktp',
        'is_verify_selfie_ktp',
        'selfie_ktp'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

        /**
     * Hash the password on save/update.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setKtpAttribute($value)
    {
        if ($value != null) {
            $this->attributes['ktp'] = UploadPathConstant::KTP . $value;
        }
    }

    public function getKtpAttribute()
    {
        return $this->attributes['ktp'] ?  URL::to('/') . '/' . $this->attributes['ktp'] : null;
    }

    public function setSelfieKtpAttribute($value)
    {
        if ($value != null) {
            $this->attributes['selfie_ktp'] = UploadPathConstant::SELFIE_KTP . $value;
        }
    }

    public function getSelfieKtpAttribute()
    {
        return $this->attributes['selfie_ktp'] ?  URL::to('/') . '/' . $this->attributes['selfie_ktp'] : null;
    }
}
