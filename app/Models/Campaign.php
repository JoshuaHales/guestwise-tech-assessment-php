<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
    ];

    /**
     * Get the brand associated with the campaign.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the impressions associated with the campaign.
     */
    public function impressions()
    {
        return $this->hasMany(Impression::class);
    }

    /**
     * Get the interactions associated with the campaign.
     */
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    /**
     * Get the conversions associated with the campaign.
     */
    public function conversions()
    {
        return $this->hasMany(Conversion::class);
    }
}