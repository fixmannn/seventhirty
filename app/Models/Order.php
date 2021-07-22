<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $attributes = [
        'order_number' => 0,
        'user_id' => 0,
        'amount' => 0,
        'shipping_fee' => 0,
        'shipping_number' => 0
    ];

    protected $fillable = ['order_number', 'user_id', 'amount', 'shipping_fee', 'shipping_number'];
}