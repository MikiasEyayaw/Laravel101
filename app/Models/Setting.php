<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        return match($setting->type) {
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'number' => is_numeric($setting->value) ? (float) $setting->value : $default,
            default => $setting->value,
        };
    }

    /**
     * Set a setting value by key
     */
    public static function set(string $key, $value, string $type = 'text', string $description = null): void
    {
        $stringValue = match($type) {
            'boolean' => $value ? 'true' : 'false',
            'number' => (string) $value,
            default => (string) $value,
        };

        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $stringValue,
                'type' => $type,
                'description' => $description,
            ]
        );
    }
}
