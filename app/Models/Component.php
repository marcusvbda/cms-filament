<?php

namespace App\Models;

use App\Models\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory, HasAttributes;

    protected $fillable = [
        'name'
    ];

    public function _attributes()
    {
        return $this->morphMany(Attribute::class, 'entity');
    }

    public function getEditUrlAttribute()
    {
        $name = $this->name;
        $id = $this->id;
        $url = url("/admin/components/$id/edit");
        return "<a href='$url' target='_blank'>$name</a>";
    }
}
