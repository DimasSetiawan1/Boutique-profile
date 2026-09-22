<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'products', 'logo_width', 'logo_height'];

    public function productImages()
    {
        return $this->hasMany(ClientProduct::class);
    }
}
