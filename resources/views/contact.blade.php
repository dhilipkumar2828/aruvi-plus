@extends('layouts.auri')

@section('title', 'Contact Us | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<section class="hero-small" style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1>Contact Us</h1>
        <p>We’re here to help with your Navapashanam journey.</p>
    </div>
</section>

<section class="section-padding" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="grid-2">
            <div class="contact-info-card">
                <img src="{{ asset('auri-images/logo.png') }}" alt="Bogar Siddha Peedam - Bogar Alchemist LLP" style="width: 150px; display: block; margin: 0 auto 20px auto;">
                <h3 class="mt-0" style="font-weight: 700 !important; font-size: 22px !important;">Reach Us</h3>
                <p style="color: #666; line-height: 1.8;">Share your questions, rituals, or product inquiries and our team will respond shortly.</p>
                <div class="contact-details mt-4">
                    @php
                        // Fetch the first registered admin (Main Store Owner)
                        $admin = \App\Models\User::where('role', 'admin')->orderBy('id', 'asc')->first();
                        
                        // Default Static Data
                        $contactAddress = 'Palani, Tamil Nadu, India - 624601';
                        $contactEmail = 'contact@bogarpeedam.com';
                        $contactPhone = '+91 98765 43210';

                        if ($admin) {
                            // Address Construction
                            $hasAddress = $admin->address_line1 || $admin->city || $admin->state || $admin->country;
                            if ($hasAddress) {
                                $addr = '';
                                if ($admin->address_line1) $addr .= $admin->address_line1 . ', ';
                                if ($admin->city) $addr .= $admin->city;
                                if ($admin->city && $admin->state) $addr .= ', ';
                                if ($admin->state) $addr .= $admin->state;
                                if ($admin->city || $admin->state) $addr .= ', ';
                                if ($admin->country) $addr .= $admin->country;
                                if ($admin->postal_code) $addr .= ' - ' . $admin->postal_code;
                                
                                $contactAddress = $addr;
                            }

                            if ($admin->email) $contactEmail = $admin->email;
                            if ($admin->phone) $contactPhone = $admin->phone;
                        }
                        $cleanPhone = preg_replace('/[^0-9]/', '', $contactPhone);
                    @endphp
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{!! $contactAddress !!}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span><a href="mailto:{{ $contactEmail }}" style="color: inherit; text-decoration: none;">{{ $contactEmail }}</a></span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <span><a href="https://wa.me/{{ $cleanPhone }}" target="_blank" style="color: inherit; text-decoration: none;">{{ $contactPhone }}</a></span>
                    </div>
                </div>
            </div>

            <div class="contact-form-card">
                <h3 class="mt-0" style="font-weight: 700 !important; font-size: 22px !important; margin-bottom: 20px !important;">Send an Inquiry</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required class="form-control">
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message (optional)" rows="5" class="form-control" style="resize: none;">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn-premium w-100">Send Inquiry</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Add custom method for letters only
        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Please enter only letters.");

        // Add custom method for numeric only
        $.validator.addMethod("numericOnly", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Please enter only numbers.");

        $(".contact-form").validate({
            rules: {
                name: {
                    required: true,
                    lettersOnly: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    numericOnly: true
                },
                message: {
                    required: false
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    lettersOnly: "Name must contain only letters"
                },
                email: "Please enter a valid email address",
                phone: {
                    required: "Please enter your phone number",
                    numericOnly: "Phone number must contain only numbers"
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
