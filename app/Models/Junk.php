<?php

namespace App\Models;

use App\Constant\UploadPathConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;

class Junk extends Model
{
    protected $fillable = [
        'junk_category_id',
        'name',
        'photo',
        'weight',
        'price'
    ];

    public function setPhotoAttribute($value)
    {
        if ($value != null) {
            $this->attributes['photo'] = UploadPathConstant::JUNK . $value;
        }
    }

    public function getPhotoAttribute()
    {
        return $this->attributes['photo'] ?  URL::to('/') . '/' . $this->attributes['photo'] : null;
    }

    public function junk_category(): BelongsTo
    {
        return $this->belongsTo(JunkCategory::class, 'junk_category_id');
    }
}
