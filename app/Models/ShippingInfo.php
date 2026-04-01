<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    protected $fillable = [
        'from_amount',
        'to_amount',
        'shipping_charges_tn_py',
        'discount_tn_py',
        'shipping_charges_other',
        'discount_other',
    ];
}
