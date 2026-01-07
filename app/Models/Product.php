<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'price'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
