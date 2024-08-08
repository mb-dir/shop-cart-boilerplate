<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cart_id', 'payment_type_id', 'delivery_type_id', 'phone', 'city', 'main_street', 'house_number', 'status_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function delivery()
    {
        return $this->hasOne(DeliveryType::class);
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function payment()
    {
        return $this->hasOne(PaymentType::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            $order->cart->makeInactive();
        });
    }
}
