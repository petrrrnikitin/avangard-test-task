<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUSES = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завершен',
    ];

    const COMPLETED_STATUS = 20;

    protected $fillable = ['client_email', 'partner_id', 'status'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getStatusNameAttribute(): string
    {
        return self::STATUSES[$this->status];
    }

    public function getOrderCostAttribute()
    {
        $cost = 0;
        foreach ($this->orderProducts as $orderProduct) {
            $cost += $orderProduct->price * $orderProduct->quantity;
        }

        return "$cost руб.";
    }

    public function getOrderListAttribute(): string
    {
        $list = [];
        foreach ($this->orderProducts as $orderProduct) {
            $list[] = $orderProduct->product->name;
        }

        return implode(", ", $list);
    }
}
