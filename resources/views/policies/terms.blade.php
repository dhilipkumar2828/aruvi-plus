@extends('layouts.auri')

@section('title', 'Terms and Conditions | Auvri Plus')

@section('extra_css')
<style>
    .policy-wrapper {
        background-color: #f9fbf9;
        padding-bottom: 80px;
    }
    .policy-hero {
        background: linear-gradient(rgba(0, 66, 0, 0.7), rgba(0, 66, 0, 0.7)), url('{{ asset('auri-images/headers/terms_v2.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        text-align: center;
        color: white;
        margin-bottom: 50px;
    }
    .policy-hero h1 {
        color: #d4af37 !important;
        font-family: 'Playfair Display', serif;
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
            <h1>Terms & Conditions</h1>
            <p>Your agreement and understanding of our sacred services.</p>
        </div>
    </div>

    <div class="container">
        <div class="policy-card animate-fade">
            <h2 class="section-title">Terms of Service</h2>
            <div class="policy-content">
                <p>Welcome to Auvri Plus - Bogar Siddha Peedam. By accessing or using our website and services, you agree to be bound by the following terms and conditions.</p>
                
                <h4>1. General Use</h4>
                <p>The content provided on this website is for spiritual and wellness purposes. While we strive for accuracy, we do not guarantee the completeness or suitability of the information for any specific medical or scientific purpose.</p>
                
                <h4>2. Intellectual Property</h4>
                <p>All logos, images, text, and products displayed on this site are the intellectual property of Auvri Plus. Unauthorized use or reproduction is strictly prohibited.</p>
                
                <h4>3. Product Information</h4>
                <p>Our products are handcrafted and spiritual in nature. Variations in appearance and texture are normal and part of their unique character.</p>
                
                <h4>4. Limitation of Liability</h4>
                <p>Auvri Plus shall not be liable for any direct, indirect, or incidental damages resulting from the use or inability to use our products or services.</p>
                
                <h4>5. Governing Law</h4>
                <p>These terms are governed by the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in Tamil Nadu.</p>
                
                <p class="mt-5 text-muted">Last updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
