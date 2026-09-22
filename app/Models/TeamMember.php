<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role_en',
        'role_id',
        'phone',
        'quote_en',
        'quote_id',
        'description_en',
        'description_id',
        'photo_path',
        'priority'
    ];

    /**
     * Get the translated role.
     */
    public function getRoleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"role_{$locale}"} ?? $this->role_en;
    }

    /**
     * Get the translated quote.
     */
    public function getQuoteAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"quote_{$locale}"} ?? $this->quote_en;
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
