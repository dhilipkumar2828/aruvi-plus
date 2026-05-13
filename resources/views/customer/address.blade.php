@extends('layouts.auri')

@section('title', 'My Address | Auvri Plus')

@section('content')
    <div class="luxury-account-page">
        <div class="container">
            <!-- Page Header -->
            <div class="account-page-header">
                <h1 class="account-title">My Address</h1>
                <div class="account-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <a href="{{ route('customer.dashboard') }}">Account</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <span>Address</span>
                </div>
            </div>

            <div class="account-grid">
                <!-- Sidebar -->
                <aside class="account-sidebar-col">
                    @include('customer.sidebar')
                </aside>

                <!-- Main Content -->
                <div class="account-main-content">
                    <div class="section-card">
                        <div class="section-header-flex">
                            <h3 class="premium-section-title">Saved Addresses</h3>
                            <p class="section-subtitle">Manage your default shipping and billing information.</p>
                        </div>

                        <div class="address-cards-grid">
                            @forelse($addresses as $address)
                            <div class="premium-address-card {{ $address->is_default ? 'default-card' : '' }}">
                                <div class="card-type-badge">
                                    <i class="fas {{ $address->is_default ? 'fa-check-circle' : 'fa-truck' }}"></i> 
                                    {{ $address->is_default ? 'DEFAULT SHIPPING' : 'SAVED ADDRESS' }}
                                </div>
                                <div class="address-details">
                                    <h4 class="recipient-name">{{ $address->name ?? $user->name }}</h4>
                                    <p class="phone-number"><i class="fas fa-phone-alt"></i> {{ $address->phone }}</p>
                                    <p class="full-address">
                                        {{ $address->address_line1 }}<br>
                                        @if($address->address_line2) {{ $address->address_line2 }}<br> @endif
                                        {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}<br>
                                        {{ $address->country }}
                                    </p>
                                </div>
                                <div class="card-actions">
                                    <button onclick="editAddress({{ $address->toJson() }})" class="edit-btn">
                                        <i class="fas fa-edit"></i> Edit Address
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="premium-address-card" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                                <p class="no-address">No addresses saved yet.</p>
                                <button onclick="toggleAddressForm()" class="btn btn-primary mt-3">Add Your First Address</button>
                            </div>
                            @endforelse
                        </div>

                        <!-- Edit Address Form (Hidden by default) -->
                        <div id="edit-address-container" class="edit-address-form-wrapper"
                            style="{{ $errors->any() ? 'display: block;' : 'display: none;' }}">
                            <div class="form-header">
                                <h3 class="form-title">Update Address Details</h3>
                                <button onclick="toggleAddressForm()" class="close-form-btn"><i
                                        class="fas fa-times"></i></button>
                            </div>

                            <form action="{{ route('customer.address.update') }}" method="POST" id="addressForm"
                                class="premium-form" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Phone Number <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-phone"></i>
                                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                                placeholder="10-digit mobile number" maxlength="10"
                                                class="@error('phone') is-invalid @enderror"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Country <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-globe"></i>
                                            <input type="text" name="country" value="{{ old('country', $user->country) }}"
                                                placeholder="e.g. India" class="@error('country') is-invalid @enderror"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                        </div>
                                        @error('country') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Street Address <span>*</span></label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" name="address_line1"
                                            value="{{ old('address_line1', $user->address_line1) }}"
                                            placeholder="House No, Building Name, Street"
                                            class="mb-3 @error('address_line1') is-invalid @enderror">
                                    </div>
                                    @error('address_line1') <span class="error-msg">{{ $message }}</span> @enderror
                                    <div class="input-with-icon mt-3">
                                        <i class="fas fa-building"></i>
                                        <input type="text" name="address_line2"
                                            value="{{ old('address_line2', $user->address_line2) }}"
                                            placeholder="Area, Landmark (Optional)"
                                            class="@error('address_line2') is-invalid @enderror">
                                    </div>
                                    @error('address_line2') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Town / City <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-city"></i>
                                            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                                placeholder="City" class="@error('city') is-invalid @enderror"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                        </div>
                                        @error('city') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>State <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <select name="state" class="form-control @error('state') is-invalid @enderror" style="padding-left: 55px !important;">
                                                <option value="">Select State</option>
                                                <option value="Andaman and Nicobar Islands" {{ old('state', $user->state) == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                                                <option value="Andhra Pradesh" {{ old('state', $user->state) == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh" {{ old('state', $user->state) == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                                <option value="Assam" {{ old('state', $user->state) == 'Assam' ? 'selected' : '' }}>Assam</option>
                                                <option value="Bihar" {{ old('state', $user->state) == 'Bihar' ? 'selected' : '' }}>Bihar</option>
                                                <option value="Chandigarh" {{ old('state', $user->state) == 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                                <option value="Chhattisgarh" {{ old('state', $user->state) == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh</option>
                                                <option value="Dadra and Nagar Haveli and Daman and Diu" {{ old('state', $user->state) == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>Dadra and Nagar Haveli and Daman and Diu</option>
                                                <option value="Delhi" {{ old('state', $user->state) == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                                <option value="Goa" {{ old('state', $user->state) == 'Goa' ? 'selected' : '' }}>Goa</option>
                                                <option value="Gujarat" {{ old('state', $user->state) == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                                <option value="Haryana" {{ old('state', $user->state) == 'Haryana' ? 'selected' : '' }}>Haryana</option>
                                                <option value="Himachal Pradesh" {{ old('state', $user->state) == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir" {{ old('state', $user->state) == 'Jammu and Kashmir' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                                <option value="Jharkhand" {{ old('state', $user->state) == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                                <option value="Karnataka" {{ old('state', $user->state) == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                                <option value="Kerala" {{ old('state', $user->state) == 'Kerala' ? 'selected' : '' }}>Kerala</option>
                                                <option value="Ladakh" {{ old('state', $user->state) == 'Ladakh' ? 'selected' : '' }}>Ladakh</option>
                                                <option value="Lakshadweep" {{ old('state', $user->state) == 'Lakshadweep' ? 'selected' : '' }}>Lakshadweep</option>
                                                <option value="Madhya Pradesh" {{ old('state', $user->state) == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh</option>
                                                <option value="Maharashtra" {{ old('state', $user->state) == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                                <option value="Manipur" {{ old('state', $user->state) == 'Manipur' ? 'selected' : '' }}>Manipur</option>
                                                <option value="Meghalaya" {{ old('state', $user->state) == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                                <option value="Mizoram" {{ old('state', $user->state) == 'Mizoram' ? 'selected' : '' }}>Mizoram</option>
                                                <option value="Nagaland" {{ old('state', $user->state) == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                                <option value="Odisha" {{ old('state', $user->state) == 'Odisha' ? 'selected' : '' }}>Odisha</option>
                                                <option value="Puducherry" {{ old('state', $user->state) == 'Puducherry' ? 'selected' : '' }}>Puducherry</option>
                                                <option value="Punjab" {{ old('state', $user->state) == 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                                <option value="Rajasthan" {{ old('state', $user->state) == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                                <option value="Sikkim" {{ old('state', $user->state) == 'Sikkim' ? 'selected' : '' }}>Sikkim</option>
                                                <option value="Tamil Nadu" {{ old('state', $user->state) == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                                <option value="Telangana" {{ old('state', $user->state) == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                                <option value="Tripura" {{ old('state', $user->state) == 'Tripura' ? 'selected' : '' }}>Tripura</option>
                                                <option value="Uttar Pradesh" {{ old('state', $user->state) == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                                                <option value="Uttarakhand" {{ old('state', $user->state) == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                                <option value="West Bengal" {{ old('state', $user->state) == 'West Bengal' ? 'selected' : '' }}>West Bengal</option>
                                            </select>
                                        </div>
                                        @error('state') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>PIN Code <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-map-pin"></i>
                                            <input type="text" name="postal_code"
                                                value="{{ old('postal_code', $user->postal_code) }}" placeholder="6-digit PIN"
                                                maxlength="6" class="@error('postal_code') is-invalid @enderror"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        @error('postal_code') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-luxury-submit">Update My Address</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Premium Address Page Styles */
        :root {
            --primary: #004200;
            --accent: #d4af37;
            --bg-light: #f8faf8;
            --card-bg: #ffffff;
            --border-soft: rgba(0, 66, 0, 0.1);
        }

        .luxury-account-page {
            background-color: var(--bg-light);
            padding: 120px 0 100px !important;
            min-height: 100vh;
        }

        .account-page-header {
            margin-bottom: 40px;
            padding-bottom: 20px;
            margin-top: 10px;
        }

        /* Navbar Visibility Hack for Wishlist/Account Pages */
        #main-header:not(.scrolled) {
            background: rgba(0, 48, 0, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            padding: 15px 0 !important;
        }

        @media (max-width: 480px) {
            .luxury-account-page {
                padding: 90px 0 60px !important;
            }

            .address-cards-grid{
                margin-bottom: 25px !important;
            }
            .luxury-account-page .container {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .account-page-header {
                margin-bottom: 25px;
                margin-top: 15px;
                text-align: left;
            }

            .account-title {
                font-size: 24px !important;
                margin-bottom: 5px;
            }

            .account-breadcrumb {
                justify-content: flex-start;
                font-size: 12px;
            }

            .account-grid {
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 15px !important;
            }

            .account-sidebar-col,
            .account-main-content {
                width: 100% !important;
                max-width: 100% !important;
            }

            .section-card {
                padding: 20px 10px !important;
                border-radius: 15px;
            }

            .section-header-flex {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                border-bottom: 1px solid var(--border-soft);
            }

            .premium-section-title {
                font-size: 22px !important;
            }

            .section-subtitle {
                font-size: 14px !important;
            }

            .full-address{
                font-size: 0.85rem !important;
            }

            .recipient-name{
                font-size: 1.2rem !important;
            }

            .card-type-badge{
                font-size: 0.6rem !important;
            }
            .address-cards-grid {
                gap: 15px;
            }

            .premium-address-card {
                padding: 15px;
                border-radius: 15px;
            }

            .recipient-name {
                font-size: 18px;
                margin-bottom: 8px;
            }

            .phone-number {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .full-address {
                font-size: 13px;
                line-height: 1.5;
                margin-bottom: 15px;
            }

            .card-type-badge {
                padding: 4px 12px;
                font-size: 10px;
                margin-bottom: 15px;
            }

            .edit-btn {
                padding: 10px;
                font-size: 13px;
            }

            .edit-address-form-wrapper {
                padding: 15px 12px !important;
                border-radius: 12px;
            }

            .form-header {
                margin-bottom: 15px;
                padding-bottom: 10px;
            }

            .form-title {
                font-size: 1rem !important;
                font-weight: 700;
                line-height: 1.2;
            }

            .close-form-btn {
                font-size: 16px;
            }

            .premium-form .form-row {
                gap: 10px !important;
                margin-bottom: 10px !important;
                display: flex !important;
                flex-direction: column !important;
            }

            .premium-form .form-group {
                margin-bottom: 12px !important;
            }

            .premium-form label {
                font-size: 13px !important;
                margin-bottom: 5px !important;
            }

            .premium-form input {
                padding: 10px 15px 10px 40px !important;
                font-size: 13px !important;
                border-radius: 10px !important;
            }

            .input-with-icon i {
                left: 15px !important;
                font-size: 14px !important;
            }

            .btn-luxury-submit {
                padding: 12px;
                font-size: 14px;
                margin-top: 10px;
            }

            .input-with-icon + .input-with-icon,
            .input-with-icon + .error-msg + .input-with-icon {
                margin-top: 15px !important;
            }
        }

        @media (max-width: 360px) {
            .account-title {
                font-size: 20px;
            }

            .premium-section-title {
                font-size: 18px;
            }

            .recipient-name {
                font-size: 16px;
            }

            .full-address {
                font-size: 12px;
            }

            .section-card {
                padding: 12px 8px !important;
            }

            .premium-address-card {
                padding: 10px;
            }

            .form-title {
                font-size: 1rem !important;
            }
        }

        @media(max-width: 768px){
            .form-title {
                font-size: 1.2rem !important;
            }
        }

        .account-title {
            font-size: 28px !important;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .account-breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .account-breadcrumb a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .account-breadcrumb .separator {
            opacity: 0.3;
            font-size: 0.7rem;
        }

        /* Grid Layout */
        .account-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 50px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .account-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .luxury-account-page .container {
                padding-left: 20px !important;
                padding-right: 20px !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }

        /* Content Area */
        .section-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 66, 0, 0.04);
            border: 1px solid var(--border-soft);
        }

        .premium-section-title {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: #555;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Address Cards */
        .address-cards-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }

        .premium-address-card {
            background: #fdfdfd;
            border-radius: 20px;
            padding: 30px;
            border: 1px solid #eee;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .premium-address-card:hover {
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 66, 0, 0.05);
        }

        .card-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: var(--accent);
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            width: fit-content;
        }

        .recipient-name {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .phone-number {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .full-address {
            font-size: 1rem;
            line-height: 1.7;
            color: #444;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .edit-btn {
            width: 100%;
            padding: 14px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 50px;
            color: var(--primary);
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .edit-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .default-card {
            border: 2px solid var(--primary) !important;
            background: #fff !important;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.05);
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .set-default-btn {
            flex: 1;
            padding: 14px;
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 50px;
            color: #666;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .set-default-btn:hover {
            background: #e0e0e0;
            color: #333;
        }

        /* Form Styling - FIXED ALIGNMENT */
        .edit-address-form-wrapper {
            background: #fcfcfc;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid var(--border-soft);
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .form-title {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .close-form-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #999;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-form-btn:hover {
            color: #cc0000;
        }

        .premium-form .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }

        .premium-form .form-group {
            margin-bottom: 25px;
        }

        .premium-form label {
            display: block;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .premium-form label span {
            color: #cc0000;
        }

        /* Input Icon Fix */
        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon + .input-with-icon,
        .input-with-icon + .error-msg + .input-with-icon {
            margin-top: 15px !important;
        }

        .input-with-icon i {
            position: absolute;
            left: 20px;
            color: var(--primary);
            opacity: 0.7;
            pointer-events: none;
            font-size: 1.1rem;
        }

        .premium-form input {
            width: 100%;
            padding: 15px 20px 15px 55px !important;
            /* Force left padding for icon */
            border-radius: 14px;
            border: 1px solid #e0e0e0;
            background: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            color: #333;
        }

        /* Regular inputs without icon */
        .premium-form .form-group:not(.input-with-icon)>input,
        .premium-form .form-row .form-group>input:not(.input-with-icon input) {
            padding: 15px 20px;
        }

        .premium-form input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 66, 0, 0.05);
            outline: none;
        }

        .btn-luxury-submit {
            background: var(--primary);
            color: var(--accent) !important;
            width: 100%;
            padding: 18px;
            border-radius: 50px;
            border: none;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.4s;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.2);
        }

        .btn-luxury-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 66, 0, 0.3);
        }

        .error-msg {
            color: #d32f2f;
            font-size: 0.75rem;
            margin-top: 5px;
            display: block;
            font-weight: 600;
            text-align: left;
        }

        .premium-form input.is-invalid {
            border-color: #d32f2f !important;
            background-color: rgba(211, 47, 47, 0.02) !important;
        }

        label.error {
            color: #d32f2f;
            font-size: 0.75rem;
            margin-top: 5px;
            display: block;
            font-weight: 600;
            text-transform: none;
            letter-spacing: 0;
        }

        @media (max-width: 768px) {
            .address-cards-grid {
                grid-template-columns: 1fr;
            }

            .premium-form .form-row {
                grid-template-columns: 1fr;
            }

            .luxury-account-page .container {
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            @if($errors->any())
                // No need to call show() here anymore as it's handled by inline CSS,
                // but we still want to scroll to the form if there are errors.
                $('html, body').animate({
                    scrollTop: $("#edit-address-container").offset().top - 100
                }, 500);
            @endif

            $("#addressForm").validate({
                rules: {
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    country: {
                        required: true,
                        minlength: 2
                    },
                    address_line1: {
                        required: true,
                        minlength: 5
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    postal_code: {
                        required: true,
                        minlength: 5,
                        maxlength: 10
                    }
                },
                messages: {
                    phone: {
                        required: "Please enter your phone number",
                        minlength: "Phone number must be at least 10 digits"
                    },
                    country: {
                        required: "Please enter your country"
                    },
                    address_line1: {
                        required: "Please enter your street address"
                    },
                    city: {
                        required: "Please enter your city"
                    },
                    state: {
                        required: "Please enter your state"
                    },
                    postal_code: {
                        required: "Please enter your portal code"
                    }
                },
                errorElement: "span",
                errorClass: "error-msg",
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function (error, element) {
                    if (element.closest('.input-with-icon').length) {
                        error.insertAfter(element.closest('.input-with-icon'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        function toggleAddressForm() {
            const form = document.getElementById('edit-address-container');
            const title = document.querySelector('.form-title');
            
            if (form.style.display === 'none') {
                $(form).fadeIn();
                setTimeout(() => {
                    form.scrollIntoView({ behavior: 'smooth' });
                }, 300);
            } else {
                $(form).fadeOut();
            }
        }

        function editAddress(address) {
            const form = document.getElementById('edit-address-container');
            const title = document.querySelector('.form-title');
            
            // Populate fields
            document.querySelector('input[name="phone"]').value = address.phone;
            document.querySelector('input[name="country"]').value = address.country;
            document.querySelector('input[name="address_line1"]').value = address.address_line1;
            document.querySelector('input[name="address_line2"]').value = address.address_line2 || '';
            document.querySelector('input[name="city"]').value = address.city;
            document.querySelector('select[name="state"]').value = address.state;
            document.querySelector('input[name="postal_code"]').value = address.postal_code;
            
            title.innerText = 'Update Address Details';
            
            if (form.style.display === 'none') {
                $(form).fadeIn();
            }
            
            form.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
@endsection