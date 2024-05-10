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
        'description',
        'type',
        'slug',
        'is_published',
        'meta',
        'attrs'
    ];

    public function getProcessedAttributes()
    {
        $appUrl = config("app.url");
        return (object)collect($this->pageAttributes)->map(function ($row) use ($appUrl) {
            $type = match ($row->type) {
                'text', 'editor' => 'text',
                default => $row->type,
            };

            $index = $type . "Value";
            $value = $row->{$index};

            if (in_array($type, ['file', 'image'])) {
                $value = (object) [
                    'url' => $appUrl . Storage::url($value),
                    'meta' => (object)$row->metaValue,
                ];
            }

            if ($type === 'repeater') {
                $value = collect($row->repeaterValue)->map(function ($repeater) use ($row, $appUrl) {
                    if (in_array($row->repeaterType, ['file', 'image'])) {
                        return (object) [
                            'url' => $appUrl . Storage::url($repeater[$row->repeaterType . "Value"]),
                            'meta' => (object)$repeater["metaValue"],
                        ];
                    }
                    return $repeater[$row->repeaterType . "Value"];
                })->toArray();
            }

            return ['key' => $row->key, 'value' => $value];
        })->pluck('value', 'key')->toArray();
    }


    public function pageAttributes()
    {
        return $this->hasMany(PageAttribute::class);
    }
}
