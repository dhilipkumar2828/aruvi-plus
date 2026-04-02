@extends('layouts.auri')

@section('title', 'Contact Us - Auvri Plus | Get in Touch')
@section('meta_description', 'Have questions about our Ayurvedic remedies? Our team is here to help you on your wellness journey.')

@section('content')
    <!-- Contact Hero -->
    <section class="contact-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/contact-v2.png') }}'); background-size: cover; background-position: center; min-height: 300px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff;">
        <div class="container hero-inner">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">Get in Touch</span>
            <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; line-height: 1.2;">Connect with Auvriplus</h1>
            <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9; font-size: 1.1rem;">Have questions about our Ayurvedic remedies or need personalized advice? Our team is here to help you on your wellness journey.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-main-section">
        <div class="container">
            <div class="contact-layout">
                <!-- Contact Form -->
                <div class="contact-form-wrap">
                    <div class="glass-card contact-form-card" style="padding: 40px; background: rgba(255,255,255,0.9); backdrop-filter: blur(15px); border-radius: 30px; border: 1px solid rgba(0,66,0,0.1); box-shadow: 0 20px 60px rgba(0,66,0,0.08);">
                        <h3 style="font-family: var(--font-serif); font-size: 2rem; color: var(--primary); margin-bottom: 30px;">Send us a Message</h3>
                        <form id="main-contact-form" method="POST" action="{{ route('contact.store') }}" class="premium-form">
                            @csrf
                            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                                <div class="input-group">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #555;">Full Name</label>
                                    <input type="text" name="name" placeholder="Your Name" required value="{{ old('name') }}" style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #ddd; background: #fff; font-family: var(--font-main);">
                                    @error('name')<span style="color: red; font-size: 0.8rem;">{{ $message }}</span>@enderror
                                </div>
                                <div class="input-group">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #555;">Email Address</label>
                                    <input type="email" name="email" placeholder="Your Email" required value="{{ old('email') }}" style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #ddd; background: #fff; font-family: var(--font-main);">
                                    @error('email')<span style="color: red; font-size: 0.8rem;">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="input-group" style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #555;">Subject</label>
                                <input type="text" name="subject" placeholder="How can we help?" value="{{ old('subject') }}" style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #ddd; background: #fff; font-family: var(--font-main);">
                            </div>
                            <div class="input-group" style="margin-bottom: 30px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #555;">Message</label>
                                <textarea rows="5" name="message" placeholder="Tell us more about your inquiry..." required style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #ddd; background: #fff; font-family: var(--font-main);">{{ old('message') }}</textarea>
                                @error('message')<span style="color: red; font-size: 0.8rem;">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 18px; font-size: 1.1rem; justify-content: center;">Send Message <i class="fas fa-paper-plane" style="margin-left: 10px;"></i></button>
                        </form>
                    </div>
                </div>

                <!-- Contact Sidebar -->
                <div class="contact-sidebar">
                    <div class="info-block" style="display: flex; gap: 20px; margin-bottom: 40px;">
                        <div class="info-icon" style="width: 60px; height: 60px; background: rgba(129, 199, 132, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-txt">
                            <h4 style="font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary); margin-bottom: 8px;">Address</h4>
                            <p style="color: #666; line-height: 1.6;">Chennai, Tamil Nadu, India</p>
                        </div>
                    </div>
                    <div class="info-block" style="display: flex; gap: 20px; margin-bottom: 40px;">
                        <div class="info-icon" style="width: 60px; height: 60px; background: rgba(129, 199, 132, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-txt">
                            <h4 style="font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary); margin-bottom: 8px;">Contact</h4>
                            <p style="color: #666; font-weight: 600; font-size: 1.1rem;">+91 9818299669</p>
                            <span style="font-size: 0.85rem; color: #888;">Mon-Sat, 10 am - 7 pm</span>
                        </div>
                    </div>
                    <div class="info-block" style="display: flex; gap: 20px; margin-bottom: 40px;">
                        <div class="info-icon" style="width: 60px; height: 60px; background: rgba(129, 199, 132, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="info-txt">
                            <h4 style="font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary); margin-bottom: 8px;">WhatsApp</h4>
                            <p style="color: #666; font-weight: 600; font-size: 1.1rem;">+91 9818299669</p>
                            <span style="font-size: 0.85rem; color: #888;">Instant response during work hours</span>
                        </div>
                    </div>
                    <div class="info-block" style="display: flex; gap: 20px;">
                        <div class="info-icon" style="width: 60px; height: 60px; background: rgba(129, 199, 132, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="info-txt">
                            <h4 style="font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary); margin-bottom: 8px;">Email</h4>
                            <p style="color: #666; font-weight: 600;">click2mk@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Google Maps -->
        <section class="contact-map" style="margin-top: 60px;">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.64321683416!2d80.20142431482285!3d13.027018090819777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52670e1a6c4263%3A0xef03ef6da1b7e41d!2sAuvri%20Plus!5e0!3m2!1sen!2sin!4v1707660000000!5m2!1sen!2sin" width="100%" height="450" style="border:0; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,66,0,0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </section>
@endsection
