<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'notes',
        'product_name',
        'product_id',
        'quantity',
        'amount',
        'shipping_amount',
        'shipping_discount',
        'coupon_code',
        'coupon_type',
        'coupon_value',
        'discount_amount',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'shipping_discount' => 'decimal:2',
        'coupon_value' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
