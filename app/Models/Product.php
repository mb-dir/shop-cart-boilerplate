<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'price', 'name'];

    public function getPhotoAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }

        return asset('images/product-default.jpg'); // Path to your default image
    }
}
