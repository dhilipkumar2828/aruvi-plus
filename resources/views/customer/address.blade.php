@extends('layouts.auri')

@section('title', 'Addresses | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<section class="hero-small" style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); margin-bottom: 0;">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="page-title" style="color: #fff; position: relative; z-index: 2;">My Account</h1>
        <div class="breadcrumb" style="position: relative; z-index: 2;">
            <a href="{{ url('/') }}" style="color: #eee;">Home</a> <span style="color: #ccc;">/</span> <strong style="color: #fff;">Addresses</strong>
        </div>
    </div>
</section>

<main class="main-content" style="padding-top: 0;">

    <div class="container account-container">
        <div class="account-layout">
            <div class="account-sidebar-col">
                @include('customer.sidebar')
            </div>
            <div class="account-main-content">
                <h3 class="account-section-title">
                    <i class="fas fa-map-marked-alt"></i> My Addresses
                </h3>
                
                <p class="mb-3" style="color: #555;">The following addresses will be used on the checkout page by default.</p>

                <div class="grid-2">
                    <div class="address-col">
                        <div class="account-card">
                            <h4 class="account-section-title" style="font-size: 18px; border-bottom: none; margin-bottom: 15px;">
                                <i class="fas fa-file-invoice"></i> Billing Address
                            </h4>
                            <div class="address-content" style="color: #555; line-height: 1.6; font-size: 15px;">
                                @if($user->address_line1)
                                    <strong style="color: var(--primary-color); font-size: 16px; display: block; margin-bottom: 5px;">{{ $user->name }}</strong>
                                    {{ $user->phone }}<br>
                                    {{ $user->address_line1 }}<br>
                                    @if($user->address_line2) {{ $user->address_line2 }}<br> @endif
                                    {{ $user->city }}, {{ $user->state }}<br>
                                    {{ $user->postal_code }}<br>
                                    {{ $user->country }}
                                @else
                                    <p>You have not set up this type of address yet.</p>
                                @endif
                            </div>
                            <button onclick="document.getElementById('edit-address-form').style.display='block'; window.location.href='#edit-address-form'" class="btn-premium btn-premium-sm" style="margin-top: 15px;">
                                <i class="fas fa-edit"></i> Edit Address
                            </button>
                        </div>
                    </div>
                    
                    <div class="address-col">
                        <div class="account-card">
                            <h4 class="account-section-title" style="font-size: 18px; border-bottom: none; margin-bottom: 15px;">
                                <i class="fas fa-truck"></i> Shipping Address
                            </h4>
                            <div class="address-content" style="color: #555; line-height: 1.6; font-size: 15px;">
                                @if($user->address_line1)
                                    <strong style="color: var(--primary-color); font-size: 16px; display: block; margin-bottom: 5px;">{{ $user->name }}</strong>
                                    {{ $user->phone }}<br>
                                    {{ $user->address_line1 }}<br>
                                    @if($user->address_line2) {{ $user->address_line2 }}<br> @endif
                                    {{ $user->city }}, {{ $user->state }}<br>
                                    {{ $user->postal_code }}<br>
                                    {{ $user->country }}
                                @else
                                    <p>You have not set up this type of address yet.</p>
                                @endif
                            </div>
                            <button onclick="document.getElementById('edit-address-form').style.display='block'; window.location.href='#edit-address-form'" class="btn-premium btn-premium-sm" style="margin-top: 15px;">
                                <i class="fas fa-edit"></i> Edit Address
                            </button>
                        </div>
                    </div>
                </div>

                <div id="edit-address-form" class="account-card" style="display: none; margin-top: 30px;">
                    <h3 class="account-section-title">
                        <i class="fas fa-edit"></i> Edit Address
                    </h3>
                    <form action="{{ route('customer.address.update') }}" method="POST" id="addressForm" novalidate>
                        @csrf
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Phone <span style="color: red;">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control" placeholder="e.g. 9876543210" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="form-group">
                                <label>Country / Region <span style="color: red;">*</span></label>
                                <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" class="form-control" placeholder="India" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Street Address <span style="color: red;">*</span></label>
                            <input type="text" name="address_line1" id="address_line1" value="{{ old('address_line1', $user->address_line1) }}" placeholder="House number and street name" class="form-control mb-3" required>
                            <input type="text" name="address_line2" id="address_line2" value="{{ old('address_line2', $user->address_line2) }}" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control">
                        </div>
                        <div class="grid-3">
                            <div class="form-group">
                                <label>Town / City <span style="color: red;">*</span></label>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" class="form-control" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                            <div class="form-group">
                                <label>State <span style="color: red;">*</span></label>
                                <input type="text" name="state" id="state" value="{{ old('state', $user->state) }}" class="form-control" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            </div>
                            <div class="form-group">
                                <label>PIN Code <span style="color: red;">*</span></label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="form-control" required maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <button type="submit" class="btn-premium" style="margin-top: 20px;">
                            <i class="fas fa-save"></i> Save Address
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Add custom method for letters only
        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Please enter only letters.");

        // Add custom method for exactly 10 digits
        $.validator.addMethod("exactLength", function(value, element, param) {
            return this.optional(element) || value.length == param;
        }, "Please enter exactly {0} digits.");

        // Add custom method for numeric only
        $.validator.addMethod("numericOnly", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Please enter only numbers.");

        $("#addressForm").validate({
            ignore: [], 
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
                address_line1: {
                    required: true
                },
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
                    numericOnly: "Phone number must contain only digits",
                    exactLength: "Phone number must be exactly 10 digits"
                },
                country: {
                    required: "Please enter your country",
                    lettersOnly: "Country name cannot contain numbers"
                },
                address_line1: {
                    required: "Please enter your street address"
                },
                city: {
                    required: "Please enter your city",
                    lettersOnly: "City name cannot contain numbers"
                },
                state: {
                    required: "Please enter your state",
                    lettersOnly: "State name cannot contain numbers"
                },
                postal_code: {
                    required: "Please enter your PIN code",
                    numericOnly: "PIN code must contain only digits",
                    exactLength: "PIN code must be exactly 6 digits"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.css({"color": "#d32f2f", "font-size": "13px", "margin-top": "6px", "font-weight": "400", "display": "block", "text-align": "left"});
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
