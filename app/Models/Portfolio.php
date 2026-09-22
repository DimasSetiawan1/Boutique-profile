<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_id',
        'category_en',
        'category_id',
        'image_path',
        'description_en',
        'description_id'
    ];

    /**
     * Get the translated title.
     */
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_en;
    }

    /**
     * Get the translated category.
     */
    public function getCategoryAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"category_{$locale}"} ?? $this->category_en;
    }

    /**
     * Get the translated description.
     */
    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_en;
    }
}
