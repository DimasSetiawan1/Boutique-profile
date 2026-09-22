<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Philosophy extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title_en',
        'title_id',
        'subtitle_en',
        'subtitle_id',
        'icon',
        'image_path',
        'description_en',
        'description_id',
        'is_highlighted',
        'sort_order',
    ];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'sort_order' => 'integer',
    ];
}
