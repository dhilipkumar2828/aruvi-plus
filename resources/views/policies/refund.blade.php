@extends('layouts.auri')

@section('title', 'Return & Refund Policy | Auvri Plus')

@section('extra_css')
<style>
    .policy-wrapper {
        background-color: #f9fbf9;
        padding-bottom: 80px;
    }
    .policy-hero {
        background: linear-gradient(rgba(0, 66, 0, 0.7), rgba(0, 66, 0, 0.7)), url('{{ asset('auri-images/headers/refund_v2.jpg') }}');
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
            <h1>Return & Refund</h1>
            <p>Our fair policies for your satisfaction and peace of mind.</p>
        </div>
    </div>

    <div class="container">
        <div class="policy-card animate-fade">
            <h2 class="section-title">Returns & Refunds</h2>
            <div class="policy-content">
                <p>We want you to be completely satisfied with your purchase from Auvri Plus. If you are not satisfied, we are here to help.</p>
                
                <h4>1. Returns</h4>
                <p>You have 7 working days from the date of delivery to return an item. To be eligible for a return, the item must be unused and in the same condition as when you received it. It must also be in the original packaging.</p>
                
                <h4>2. Refunds</h4>
                <p>Once we receive your item, we will inspect it and notify you that we have received your returned item. We will immediately notify you on the status of your refund after inspecting the item. If your return is approved, we will initiate a refund to your original method of payment.</p>
                
                <h4>3. Shipping</h4>
                <p>You will be responsible for paying your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>
                
                <h4>4. Non-Refundable Items</h4>
                <p>Certain items, such as opened herbal remedies or custom-made spiritual artifacts, may be ineligible for returns due to hygiene and cultural reasons.</p>
                
                <p class="mt-5 text-muted">Last updated: {{ date('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
