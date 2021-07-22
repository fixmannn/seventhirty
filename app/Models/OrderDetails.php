<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = ['order_number', 'product_id', 'quantity', 'size', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
