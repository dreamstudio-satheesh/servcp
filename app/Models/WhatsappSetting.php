<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getSetting($key)
    {
        $value = config("whatsapp.$key");
        if ($value) {
            return $value; // Use .env value if available
        }

        // Fallback to database
        return self::where('key', $key)->value('value');
    }
}
