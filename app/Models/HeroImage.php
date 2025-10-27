<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'mime_type',
        'is_active'
    ];

    /**
     * Get the active hero image
     * 
     * @return HeroImage|null
     */
    public static function getActive()
    {
        return self::where('is_active', true)->latest()->first();
    }
}
