<x-mail::message>
# Order Confirmation

Hello **{{ $order->customer_name }}**,

Thank you for choosing **{{ config('app.name') }}**. Your order **#{{ $order->order_number }}** has been successfully placed and is currently being prepared for shipment.

<x-mail::panel>
**Order Summary**
* **Order Date:** {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
* **Order Total:** ₹{{ number_format($order->amount, 2) }}
* **Status:** {{ ucfirst($order->status) }}
</x-mail::panel>

## Items Ordered
| Product | Qty | Price | Total |
| :--- | :---: | :---: | :---: |
@foreach($order->items as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | ₹{{ number_format($item->unit_price, 2) }} | ₹{{ number_format($item->line_total, 2) }} |
@endforeach
| | | **Subtotal** | ₹{{ number_format($order->amount - $order->shipping_amount + $order->shipping_discount + $order->discount_amount, 2) }} |
@if($order->discount_amount > 0)
| | | **Coupon Discount** | -₹{{ number_format($order->discount_amount, 2) }} |
@endif
| | | **Shipping** | {{ $order->shipping_amount - $order->shipping_discount > 0 ? '₹'.number_format($order->shipping_amount - $order->shipping_discount, 2) : 'FREE' }} |
| | | **Grand Total** | **₹{{ number_format($order->amount, 2) }}** |

## Shipping Details
**{{ $order->customer_name }}**
{{ $order->address_line1 }}
{{ $order->address_line2 ? $order->address_line2 . ',' : '' }}
{{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
{{ $order->country }}
Phone: {{ $order->phone }}

<x-mail::button :url="url('/orders/' . $order->order_number)">
Track Your Order
</x-mail::button>

If you have any questions, feel free to contact us at [care@Auvri Plusalchemist.com](mailto:care@Auvri Plusalchemist.com) or WhatsApp us at [0794851800](https://wa.me/0794851800).

Best Regards,<br>
**Team {{ config('app.name') }}**
</x-mail::message>
