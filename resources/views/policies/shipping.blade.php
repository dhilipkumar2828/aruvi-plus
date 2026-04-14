@extends('layouts.auri')

@section('title', 'Shipping Policy | Auvri Plus')

@section('extra_css')
<style>
    .policy-wrapper {
        background-color: #f9fbf9;
        padding-bottom: 80px;
    }
    .policy-hero {
        background: linear-gradient(rgba(0, 66, 0, 0.7), rgba(0, 66, 0, 0.7)), url('{{ asset('auri-images/headers/shipping_v2.jpg') }}');
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
            <h1>Shipping Policy</h1>
            <p>Our commitment to safe and timely delivery of your wellness essentials.</p>
        </div>
    </div>

    <div class="container">
        <div class="policy-card animate-fade">
            <h2 class="section-title">Shipping Policy</h2>
            <div class="policy-content">
                <p>We ensure that your sacred items are handled with care and delivered securely to your doorstep.</p>
                
                <h4>1. Processing Time</h4>
                <p>Orders are typically processed within 3-5 business days. Please note that certain handcrafted or energized items may require additional time for preparation.</p>
                
                <h4>2. Shipping Rates</h4>
                <p>Shipping charges for your order will be calculated and displayed at checkout. We offer standard and expressed shipping options depending on your location.</p>
                
                <h4>3. Domestic Shipping (India)</h4>
                <p>Domestic orders are usually delivered within 7-10 business days after dispatch. We use reputable courier services like BlueDart, Delhivery, or Speed Post.</p>
                
                <h4>4. International Shipping</h4>
                <p>We ship worldwide. International delivery times vary by destination but generally range from 15-25 business days. Customs duties and taxes, if applicable, are the responsibility of the customer.</p>
                
                <h4>5. Tracking</h4>
                <p>Once your order has shipped, you will receive an email with a tracking number to monitor your package.</p>
                
                <p class="mt-5 text-muted">Last updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
