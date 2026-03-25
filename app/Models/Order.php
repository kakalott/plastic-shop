<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'customer_name', 'customer_phone', 'shipping_address', 'notes', 'payment_method', 'total_amount', 'status'];

    // 1 Đơn hàng sẽ có NHIỀU (hasMany) Chi tiết đơn hàng
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}