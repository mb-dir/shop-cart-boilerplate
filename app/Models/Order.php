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

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
