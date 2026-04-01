<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CouponUsage;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'starts_at',
        'ends_at',
        'usage_limit',
        'usage_count',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'usage_limit' => 'integer',
        'usage_count' => 'integer',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_product');
    }

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function alreadyUsedBy(User $user): bool
    {
        return $this->usages()->where('user_id', $user->id)->exists();
    }

    public function validationError(float $subtotal, array $cart = []): ?string
    {
        if (!$this->is_active) {
            return 'This coupon is inactive.';
        }

        if ($this->starts_at && $this->starts_at->isFuture()) {
            return 'This coupon is not active yet.';
        }

        if ($this->ends_at && $this->ends_at->isPast()) {
            return 'This coupon has expired.';
        }

        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return 'This coupon has reached its usage limit.';
        }

        // Check if coupon is product-specific
        $eligibleProductIds = $this->products()->pluck('products.id')->toArray();

        if (!empty($eligibleProductIds)) {
            $cartProductIds = collect($cart)->pluck('product_id')->toArray();
            $missingProducts = [];
            
            foreach ($eligibleProductIds as $id) {
                if (!in_array($id, $cartProductIds)) {
                    $missingProducts[] = Product::find($id)->name ?? 'Unknown Product';
                }
            }

            if (!empty($missingProducts)) {
                return 'This coupon requires the following products to be in your cart: ' . implode(', ', $missingProducts);
            }

            // Check if there are any products in the cart that are NOT part of the coupon
            $extraneousProducts = [];
            foreach ($cart as $item) {
                if (!in_array($item['product_id'], $eligibleProductIds)) {
                    $extraneousProducts[] = $item['name'];
                }
            }

            if (!empty($extraneousProducts)) {
                return 'This coupon can only be applied when your cart contains ONLY the specific products it was created for. Please remove: ' . implode(', ', $extraneousProducts);
            }

            $eligibleSubtotal = 0;
            foreach ($cart as $item) {
                if (in_array($item['product_id'], $eligibleProductIds)) {
                    $eligibleSubtotal += $item['price'] * $item['quantity'];
                }
            }

            // Minimum amount check for product-specific coupons usually applies to the eligible subtotal
            if ($this->minimum_amount && $eligibleSubtotal < $this->minimum_amount) {
                return 'Eligible products in your cart do not meet the minimum amount for this coupon.';
            }
        } elseif ($this->minimum_amount && $subtotal < $this->minimum_amount) {
            return 'This coupon requires a higher order subtotal.';
        }

        return null;
    }

    public function isValidForSubtotal(float $subtotal, array $cart = []): bool
    {
        return $this->validationError($subtotal, $cart) === null;
    }

    public function discountFor(float $subtotal, array $cart = []): float
    {
        if ($subtotal <= 0) {
            return 0.0;
        }

        $baseAmount = $subtotal;

        // If product specific, only apply to those products
        $eligibleProductIds = $this->products()->pluck('products.id')->toArray();

        if (!empty($eligibleProductIds)) {
            $baseAmount = 0;
            foreach ($cart as $item) {
                if (in_array($item['product_id'], $eligibleProductIds)) {
                    $baseAmount += $item['price'] * $item['quantity'];
                }
            }
        }

        if ($baseAmount <= 0) {
            return 0.0;
        }

        $value = (float) $this->value;
        $discount = $this->type === 'percent'
            ? ($baseAmount * ($value / 100))
            : $value;

        if ($this->maximum_discount && $discount > $this->maximum_discount) {
            $discount = (float) $this->maximum_discount;
        }

        return min($discount, $subtotal);
    }
}
