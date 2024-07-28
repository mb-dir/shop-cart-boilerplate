<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'main_street', 'house_number'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
