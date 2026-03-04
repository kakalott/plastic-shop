<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'customer_id', 'total_amount', 'status', 
        'payment_method', 'shipping_address', 'order_channel', 
        'shipping_method', 'discount_amount'
    ];

    // 1 Đơn hàng sẽ có NHIỀU Chi tiết đơn hàng (Mối quan hệ 1-N)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}