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
                        <!-- Billing Address -->
                        {{-- <div class="premium-address-card">
                            <div class="card-type-badge"><i class="fas fa-file-invoice"></i> Billing</div>
                            <div class="address-details">
                                @if($user->address_line1)
                                    <h4 class="recipient-name">{{ $user->name }}</h4>
                                    <p class="phone-number"><i class="fas fa-phone-alt"></i> {{ $user->phone }}</p>
                                    <p class="full-address">
                                        {{ $user->address_line1 }}<br>
                                        @if($user->address_line2) {{ $user->address_line2 }}<br> @endif
                                        {{ $user->city }}, {{ $user->state }} - {{ $user->postal_code }}<br>
                                        {{ $user->country }}
                                    </p>
                                @else
                                    <p class="no-address">No billing address set yet.</p>
                                @endif
                            </div>
                            <button onclick="toggleAddressForm()" class="edit-btn">
                                <i class="fas fa-edit"></i> Edit Address
                            </button>
                        </div> --}}

                        <!-- Shipping Address -->
                        <div class="premium-address-card">
                            <div class="card-type-badge"><i class="fas fa-truck"></i> Shipping</div>
                            <div class="address-details">
                                @if($user->address_line1)
                                    <h4 class="recipient-name">{{ $user->name }}</h4>
                                    <p class="phone-number"><i class="fas fa-phone-alt"></i> {{ $user->phone }}</p>
                                    <p class="full-address">
                                        {{ $user->address_line1 }}<br>
                                        @if($user->address_line2) {{ $user->address_line2 }}<br> @endif
                                        {{ $user->city }}, {{ $user->state }} - {{ $user->postal_code }}<br>
                                        {{ $user->country }}
                                    </p>
                                @else
                                    <p class="no-address">No shipping address set yet.</p>
                                @endif
                            </div>
                            <button onclick="toggleAddressForm()" class="edit-btn">
                                <i class="fas fa-edit"></i> Edit Address
                            </button>
                        </div>
                    </div>

                    <!-- Edit Address Form (Hidden by default) -->
                    <div id="edit-address-container" class="edit-address-form-wrapper" style="{{ $errors->any() ? 'display: block;' : 'display: none;' }}">
                        <div class="form-header">
                            <h3 class="form-title">Update Address Details</h3>
                            <button onclick="toggleAddressForm()" class="close-form-btn"><i class="fas fa-times"></i></button>
                        </div>
                        
                        <form action="{{ route('customer.address.update') }}" method="POST" id="addressForm" class="premium-form" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Phone Number <span>*</span></label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="10-digit mobile number" maxlength="10" class="@error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Country <span>*</span></label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-globe"></i>
                                        <input type="text" name="country" value="{{ old('country', $user->country) }}" placeholder="e.g. India" class="@error('country') is-invalid @enderror" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                    </div>
                                    @error('country') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Street Address <span>*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" name="address_line1" value="{{ old('address_line1', $user->address_line1) }}" placeholder="House No, Building Name, Street" class="mb-3 @error('address_line1') is-invalid @enderror">
                                </div>
                                @error('address_line1') <span class="error-msg">{{ $message }}</span> @enderror
                                <div class="input-with-icon mt-3">
                                    <i class="fas fa-building"></i>
                                    <input type="text" name="address_line2" value="{{ old('address_line2', $user->address_line2) }}" placeholder="Area, Landmark (Optional)" class="@error('address_line2') is-invalid @enderror">
                                </div>
                                @error('address_line2') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Town / City <span>*</span></label>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="City" class="@error('city') is-invalid @enderror" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                    @error('city') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>State <span>*</span></label>
                                    <input type="text" name="state" value="{{ old('state', $user->state) }}" placeholder="State" class="@error('state') is-invalid @enderror" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                    @error('state') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>PIN Code <span>*</span></label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" placeholder="6-digit PIN" maxlength="6" class="@error('postal_code') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
        padding: 60px 0 100px;
        min-height: 100vh;
    }

    .account-page-header {
        margin-bottom: 40px;
        /* border-bottom: 2px solid var(--border-soft); */
        padding-bottom: 20px;
        margin-top: 30px;
    }

    .account-title {
        font-size: 2.5rem;
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
        margin-bottom: 30px;
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

    /* Form Styling - FIXED ALIGNMENT */
    .edit-address-form-wrapper {
        background: #fcfcfc;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid var(--border-soft);
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
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

    .close-form-btn:hover { color: #cc0000; }

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
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .premium-form label span { color: #cc0000; }

    /* Input Icon Fix */
    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
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
        padding: 15px 20px 15px 55px !important; /* Force left padding for icon */
        border-radius: 14px;
        border: 1px solid #e0e0e0;
        background: #fff;
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #333;
    }

    /* Regular inputs without icon */
    .premium-form .form-group:not(.input-with-icon) > input,
    .premium-form .form-row .form-group > input:not(.input-with-icon input) {
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
        .address-cards-grid { grid-template-columns: 1fr; }
        .premium-form .form-row { grid-template-columns: 1fr; }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
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
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function(error, element) {
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
    if (form.style.display === 'none') {
        $(form).fadeIn();
        setTimeout(() => {
            form.scrollIntoView({ behavior: 'smooth' });
        }, 300);
    } else {
        $(form).fadeOut();
    }
}
</script>
@endsection
