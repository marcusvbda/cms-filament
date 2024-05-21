<?php

namespace App\Models\Traits;

use App\Models\Attribute;
use App\Models\Component;
use Storage;

trait HasAttributes
{
    public function getProcessedAttributes()
    {
        return (object)collect($this->_attributes)->map(function ($row) {
            $type = match ($row->type) {
                'text', 'editor' => 'text',
                default => $row->type,
            };

            $index = $type . "Value";
            $value = $row->{$index};

            if (in_array($type, ['file', 'image'])) {
                $value = (object) [
                    'url' =>  Storage::url($value),
                    'meta' => (object)$row->metaValue,
                ];
            }

            if ($type === 'repeater') {
                $value = collect($row->repeaterValue)->map(function ($repeater) use ($row) {
                    if (in_array($row->repeaterType, ['file', 'image'])) {
                        return (object) [
                            'url' =>  Storage::url($repeater[$row->repeaterType . "Value"]),
                            'meta' => (object)$repeater["metaValue"],
                        ];
                    }
                    return $repeater[$row->repeaterType . "Value"];
                })->toArray();
            }

            if ($type === 'component') {
                $component = Component::find($row->componentValue);
                return [
                    'key' => $row->key,
                    'value' => $component->getProcessedAttributes(),
                ];
            }

            return ['key' => $row->key, 'value' => $value];
        })->pluck('value', 'key')->toArray();
    }

    public function _attributes()
    {
        return $this->morphMany(Attribute::class, 'entity');
    }
}
