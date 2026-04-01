@extends('layouts.auri')

@section('title', 'Secure Checkout | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        .btn-complete-order {
            width: 100%;
            padding: 18px 10px;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            white-space: nowrap;
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')
    <!-- Page Title / Hero -->
    <section class="hero-small" style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
        <div class="hero-overlay"></div>
        <div class="container">
            <h1>Checkout</h1>
            <p>Complete your purchase and begin your spiritual path.</p>
        </div>
    </section>

    <section class="checkout-section">
        <div class="checkout-container">

            <div class="checkout-layout">
                <!-- Delivery Information -->
                <div class="checkout-card">
                    <h3 class="checkout-title">
                        <i class="fas fa-shipping-fast"></i> Delivery Information
                    </h3>

                    @if ($errors->any())
                        <div
                            style="margin-bottom: 25px; background: #fff5f5; border-left: 4px solid #f44336; color: #d32f2f; padding: 15px 20px; border-radius: 8px;">
                            <strong>Please correct the following errors:</strong>
                            <ul style="margin: 10px 0 0 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div class="form-group-grid">
                            <div>
                                <label class="form-label">Full Name <span style="color: red;">*</span></label>
                                <input type="text" value="{{ $user->name }}" disabled class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Email Address <span style="color: red;">*</span></label>
                                <input type="email" value="{{ $user->email }}" disabled class="form-control">
                            </div>
                        </div>

                        <div
                            style="margin: 5px 0 20px 0; background: #fdf2f2; border: 1px dashed #f8bbd0; padding: 12px 15px; border-radius: 12px; display: flex; align-items: center; gap: 12px;">
                            <input type="checkbox" id="use_stored_address"
                                style="width: 20px; height: 20px; cursor: pointer; accent-color: #c2185b;">
                            <label for="use_stored_address"
                                style="font-size: 14px; font-weight: 700; color: #c2185b; cursor: pointer; margin: 0;">
                                <i class="fas fa-home"></i> Use my previously stored shipping address
                            </label>
                        </div>

                        <div class="form-group-grid">
                            <div>
                                <label class="form-label">Phone Number <span style="color: red;">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                    placeholder="e.g. 9876543210" class="form-control" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div>
                                <label class="form-label">Country <span style="color: red;">*</span></label>
                                <input type="text" name="country" id="country" value="{{ old('country', 'India') }}"
                                    required class="form-control"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label class="form-label">Shipping Address <span style="color: red;">*</span></label>
                            <input type="text" name="address_line1" id="address_line1" value="{{ old('address_line1') }}"
                                required placeholder="Street address, P.O. box, company name" class="form-control"
                                style="margin-bottom: 12px;">
                            <input type="text" name="address_line2" id="address_line2"
                                value="{{ old('address_line2') }}"
                                placeholder="Apartment, suite, unit, building, floor, etc. (optional)" class="form-control">
                        </div>

                        <div class="form-group-grid three-col">
                            <div>
                                <label class="form-label">City <span style="color: red;">*</span></label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                    class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                            <div>
                                <label class="form-label">State<span style="color: red;">*</span></label>
                                <input type="text" name="state" id="state" value="{{ old('state') }}" required
                                    class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                            <div>
                                <label class="form-label">Postal Code <span style="color: red;">*</span></label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                    required class="form-control" maxlength="6"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>

                        <div style="margin-top: 25px;">
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea name="notes" rows="3" placeholder="Notes about your order, e.g. special instructions for delivery."
                                class="form-control" style="resize: none;">{{ old('notes') }}</textarea>
                        </div>

                        <div style="margin: 20px 0; display: flex; align-items: center; gap: 10px;">
                            <input type="checkbox" name="save_address" id="save_address" value="1"
                                style="width: 18px; height: 18px; cursor: pointer;">
                            <label for="save_address"
                                style="font-size: 14px; color: #555; cursor: pointer; margin: 0;">Save this shipping
                                address for future use</label>
                        </div>

                        <button type="submit" class="btn-premium btn-complete-order">
                            PLACE ORDER NOW <i class="fas fa-check-circle"></i>
                        </button>

                        <p style="text-align: center; margin-top: 20px; color: #888; font-size: 13px;">
                            <i class="fas fa-lock"></i> Your transaction is secure and encrypted.
                        </p>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="summary-card">
                    <h3 class="summary-title">
                        <i class="fas fa-shopping-bag"></i> Order Summary
                    </h3>

                    <!-- Cart Items Mini -->
                    <div style="margin-bottom: 20px;">
                        @foreach ($cart as $item)
                            <div class="checkout-item-row"
                                style="display: flex; gap: 15px; align-items: center; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
                                <div
                                    style="width: 60px; height: 60px; border-radius: 12px; background: #f9f9f9; overflow: hidden; flex-shrink: 0; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                    @if ($item['image'])
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                            style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                    @else
                                        <i class="fas fa-image" style="color: #ddd;"></i>
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <div class="checkout-item-name"
                                        style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 4px;">
                                        {{ $item['name'] }}</div>
                                    <div style="font-size: 13px; color: #999;">Qty: {{ $item['quantity'] }}</div>
                                </div>
                                <div class="checkout-item-price" style="font-weight: 700; color: #1a1a1a;">
                                    {{ format_inr($item['price'] * $item['quantity']) }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-row">
                        <span>Items Subtotal</span>
                        <strong>{{ format_inr($subtotal) }}</strong>
                    </div>

                    @if ($coupon)
                        <div class="applied-coupon" style="padding: 10px 15px; margin: 15px 0;">
                            <div class="coupon-info">
                                <i class="fas fa-tag"></i>
                                <div>
                                    <span class="coupon-code" style="font-size: 14px;">{{ $coupon->code }}</span>
                                    <small style="color: #166534;">Coupon Code Applied</small>
                                </div>
                            </div>
                        </div>
                        <div class="summary-row discount">
                            <span>Coupon Discount</span>
                            <strong>-{{ format_inr($discount) }}</strong>
                        </div>
                    @endif

                    @if ($shipping_charges > 0)
                        <div class="summary-row">
                            <span>Shipping Charges</span>
                            <strong id="summary-shipping-charges">{{ format_inr($shipping_charges) }}</strong>
                        </div>
                    @endif

                    @if ($shipping_discount > 0)
                        <div class="summary-row" style="color: #2e7d32;">
                            <span>Shipping Discount</span>
                            <strong id="summary-shipping-discount">-{{ format_inr($shipping_discount) }}</strong>
                        </div>
                    @endif

                    <div class="summary-row">
                        <span>Shipping Amount</span>
                        <strong id="summary-shipping-net"
                            style="color: {{ $shipping_charges - $shipping_discount <= 0 ? '#2e7d32' : '#c2185b' }};">
                            {{ $shipping_charges - $shipping_discount <= 0 ? 'FREE' : format_inr($shipping_charges - $shipping_discount) }}
                        </strong>
                    </div>

                    <div class="summary-total">
                        <span class="total-label">Payable Amount</span>
                        <div class="total-value" id="summary-total">{{ format_inr($total) }}</div>
                    </div>

                    <div
                        style="background: #fff9f0; border-radius: 16px; padding: 15px; border: 1px dashed #ffd8a8; margin-top: 10px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-truck" style="color: #f59e0b; margin-top: 3px;"></i>
                            <p style="margin: 0; font-size: 13px; color: #92400e; line-height: 1.4;">
                                Shipping costs vary by state. Enter your delivery address to see final charges.
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('cart.index') }}"
                        style="display: block; text-align: center; margin-top: 20px; color: #666; font-size: 14px; font-weight: 600;">
                        <i class="fas fa-edit"></i> Edit Cart
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('use_stored_address');

            // Address data
            const storedAddresses = @json($addresses);

            // Form fields mapping
            const fields = {
                phone: document.querySelector('input[name="phone"]'),
                country: document.querySelector('input[name="country"]'),
                address_line1: document.querySelector('input[name="address_line1"]'),
                address_line2: document.querySelector('input[name="address_line2"]'),
                city: document.querySelector('input[name="city"]'),
                state: document.querySelector('input[name="state"]'),
                postal_code: document.querySelector('input[name="postal_code"]')
            };

            // Update Shipping Summary UI via AJAX
            function updateShippingSummary(state) {
                if (!state || state.length < 3) return;

                fetch("{{ route('cart.shipping.calc') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            state: state
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update Summary Elements
                        // Note: You need to add IDs to your summary elements in the HTML for this to work robustly,
                        // but for now we might need to rely on existing structure or update HTML too.
                        // Let's assume we will update the HTML structure below.

                        const shippingRow = document.querySelector(
                            '.summary-row:has(span:contains("Shipping Charges")) strong');
                        // Better to use IDs. I will update the HTML part as well.

                        // For now, let's just log it. The user wants to avoid refresh.
                        // Real update needs IDs.
                        if (document.getElementById('summary-shipping-charges'))
                            document.getElementById('summary-shipping-charges').innerText = data
                            .formatted_shipping_charges;

                        if (document.getElementById('summary-shipping-discount'))
                            document.getElementById('summary-shipping-discount').innerText = data
                            .formatted_shipping_discount;

                        if (document.getElementById('summary-shipping-net')) {
                            document.getElementById('summary-shipping-net').innerText = data
                                .formatted_shipping_net;
                            if (data.shipping_net <= 0) {
                                document.getElementById('summary-shipping-net').style.color = '#2e7d32';
                            } else {
                                document.getElementById('summary-shipping-net').style.color = '#c2185b';
                            }
                        }

                        if (document.getElementById('summary-total'))
                            document.getElementById('summary-total').innerText = data.formatted_total;

                    })
                    .catch(error => console.error('Error calculating shipping:', error));
            }

            window.populateForm = function(address) {
                for (const key in fields) {
                    if (fields[key]) {
                        if (address[key] !== null && address[key] !== undefined) {
                            fields[key].value = address[key];
                            // Manually trigger update if state
                            if (key === 'state') {
                                updateShippingSummary(address[key]);
                            }

                            fields[key].style.transition = 'background 0.3s';
                            fields[key].style.background = '#fff9f0';
                            setTimeout((el) => {
                                el.style.background = '#f9f9f9';
                            }, 1000, fields[key]);
                        }
                    }
                }
                if (typeof toastr !== 'undefined') {
                    toastr.success("<i class='fas fa-check'></i> Shipping address updated!");
                }
            };

            window.selectAddress = (index) => {
                window.populateForm(storedAddresses[index]);
                if (typeof Swal !== 'undefined') {
                    Swal.close();
                    // Extra toastr message as requested
                    // Delay slightly to appear after the popup closes visually
                    setTimeout(() => {
                        if (typeof toastr !== 'undefined') {
                            toastr.success("Address selected successfully!");
                        }
                    }, 300);
                }
            };

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (storedAddresses.length === 0) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'No Saved Addresses',
                                text: 'You don\'t have any saved shipping addresses yet.',
                                icon: 'info',
                                confirmButtonColor: '#C2185B'
                            });
                        } else {
                            alert('You don\'t have any saved shipping addresses yet.');
                        }
                        this.checked = false;
                        return;
                    }

                    if (storedAddresses.length === 1) {
                        // Auto-set the single address without popup
                        const addr = storedAddresses[0];
                        window.populateForm(addr);
                        // The populateForm function handles the success toastr
                    } else {
                        // Multiple addresses - show a selection list
                        let optionsHtml = '';
                        storedAddresses.forEach((addr, index) => {
                            optionsHtml += `
                        <div class="address-option" onclick="window.selectAddress(${index})" style="cursor: pointer; text-align: left; background: #fff; padding: 12px; border-radius: 10px; border: 1px solid #eee; margin-bottom: 10px; transition: all 0.2s;">
                            <div style="font-weight: 600; color: #c2185b; margin-bottom: 4px;">
                                ${addr.is_default ? '<span style="font-size: 10px; background: #c2185b; color: #fff; padding: 2px 6px; border-radius: 4px; margin-right: 5px;">DEFAULT</span>' : ''}
                                Address #${index + 1}
                            </div>
                            <div style="font-size: 13px; color: #666;">
                                ${addr.address_line1}, ${addr.city}<br>
                                ${addr.phone}
                            </div>
                        </div>
                    `;
                        });

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Select a Saved Address',
                                html: `<div style="max-height: 300px; overflow-y: auto; padding: 5px;">${optionsHtml}</div>`,
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.dismiss) {
                                    this.checked = false;
                                }
                            });
                        }
                    }
                } else {
                    // Uncheck - Clear fields logic
                    for (const key in fields) {
                        if (fields[key]) {
                            fields[key].value = '';
                        }
                    }
                    if (typeof toastr !== 'undefined') {
                        toastr.info("<i class='fas fa-eraser'></i> Form cleared.");
                    }
                }
            });

            // jQuery Validation logic
            if (typeof $ !== 'undefined' && $.fn.validate) {
                $.validator.addMethod("lettersOnly", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
                }, "Please enter only letters.");
                $.validator.addMethod("exactLength", function(value, element, param) {
                    return this.optional(element) || value.length == param;
                }, "Please enter exactly {0} digits.");
                $.validator.addMethod("numericOnly", function(value, element) {
                    return this.optional(element) || /^[0-9]+$/.test(value);
                }, "Please enter only numbers.");

                $("#checkoutForm").validate({
                    rules: {
                        phone: {
                            required: true,
                            numericOnly: true,
                            exactLength: 10
                        },
                        country: {
                            required: true,
                            lettersOnly: true
                        },
                        address_line1: "required",
                        city: {
                            required: true,
                            lettersOnly: true
                        },
                        state: {
                            required: true,
                            lettersOnly: true
                        },
                        postal_code: {
                            required: true,
                            numericOnly: true,
                            exactLength: 6
                        }
                    },
                    messages: {
                        phone: {
                            required: "Please enter your phone number",
                            numericOnly: "Phone number should contain only digits",
                            exactLength: "Phone number must be exactly 10 digits"
                        },
                        country: {
                            required: "Please enter your country",
                            lettersOnly: "Country name should contain only letters"
                        },
                        address_line1: "Please enter your shipping address",
                        city: {
                            required: "Please enter your city",
                            lettersOnly: "City name should contain only letters"
                        },
                        state: {
                            required: "Please enter your state",
                            lettersOnly: "State name should contain only letters"
                        },
                        postal_code: {
                            required: "Please enter your postal code",
                            numericOnly: "Postal code should contain only digits",
                            exactLength: "Postal code must be exactly 6 digits"
                        }
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.addClass("error-msg");
                        error.css({
                            "color": "#d32f2f",
                            "font-size": "12px",
                            "margin-top": "4px",
                            "font-weight": "500"
                        });
                        error.insertAfter(element);
                    }
                });
            }

            // Dynamic Shipping Recalculation (AJAX)
            const stateInput = document.getElementById('state');
            let stateTimeout;

            if (stateInput) {
                stateInput.addEventListener('input', function() {
                    clearTimeout(stateTimeout);
                    stateTimeout = setTimeout(() => {
                        const state = this.value;
                        updateShippingSummary(state);
                    }, 1000);
                });
            }
        });
    </script>
    <style>
        .address-option:hover {
            border-color: #c2185b !important;
            background: #fff9fb !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(194, 24, 91, 0.08);
        }
    </style>
@endsection
