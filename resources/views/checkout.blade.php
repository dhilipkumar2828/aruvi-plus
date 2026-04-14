@extends('layouts.auri')

@section('title', 'Secure Checkout | Auvri Plus')

@section('extra_css')
    <style>
        :root {
            --primary: #004200;
            --accent: #d4af37;
            --bg-light: #f8faf8;
            --border: rgba(0, 66, 0, 0.1);
        }

        .checkout-page-wrapper {
            background-color: var(--bg-light);
            padding-bottom: 80px;
            min-height: 100vh;
        }

        /* Hero Banner */
        .checkout-hero {
            background: linear-gradient(rgba(0, 66, 0, 0.75), rgba(0, 66, 0, 0.75)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0 50px;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .checkout-hero h1 {
            font-size: 3rem;
            color: var(--accent) !important;
            margin-bottom: 10px;
        }

        /* Layout Grid */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .checkout-card {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 66, 0, 0.04);
            border: 1px solid var(--border);
        }

        .checkout-title {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .checkout-title i {
            color: var(--accent);
        }

        /* Form Controls */
        .form-label {
            display: block;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 14px 20px;
            border-radius: 14px;
            border: 1px solid #e0e0e0;
            background: #fdfdfd;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 66, 0, 0.05);
        }

        .form-control:disabled {
            background: #f5f5f5;
            color: #888;
            cursor: not-allowed;
        }

        .form-group-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .three-col {
            grid-template-columns: 1fr 1.5fr 1fr;
        }

        @media (max-width: 576px) {
            .form-group-grid, .three-col {
                grid-template-columns: 1fr;
            }
        }

        /* Checkbox Fix */
        .custom-checkbox-wrapper {
            background: #fff9fc;
            border: 1px dashed #e91e63;
            padding: 15px 20px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            cursor: pointer;
            transition: 0.3s;
        }

        .custom-checkbox-wrapper:hover {
            background: #fff0f6;
        }

        /* Order Summary Mini */
        .summary-card {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            border: 1px solid var(--border);
            position: sticky;
            top: 100px;
            box-shadow: 0 15px 50px rgba(0, 66, 0, 0.06);
        }

        .checkout-item-row {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.95rem;
            color: #555;
        }

        .summary-total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Complete Order Button */
        .btn-complete-order {
            width: 100%;
            background: var(--primary);
            color: white !important;
            padding: 20px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.25);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 30px;
            text-transform: uppercase;
        }

        .btn-complete-order:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 66, 0, 0.35);
            background: #003300;
        }
    </style>
@endsection

