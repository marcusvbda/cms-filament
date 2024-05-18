<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'columns',
        'webhook'
    ];

    public $casts = [
        'columns' => 'array'
    ];

    public function rows()
    {
        return $this->hasMany(CollectionRow::class);
    }
}
