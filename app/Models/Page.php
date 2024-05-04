<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'blade',
        'is_published',
        'meta',
        'attrs'
    ];

    public function getProcessedAttributes()
    {
        return  (object)collect($this->pageAttributes->map(function ($row) {
            $type = match ($row->type) {
                'text' => 'text',
                'editor' => 'text',
                default => $row->type,
            };
            $index = $type . "Value";
            $value = $row->{$index};
            if (in_array($type, ['file', 'image'])) {
                $value = Storage::url($value);
            }

            if (in_array($type, ['repeater'])) {
                $value = collect($row->repeaterValue)->pluck($row->repeaterType . "Value")->toArray();
                if (in_array($row->repeaterType, ['file', 'image'])) {
                    $value = collect($value)->map(function ($item) {
                        return Storage::url($item);
                    })->toArray();
                }
            }
            return ['key' => $row->key, 'value' => $value];
        }))->pluck('value', 'key')->toArray();
    }

    public function pageAttributes()
    {
        return $this->hasMany(PageAttribute::class);
    }
}
