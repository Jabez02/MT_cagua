<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'value',
        'type',
        'group',
        'is_public',
        'mime_type'
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Get all settings as key-value pairs
     *
     * @param string|null $group
     * @param bool $publicOnly
     * @return array
     */
    public static function getAllSettings(string $group = null, bool $publicOnly = true)
    {
        $query = self::query();
        
        if ($group) {
            $query->where('group', $group);
        }
        
        if ($publicOnly) {
            $query->where('is_public', true);
        }
        
        return $query->get()->pluck('value', 'key')->toArray();
    }
}
