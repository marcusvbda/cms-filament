<?php

namespace App\Helpers;

class BladeTranslator
{
    public static function __($key)
    {
        try {
            $locale = app()->getLocale();
            $dir = resource_path("views/lang/$locale.json");
            $translations = json_decode(file_get_contents($dir), true);
            return $translations[$key] ?? $key;
        } catch (\Exception $e) {
            return $key;
        }
    }
}
