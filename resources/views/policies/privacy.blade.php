@extends('layouts.auri')

@section('title', 'Privacy Policy | Auvri Plus')

@section('extra_css')
<style>
    .policy-wrapper {
        background-color: #f9fbf9;
        padding-bottom: 80px;
    }
    .policy-hero {
        background: linear-gradient(rgba(0, 66, 0, 0.7), rgba(0, 66, 0, 0.7)), url('{{ asset('auri-images/headers/privacy_v2.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        text-align: center;
        color: white;
        margin-bottom: 50px;
    }
    .policy-hero h1 {
        color: #d4af37 !important;
        font-size: 3.5rem;
    }
    .policy-card {
        background: white;
        border-radius: 24px;
        padding: 60px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        max-width: 900px;
        margin: 0 auto;
    }
    .policy-card h2 {
        color: var(--primary) !important;
        text-align: left;
        margin-bottom: 30px;
    }
    .policy-content h4 {
        color: var(--primary) !important;
        margin-top: 30px;
        margin-bottom: 15px;
    }
    .policy-content p {
        color: #555;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="policy-wrapper">
    <div class="policy-hero">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>Our commitment to your privacy and data protection.</p>
        </div>
    </div>

    <div class="container">
        <div class="policy-card animate-fade">
            <h2 class="section-title">Privacy Policy</h2>
            <div class="policy-content">
                <p>At Auvri Plus, we are committed to protecting your privacy. This policy outlines how we collect, use, and safeguard your personal information when you visit our website.</p>
                
                <h4>1. Information Collection</h4>
                <p>We collect information that you provide to us directly, such as when you create an account, make a purchase, or contact our support team. This may include your name, email address, phone number, and shipping address.</p>
                
                <h4>2. Use of Information</h4>
                <p>We use your information to process orders, provide customer support, and improve our services. We may also send you promotional emails about new products or special offers if you have opted in to receive them.</p>
                
                <h4>3. Data Security</h4>
                <p>We take appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure. However, no method of transmission over the internet or electronic storage is 100% secure.</p>
                
                <h4>4. Third-Party Services</h4>
                <p>We may use third-party services, such as payment processors and shipping providers, to help us provide our services. These third-party services have their own privacy policies.</p>
                
                <h4>5. Changes to This Policy</h4>
                <p>We may update this privacy policy from time to time. Any changes will be posted on this page with an updated revision date.</p>
                
                <p class="mt-5 text-muted">Last updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
