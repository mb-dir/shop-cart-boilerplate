<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // change kurwa paymentType and deliveryType
    protected $fillable = ['user_id', 'cart_id', 'delivery_address_id', 'paymentType', 'deliveryType', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function deliveryAddress()
    {
        return $this->hasMany(DeliveryAddress::class);
    }
}
