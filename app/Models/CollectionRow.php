<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'source',
        'collection_id'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
