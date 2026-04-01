<x-mail::message>
# New Order Alert!

A new order **#{{ $order->order_number }}** has been received from **{{ $order->customer_name }}**.

<x-mail::panel>
**Status:** {{ ucfirst($order->status) }}
**Amount:** ₹{{ number_format($order->amount, 2) }}
**Date:** {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
</x-mail::panel>

## Customer Information
* **Email:** {{ $order->customer_email }}
* **Phone:** {{ $order->phone }}
* **Payment Status:** {{ ucfirst($order->payment_status) }}
* **Shipping Address:** 
  {{ $order->address_line1 }}
  {{ $order->address_line2 ? $order->address_line2 . ',' : '' }}
  {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}
  {{ $order->country }}

## Items Ordered
| Product | Qty | Price | Total |
| :--- | :---: | :---: | :---: |
@foreach($order->items as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | ₹{{ number_format($item->unit_price, 2) }} | ₹{{ number_format($item->line_total, 2) }} |
@endforeach

<x-mail::button :url="url('/admin/orders/' . $order->id)">
Manage Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
