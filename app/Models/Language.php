<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'flag',
        'items',
    ];

    public $casts = [
        'flag' => 'json',
        'items' => 'json',
    ];

    public static function __($key)
    {
        try {
            $locale = app()->getLocale();
            if (!$locale) return $key;
            $qtyLanguage = self::count();
            if ($qtyLanguage === 1) {
                $language = self::first();
            } else {
                if ($qtyLanguage === 0) return $key;
                $language = self::where('code', $locale)->first();
            }
            $item = current(array_filter($language->items, function ($item) use ($key) {
                return $item['key'] == $key;
            }));
            return data_get($item, 'value', $key);
        } catch (\Exception $e) {
            return $key;
        }
    }
}