@section('content')
<div class="checkout-page-wrapper">
    <!-- Hero Banner -->
    <div class="checkout-hero">
        <div class="container">
            <h1>Secure Checkout</h1>
            <p>Your journey towards wellness is just one step away from completion.</p>
        </div>
    </div>

    <div class="container">
        <div class="checkout-grid">
            <!-- Left: Shipping Info -->
            <div class="checkout-card">
                <h3 class="checkout-title">
                    <i class="fas fa-truck-loading"></i> Shipping Details
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

                        <!-- Previously Saved Address Section -->
                        <div class="saved-address-trigger-card" id="savedAddressTrigger" style="background: #fff9fb; border: 1px dashed #e91e63; border-radius: 12px; padding: 18px; margin-bottom: 25px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: space-between; gap: 15px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; background: rgba(233, 30, 99, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #e91e63;">
                                    <i class="fas fa-history" style="font-size: 1.1rem;"></i>
                                </div>
                                <div>
                                    <h5 style="margin: 0; font-size: 0.95rem; font-weight: 700; color: var(--primary); letter-spacing: 0.5px;">USE PREVIOUSLY SAVED ADDRESS</h5>
                                    <p style="margin: 0; font-size: 0.75rem; color: #888;">Select from your stored shipping addresses</p>
                                </div>
                            </div>
                            <div style="background: #e91e63; color: white; padding: 6px 12px; border-radius: 6px; font-size: 0.7rem; font-weight: 800; letter-spacing: 1px;">SELECT</div>
                        </div>

                        <!-- Address Selection Modal -->
                        <div id="addressSelectionModal" class="auri-custom-modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center;">
                            <div class="modal-content-auri" style="background: white; border-radius: 20px; width: 90%; max-width: 500px; max-height: 80vh; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.15); animation: modalFadeIn 0.3s ease;">
                                <div class="modal-header-auri" style="padding: 20px 25px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; background: #fdfdfd;">
                                    <h4 style="margin: 0; color: var(--primary); font-size: 1.4rem;">Select Shipping Address</h4>
                                    <span class="close-modal-auri" onclick="toggleAddressModal(false)" style="font-size: 1.5rem; cursor: pointer; color: #999;">&times;</span>
                                </div>
                                <div class="modal-body-auri" style="padding: 20px 25px; overflow-y: auto; max-height: 50vh;">
                                    @if ($addresses->count() > 0)
                                        <div class="address-options-list" style="display: flex; flex-direction: column; gap: 12px;">
                                            @foreach ($addresses as $index => $addr)
                                                <div class="address-card-option" onclick="selectStoredAddress({{ $index }})" 
                                                     style="border: 1.5px solid #f0f0f0; border-radius: 12px; padding: 15px; cursor: pointer; transition: 0.2s; position: relative; background: #fff;">
                                                    @if($addr->is_default)
                                                        <span style="position: absolute; top: 12px; right: 12px; background: var(--primary); color: white; font-size: 9px; font-weight: 800; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.5px;">DEFAULT</span>
                                                    @endif
                                                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                                                        <div style="margin-top: 2px;"><i class="fas fa-map-marker-alt" style="color: #e91e63;"></i></div>
                                                        <div>
                                                            <div style="font-weight: 700; color: #333; font-size: 0.95rem; margin-bottom: 4px;">{{ $addr->address_line1 }}</div>
                                                            <div style="font-size: 0.85rem; color: #666; line-height: 1.5;">
                                                                {{ $addr->address_line2 ? $addr->address_line2 . ',' : '' }} {{ $addr->city }}, {{ $addr->state }}<br>
                                                                {{ $addr->postal_code }}, {{ $addr->country }}<br>
                                                                <span style="color: var(--primary); font-weight: 600;"><i class="fas fa-phone-alt" style="font-size: 0.7rem;"></i> {{ $addr->phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div style="text-align: center; padding: 30px 0;">
                                            <i class="fas fa-search-location" style="font-size: 3rem; color: #eee; margin-bottom: 15px;"></i>
                                            <p style="color: #999;">No saved addresses found in your account.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer-auri" style="padding: 15px 25px; border-top: 1px solid #f0f0f0; background: #fdfdfd; display: flex; justify-content: flex-end;">
                                    <button type="button" onclick="toggleAddressModal(false)" style="background: #f5f5f5; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; color: #666; cursor: pointer;">CANCEL</button>
                                </div>
                            </div>
                        </div>

                        <style>
                            .saved-address-trigger-card:hover { border-color: #004200; background: #f0f4f0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transform: translateY(-2px); }
                            .address-card-option:hover { border-color: #e91e63; background: #fff9fb; transform: scale(1.01); box-shadow: 0 5px 15px rgba(233, 30, 99, 0.08); }
                            @keyframes modalFadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
                        </style>

                        <div class="form-group-grid">
                            <div style="grid-column: span 2;">
                                <label class="form-label">Full Name (Recipient) <span style="color: red;">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    placeholder="Enter recipient's full name" class="form-control"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                        </div>

                        <div class="form-group-grid">
                            <div>
                                <label class="form-label">Phone Number <span style="color: red;">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
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
                                <label class="form-label">State <span style="color: red;">*</span></label>
                                <select name="state" id="state" required class="form-control" style="cursor: pointer; appearance: auto;">
                                    <option value="" disabled selected>Select State</option>
                                    <optgroup label="Popular">
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Puducherry">Puducherry</option>
                                    </optgroup>
                                    <optgroup label="Other States">
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </optgroup>
                                   
                                </select>
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

                        <p style="text-align: center; margin-top: 10px; color: #888; font-size: 13px;">
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

                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 25px; border-top: 1px solid #f0f0f0; padding-top: 20px;">
                       

                        @if ($discount > 0)
                            <div class="summary-row" style="color: #2e7d32;">
                                <span>Coupon Discount</span>
                                <strong id="summary-coupon-discount">-{{ format_inr($discount) }}</strong>
                            </div>
                        @endif

                        <div id="shipping-summary-wrapper" style="display: {{ $shipping_charges > 0 ? 'flex' : 'none' }}; flex-direction: column; gap: 12px;">
                            @if ($shipping_discount > 0)
                                <div class="summary-row" style="color: #2e7d32;">
                                    <span>Shipping Discount</span>
                                    <strong id="summary-shipping-discount">-{{ format_inr($shipping_discount) }}</strong>
                                </div>
                            @endif
                          
                        </div>

                        <div style="border-top: 1px dashed #e2e8f0; padding-top: 15px; margin-top: 5px; display: flex; flex-direction: column; gap: 10px;">
                             <div class="summary-row">
                                <span style="color: #777; font-size: 0.9rem;">Product Value</span>
                                <strong id="summary-product-value" style="color: #444; font-weight: 600;">{{ format_inr($taxable_product_value) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span style="color: #777; font-size: 0.9rem;">Shipping Charges</span>
                                <strong id="summary-shipping-taxable" style="color: #444; font-weight: 600;">{{ format_inr($taxable_shipping_value,2)}}</strong>
                            </div>

                            <div class="summary-row">
                                <span style="color: #333; font-weight: 700; font-size: 0.95rem;">Taxable Value</span>
                                <strong id="summary-taxable-value" style="color: #333; font-weight: 700;">{{ format_inr($taxable_value) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span style="color: #777; font-size: 0.9rem;">GST (18%)</span>
                                <strong id="summary-gst-amount" style="color: #444; font-weight: 600;">{{ format_inr($gst_amount) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="summary-total" style="background: #fff5f8; border: 1px solid #ffebeb; border-radius: 12px; padding: 5px 10px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.2rem; font-weight: 800; color: #b0185e;">Total</span>
                        <div style="font-size: 2rem; font-weight: 900; color: #b0185e;" id="summary-total">₹{{ number_format($total, 0) }}</div>
                    </div>

                    <button type="submit" form="checkoutForm" class="btn-premium btn-complete-order" style="width: 100%; padding: 18px; border-radius: 12px; font-weight: 800; font-size: 1rem; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 10px; background: var(--primary); color: white; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0, 66, 0, 0.15);">
                        PLACE ORDER NOW <i class="fas fa-check-circle"></i>
                    </button>

                    <div
                        style="background: #fff9f0; border-radius: 16px; padding: 15px; border: 1px dashed #ffd8a8; margin-top: 10px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-truck" style="color: #f59e0b; margin-top: 3px;"></i>
                            <p style="margin: 0; font-size: 13px; color: #92400e; line-height: 1.4;">
                                Shipping costs vary by state. Enter your delivery address to see final charges.
                            </p>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form fields mapping
            const fieldSelectors = {
                phone: '[name="phone"]',
                country: '[name="country"]',
                address_line1: '[name="address_line1"]',
                address_line2: '[name="address_line2"]',
                city: '[name="city"]',
                state: '[name="state"]',
                postal_code: '[name="postal_code"]'
            };

            const fields = {};
            for (const key in fieldSelectors) {
                fields[key] = document.querySelector(fieldSelectors[key]);
            }

            // Stored Addresses Data
            const storedAddresses = @json($addresses);

            // Update Shipping Summary UI via AJAX
            function updateShippingSummary(state) {
                if (!state || state.length < 3) {
                    const wrapper = document.getElementById('shipping-summary-wrapper');
                    if (wrapper) wrapper.style.display = 'none';
                    
                    // Reset total to base price (subtotal - discount)
                    if (document.getElementById('summary-total')) {
                        const baseTotal = {{ $subtotal - $discount }};
                        document.getElementById('summary-total').innerText = '₹' + baseTotal.toLocaleString('en-IN');
                    }
                    return;
                }

                fetch("{{ route('cart.shipping.calc') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ state: state })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const wrapper = document.getElementById('shipping-summary-wrapper');
                        if (wrapper) wrapper.style.display = 'flex';

                        if (document.getElementById('summary-shipping-charges'))
                            document.getElementById('summary-shipping-charges').innerText = data.formatted_shipping_charges;

                        if (document.getElementById('summary-shipping-discount'))
                            document.getElementById('summary-shipping-discount').innerText = data.formatted_shipping_discount;

                        if (document.getElementById('summary-shipping-net')) {
                            document.getElementById('summary-shipping-net').innerText = data.formatted_shipping_net;
                            document.getElementById('summary-shipping-net').style.color = data.shipping_net <= 0 ? '#2e7d32' : '#c2185b';
                        }
                        
                        // New Tax Rows
                        if (document.getElementById('summary-product-value'))
                            document.getElementById('summary-product-value').innerText = data.formatted_taxable_product_value;
                        
                        if (document.getElementById('summary-shipping-taxable'))
                            document.getElementById('summary-shipping-taxable').innerText = data.formatted_taxable_shipping_value;
                        
                        if (document.getElementById('summary-taxable-value'))
                            document.getElementById('summary-taxable-value').innerText = data.formatted_taxable_value;
                        
                        if (document.getElementById('summary-gst-amount'))
                            document.getElementById('summary-gst-amount').innerText = data.formatted_gst_amount;

                        if (document.getElementById('summary-total'))
                            document.getElementById('summary-total').innerText = data.formatted_total;
                    })
                    .catch(error => console.error('Error calculating shipping:', error));
            }

            window.populateForm = function(address) {
                for (const key in fields) {
                    if (fields[key] && (address[key] !== null && address[key] !== undefined)) {
                        fields[key].value = address[key];
                        if (key === 'state') {
                            updateShippingSummary(address[key]);
                            const wrapper = document.getElementById('shipping-summary-wrapper');
                            if (wrapper) wrapper.style.display = 'block';
                        }

                        // Flash effect
                        fields[key].style.background = '#fff9f0';
                        setTimeout((el) => { el.style.background = '#fff'; }, 1000, fields[key]);
                    }
                }
                if (typeof toastr !== 'undefined') {
                    toastr.success("<i class='fas fa-check'></i> Shipping address updated!");
                }
            };

            window.toggleAddressModal = function(show) {
                const modal = document.getElementById('addressSelectionModal');
                if (modal) {
                    modal.style.display = show ? 'flex' : 'none';
                    document.body.style.overflow = show ? 'hidden' : 'auto';
                }
            };

            window.selectStoredAddress = function(index) {
                const address = storedAddresses[index];
                if (address) {
                    window.populateForm(address);
                    window.toggleAddressModal(false);
                }
            };

            const triggerCard = document.getElementById('savedAddressTrigger');
            if (triggerCard) {
                triggerCard.addEventListener('click', function() {
                    if (storedAddresses.length === 0) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'No Saved Addresses',
                                text: 'You dont have any saved shipping addresses yet.',
                                icon: 'info',
                                confirmButtonColor: '#004200'
                            });
                        } else {
                            alert('No saved addresses found.');
                        }
                    } else if (storedAddresses.length === 1) {
                        window.populateForm(storedAddresses[0]);
                    } else {
                        window.toggleAddressModal(true);
                    }
                });
            }

            // Close modal events
            window.addEventListener('click', function(e) {
                if (e.target === document.getElementById('addressSelectionModal')) window.toggleAddressModal(false);
            });
            window.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') window.toggleAddressModal(false);
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
                        name: {
                            required: true,
                            lettersOnly: true,
                            minlength: 2
                        },
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
                            required: true
                        },
                        postal_code: {
                            required: true,
                            numericOnly: true,
                            exactLength: 6
                        }
                    },
                    messages: {
                        name: {
                            required: "Please enter recipient name",
                            lettersOnly: "Name should only contain letters",
                            minlength: "Name must be at least 2 characters"
                        },
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

            // Dynamic Shipping Recalculation (AJAX) - Optimized for Dropdown
            const stateInput = document.getElementById('state');
            if (stateInput) {
                stateInput.addEventListener('change', function() {
                    const state = this.value;
                    updateShippingSummary(state);
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
