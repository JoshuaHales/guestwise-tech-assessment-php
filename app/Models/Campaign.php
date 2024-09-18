<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function impressions()
    {
        return $this->hasMany(Impression::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function conversions()
    {
        return $this->hasMany(Conversion::class);
    }
}
