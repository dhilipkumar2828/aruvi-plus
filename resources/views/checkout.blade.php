@extends('layouts.auri')

@section('title', 'Secure Checkout | Auvri Plus')

@section('extra_css')
     <style>
        :root {
            --primary: #004200;
            --primary-rgb: 0, 66, 0;
            --accent: #d4af37;
            --bg-light: #fffdf9;
            --border: #f0f0f0;
            --input-bg: #ffffff;
        }

        .checkout-page-wrapper {
            background-color: var(--bg-light);
            padding-bottom: 30px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Hero Banner */
        .checkout-hero {
            background: linear-gradient(rgba(0, 66, 0, 0.75), rgba(0, 66, 0, 0.75)), url('{{ asset('auri-images/headers/shop_v2.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 120px 0 60px;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .checkout-hero h1 {
            font-size: 3rem;
            color: #fff !important;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        /* Layout Grid */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }


        /* Cards */
        .checkout-card {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 15px 0 40px -15px rgba(0, 66, 0, 0.06), -15px 0 40px -15px rgba(0, 66, 0, 0.06);
            border: 1px solid var(--border);
        }

        .checkout-title {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            font-family: 'Playfair Display', serif;
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
            padding: 16px 20px;
            border-radius: 12px;
            border: 1.5px solid #eee;
            background: var(--input-bg);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            color: #333;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 5px 15px rgba(141, 2, 31, 0.05);
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
            max-width: 367px;
            border-radius: 24px;
            padding: 35px;
            border: 1px solid var(--border);
            position: sticky;
            top: 100px;
            box-shadow: 20px 0 50px -20px rgba(0, 66, 0, 0.08), -20px 0 50px -20px rgba(0, 66, 0, 0.08);
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
            padding: 18px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-complete-order:hover {
            background: #700118;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(141, 2, 31, 0.2);
        }

        /* Responsive Improvements */

        /* Saved Address Horizontal List */
        .saved-addresses-container {
            background: #fff9fb;
            border: 1px solid #ffebeb;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
        }

        .saved-addresses-scroll {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px 5px 25px;
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #f5f5f5;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
        }

        .saved-addresses-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .saved-addresses-scroll::-webkit-scrollbar-track {
            background: #f5f5f5;
            border-radius: 10px;
        }

        .saved-addresses-scroll::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .address-card {
            flex: 0 0 calc(50% - 10px);
            min-width: 180px;
            background: #fff;
            border: 2px solid #eee;
            border-radius: 18px;
            padding: 20px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            scroll-snap-align: start;
        }

        .address-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 66, 0, 0.08);
            border-color: #ddd;
        }

        .address-card.active {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.1);
        }

        .address-card .check-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            color: var(--primary);
            font-size: 1.3rem;
            display: none;
            background: #fff;
            border-radius: 50%;
            line-height: 1;
        }

        .address-card.active .check-icon {
            display: block;
        }

        .address-badge {
            display: inline-block;
            background: rgba(0, 66, 0, 0.05);
            color: var(--primary);
            font-size: 0.65rem;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: fit-content;
        }

        .address-card.active .address-badge {
            background: var(--primary);
            color: #fff;
        }

        .address-card h5 {
            margin: 0 0 8px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #222;
        }

        .address-card .address-lines {
            margin-top: auto;
        }

        .address-card p {
            margin: 0;
            font-size: 0.88rem;
            color: #666;
            line-height: 1.6;
            word-break: break-word;
        }

        /* Checkbox Styling */
        .custom-check-container {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
            margin-bottom: 15px;
        }

        .custom-check-container input {
            display: none;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid var(--primary);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .custom-check-container input:checked + .checkmark {
            background: var(--primary);
        }

        .checkmark:after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #fff;
            font-size: 10px;
            display: none;
        }

        .custom-check-container input:checked + .checkmark:after {
            display: block;
        }

        .section-label {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: block;
        }
        .checkout-item-name {
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            line-height: 1.4 !important;
        }

        /* Utility to hide scroll on desktop when 2 cards fit */
        @media (min-width: 769px) {
            .no-scroll-desktop {
                overflow-x: hidden !important;
            }
            .d-md-none-important {
                display: none !important;
            }
        }
        /* Responsive Improvements - Moved to end for proper override */
        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .checkout-card, .summary-card {
                max-width: 100% !important;
                width: 100% !important;
                position: static !important;
                margin-top: 20px;
                box-sizing: border-box !important;
                box-shadow: 0 10px 30px rgba(0, 66, 0, 0.05) !important;
                overflow: hidden;
            }
            /* Tablet: Show 2 cards */
            .address-card {
                flex: 0 0 calc(50% - 10px) !important;
            }
            .saved-addresses-container {
                max-width: 100% !important;
                padding: 20px 15px !important;
            }
            .no-scroll {
                overflow-x: hidden !important;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px !important;
            }
            .form-group-grid, .three-col {
                grid-template-columns: 1fr !important;
                gap: 15px;
            }
            .checkout-hero {
                padding: 100px 15px 50px !important;
            }
            .checkout-hero h1 {
                font-size: 2.2rem !important;
            }
            .checkout-card, .summary-card {
                padding: 25px 20px !important;
                border-radius: 20px !important;
                width: 100% !important;
                box-sizing: border-box !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                box-shadow: 0 8px 25px rgba(0, 66, 0, 0.05) !important;
            }
            .checkout-title {
                font-size: 1.5rem !important;
            }
        }

        @media (max-width: 480px) {
            .checkout-hero h1 {
                font-size: 1.8rem !important;
            }
            .checkout-hero p {
                font-size: 0.85rem !important;
                padding: 0 10px;
            }
            .checkout-card, .summary-card {
                padding: 20px 15px !important;
                border-radius: 16px !important;
                width: 100% !important;
                box-sizing: border-box !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                box-shadow: 0 10px 30px rgba(0, 66, 0, 0.05) !important;
            }
            .form-group-grid {
                gap: 15px;
            }
            .summary-total {
                padding: 15px 12px !important;
                flex-direction: row !important;
                justify-content: space-between !important;
            }
            .total-value {
                font-size: 1.5rem !important;
            }
            #summary-total {
                font-size: 1.6rem !important;
            }
            .btn-complete-order {
                padding: 15px !important;
                font-size: 1rem !important;
            }
            .saved-addresses-container {
                padding: 15px !important;
            }
            /* Mobile: Show 1 card */
            .address-card {
                flex: 0 0 100% !important;
            }
            .address-header-wrapper {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px !important;
            }
        }

        @media (max-width: 360px) {
            .container {
                padding: 0 12px !important;
            }
            .checkout-card, .summary-card {
                padding: 15px 12px !important;
            }
            .address-card {
                flex: 0 0 100% !important;
            }
            .total-value, #summary-total {
                font-size: 1.4rem !important;
            }
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
                <h3 class="checkout-title">Shipping Address</h3>

                @if ($errors->any())
                    <div style="margin-bottom: 25px; background: #fff5f5; border-left: 4px solid #f44336; color: #d32f2f; padding: 15px 20px; border-radius: 8px;">
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
                    
                    @if($addresses->count() > 0)
                    <div class="saved-addresses-container">
                        <label class="custom-check-container">
                            <input type="checkbox" id="useSavedAddress" checked>
                            <span class="checkmark"></span>
                            <span style="font-weight: 700; color: var(--primary); font-size: 1rem;">Use a saved address</span>
                        </label>
                        
                        <div class="address-header-wrapper" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <span class="section-label" style="margin-bottom: 0;">CHOOSE FROM SAVED ADDRESSES</span>
                            @php $addrCount = $addresses->count(); @endphp
                            <span class="scroll-instruction {{ $addrCount <= 1 ? 'd-none' : ($addrCount <= 2 ? 'd-md-none-important' : '') }}" style="font-size: 0.75rem; color: #999; font-weight: 600;">SCROLL TO VIEW ALL <i class="fas fa-chevron-right" style="font-size: 0.6rem;"></i></span>
                        </div>
                        
                        <div class="saved-addresses-scroll {{ $addrCount <= 1 ? 'no-scroll' : ($addrCount <= 2 ? 'no-scroll-desktop' : '') }}" id="addressScroller">
                            @foreach ($addresses as $index => $addr)
                                <div class="address-card {{ $addr->is_default ? 'active' : '' }}" onclick="selectStoredAddress({{ $index }}, this)">
                                    <div class="check-icon"><i class="fas fa-check-circle"></i></div>
                                    <span class="address-badge">{{ $addr->type ?? 'STANDARD ADDRESS' }}</span>
                                    <h5>{{ $addr->name ?? $user->name }}</h5>
                                    <div class="address-lines">
                                        <p>{{ $addr->address_line1 }}</p>
                                        <p>{{ $addr->address_line2 }}</p>
                                        <p>{{ $addr->city }}, {{ $addr->state }} - {{ $addr->postal_code }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                         <div class="scroll-indicator-container {{ $addrCount <= 1 ? 'd-none' : ($addrCount <= 2 ? 'd-md-none-important' : '') }}">
                            <div class="scroll-indicator-bar" id="scrollIndicator"></div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group-grid">
                        <div>
                            <label class="form-label">FULL NAME <span style="color: red;">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                placeholder="Full Name" class="form-control"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                        </div>
                        <div>
                            <label class="form-label">PHONE NUMBER <span style="color: red;">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
                                placeholder="Phone Number" class="form-control" maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label class="form-label">DELIVERY ADDRESS <span style="color: red;">*</span></label>
                        <textarea name="address_line1" id="address_line1" required 
                            placeholder="House No., Street Name, Area, etc." 
                            class="form-control" style="min-height: 100px; resize: vertical;">{{ old('address_line1') }}</textarea>
                    </div>

                    <div class="form-group-grid">
                        <div>
                            <label class="form-label">CITY <span style="color: red;">*</span></label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                placeholder="City" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                        </div>
                        <div>
                            <label class="form-label">STATE <span style="color: red;">*</span></label>
                            <select name="state" id="state" required class="form-control">
                                <option value="Andaman and Nicobar Islands" {{ old('state') == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh" {{ old('state') == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh</option>
                                <option value="Arunachal Pradesh" {{ old('state') == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                <option value="Assam" {{ old('state') == 'Assam' ? 'selected' : '' }}>Assam</option>
                                <option value="Bihar" {{ old('state') == 'Bihar' ? 'selected' : '' }}>Bihar</option>
                                <option value="Chandigarh" {{ old('state') == 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                <option value="Chhattisgarh" {{ old('state') == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli and Daman and Diu" {{ old('state') == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>Dadra and Nagar Haveli and Daman and Diu</option>
                                <option value="Delhi" {{ old('state') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                <option value="Goa" {{ old('state') == 'Goa' ? 'selected' : '' }}>Goa</option>
                                <option value="Gujarat" {{ old('state') == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                <option value="Haryana" {{ old('state') == 'Haryana' ? 'selected' : '' }}>Haryana</option>
                                <option value="Himachal Pradesh" {{ old('state') == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal Pradesh</option>
                                <option value="Jammu and Kashmir" {{ old('state') == 'Jammu and Kashmir' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                <option value="Jharkhand" {{ old('state') == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                <option value="Karnataka" {{ old('state') == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                <option value="Kerala" {{ old('state') == 'Kerala' ? 'selected' : '' }}>Kerala</option>
                                <option value="Ladakh" {{ old('state') == 'Ladakh' ? 'selected' : '' }}>Ladakh</option>
                                <option value="Lakshadweep" {{ old('state') == 'Lakshadweep' ? 'selected' : '' }}>Lakshadweep</option>
                                <option value="Madhya Pradesh" {{ old('state') == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh</option>
                                <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                <option value="Manipur" {{ old('state') == 'Manipur' ? 'selected' : '' }}>Manipur</option>
                                <option value="Meghalaya" {{ old('state') == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                <option value="Mizoram" {{ old('state') == 'Mizoram' ? 'selected' : '' }}>Mizoram</option>
                                <option value="Nagaland" {{ old('state') == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                <option value="Odisha" {{ old('state') == 'Odisha' ? 'selected' : '' }}>Odisha</option>
                                <option value="Puducherry" {{ old('state') == 'Puducherry' ? 'selected' : '' }}>Puducherry</option>
                                <option value="Punjab" {{ old('state') == 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                <option value="Rajasthan" {{ old('state') == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                <option value="Sikkim" {{ old('state') == 'Sikkim' ? 'selected' : '' }}>Sikkim</option>
                                <option value="Tamil Nadu" {{ old('state') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                <option value="Telangana" {{ old('state') == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                <option value="Tripura" {{ old('state') == 'Tripura' ? 'selected' : '' }}>Tripura</option>
                                <option value="Uttar Pradesh" {{ old('state') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                                <option value="Uttarakhand" {{ old('state') == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                <option value="West Bengal" {{ old('state') == 'West Bengal' ? 'selected' : '' }}>West Bengal</option>
                                <!-- Other states can be added here -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group-grid">
                        <div>
                            <label class="form-label">PINCODE <span style="color: red;">*</span></label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                required placeholder="Pincode" class="form-control" maxlength="6"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="form-label">COUNTRY <span style="color: red;">*</span></label>
                            <input type="text" name="country" id="country" value="{{ old('country', 'India') }}"
                                required class="form-control">
                        </div>
                    </div>

                    

                    <label class="custom-check-container">
                        <input type="checkbox" name="save_address" id="save_address" value="1">
                        <span class="checkmark"></span>
                        <span style="font-size: 0.9rem; color: #555;">Save this address for future use</span>
                    </label>
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

                        <div class="summary-total" style="background: #fff5f8; border: 1px solid #ffebeb; border-radius: 12px; padding: 15px 20px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 1.2rem; font-weight: 800; color: #b0185e;">Total</span>
                            <div style="font-size: 2rem; font-weight: 900; color: #b0185e;" id="summary-total">₹{{ number_format($total, 0) }}</div>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <span class="section-label">SELECT PAYMENT METHOD</span>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <label class="custom-check-container" style="background: #fdfdfd; border: 1.5px solid #eee; padding: 15px; border-radius: 12px; transition: 0.3s;" id="label-cod">
                                    <input type="radio" name="payment_method" value="Cash On Delivery" form="checkoutForm" checked onclick="togglePaymentUI('cod')">
                                    <span class="checkmark" style="border-radius: 50%;"></span>
                                    <div style="display: flex; flex-direction: column; gap: 2px;">
                                        <span style="font-weight: 700; color: #333;">Cash On Delivery</span>
                                        <span style="font-size: 0.75rem; color: #888;">Pay when you receive the order</span>
                                    </div>
                                </label>
                                <label class="custom-check-container" style="background: #fdfdfd; border: 1.5px solid #eee; padding: 15px; border-radius: 12px; transition: 0.3s;" id="label-online">
                                    <input type="radio" name="payment_method" value="Online Payment" form="checkoutForm" onclick="togglePaymentUI('online')">
                                    <span class="checkmark" style="border-radius: 50%;"></span>
                                    <div style="display: flex; flex-direction: column; gap: 2px;">
                                        <span style="font-weight: 700; color: #333;">PhonePe</span>
                                        <span style="font-size: 0.75rem; color: #888;">Pay securely via UPI, Cards, or NetBanking</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" form="checkoutForm" class="btn-premium btn-complete-order" id="submit-btn" style="width: 100%; padding: 18px; border-radius: 12px; font-weight: 800; font-size: 1rem; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 10px; background: var(--primary); color: white; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0, 66, 0, 0.15);">
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
<br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fieldSelectors = {
                name: '[name="name"]',
                phone: '[name="phone"]',
                country: '[name="country"]',
                address_line1: '[name="address_line1"]',
                city: '[name="city"]',
                state: '[name="state"]',
                postal_code: '[name="postal_code"]'
            };

            const fields = {};
            for (const key in fieldSelectors) {
                fields[key] = document.querySelector(fieldSelectors[key]);
            }

            const storedAddresses = @json($addresses);

            function updateShippingSummary(state) {
                if (!state || state.length < 3) return;

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
                    const totalEl = document.getElementById('summary-total');
                    if (totalEl) totalEl.innerText = data.formatted_total;
                    
                    if (document.getElementById('summary-product-value'))
                        document.getElementById('summary-product-value').innerText = data.formatted_taxable_product_value;
                    if (document.getElementById('summary-shipping-taxable'))
                        document.getElementById('summary-shipping-taxable').innerText = data.formatted_taxable_shipping_value;
                    if (document.getElementById('summary-taxable-value'))
                        document.getElementById('summary-taxable-value').innerText = data.formatted_taxable_value;
                    if (document.getElementById('summary-gst-amount'))
                        document.getElementById('summary-gst-amount').innerText = data.formatted_gst_amount;
                });
            }

            window.selectStoredAddress = function(index, element) {
                const address = storedAddresses[index];
                if (address) {
                    // Update active card UI
                    document.querySelectorAll('.address-card').forEach(card => card.classList.remove('active'));
                    element.classList.add('active');

                    // Populate form
                    for (const key in fields) {
                        if (fields[key] && address[key]) {
                            fields[key].value = address[key];
                            if (key === 'state') updateShippingSummary(address[key]);
                        }
                    }
                }
            };

            // Toggle Saved Address Section
            const useSavedCheckbox = document.getElementById('useSavedAddress');
            const savedContainer = document.querySelector('.saved-addresses-scroll');
            if (useSavedCheckbox && savedContainer) {
                useSavedCheckbox.addEventListener('change', function() {
                    savedContainer.style.opacity = this.checked ? '1' : '0.5';
                    savedContainer.style.pointerEvents = this.checked ? 'auto' : 'none';
                });
            }

            // Billing Address Toggle
            const sameAsShipping = document.getElementById('sameAsShipping');
            const billingNotice = document.getElementById('billingNotice');
            if (sameAsShipping && billingNotice) {
                sameAsShipping.addEventListener('change', function() {
                    billingNotice.style.display = this.checked ? 'flex' : 'none';
                    if (!this.checked) {
                        // In a real app, you might show another form here.
                        // For now, we follow the UI request which just shows a notice.
                    }
                });
            }

            // Recalculate on state change
            if (fields.state) {
                fields.state.addEventListener('change', function() {
                    updateShippingSummary(this.value);
                });
            }

            // Validation
            if (typeof $ !== 'undefined' && $.fn.validate) {
                $("#checkoutForm").validate({
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.css({"color": "#d32f2f", "font-size": "12px", "margin-top": "4px"});
                        error.insertAfter(element);
                    }
                });
            }

            // Payment Method UI
            window.togglePaymentUI = function(method) {
                const codLabel = document.getElementById('label-cod');
                const onlineLabel = document.getElementById('label-online');
                const submitBtn = document.getElementById('submit-btn');

                if (method === 'cod') {
                    codLabel.style.borderColor = 'var(--primary)';
                    codLabel.style.background = '#f9fcf9';
                    onlineLabel.style.borderColor = '#eee';
                    onlineLabel.style.background = '#fdfdfd';
                    submitBtn.innerHTML = 'PLACE ORDER NOW <i class="fas fa-check-circle"></i>';
                } else {
                    onlineLabel.style.borderColor = 'var(--primary)';
                    onlineLabel.style.background = '#f9fcf9';
                    codLabel.style.borderColor = '#eee';
                    codLabel.style.background = '#fdfdfd';
                    submitBtn.innerHTML = 'PROCEED TO PAYMENT <i class="fas fa-arrow-right"></i>';
                }
            };
            
            // Initial call to set UI
            togglePaymentUI('cod');
        });
    </script>
@endsection
