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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
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

        @media (max-width: 768px) {
            .policy-hero {
                padding: 60px 0;
            }

            .policy-hero h1 {
                font-size: 2.8rem;
            }

            .policy-card {
                padding: 40px;
                border-radius: 20px;
            }
        }

        @media (max-width: 600px) {
            .container {
                width: 100% !important;
                max-width: 100% !important;
            }
        }

        @media (max-width: 480px) {
            .policy-hero {
                padding: 40px 0;
            }

            .policy-hero h1 {
                font-size: 2rem;
            }

            .policy-hero p {
                font-size: 14px;
                padding: 0 15px;
            }

            .policy-card {
                padding: 30px 20px;
                border-radius: 15px;
            }

            .policy-card h2 {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }

            .policy-content h4 {
                font-size: 1.1rem;
            }

            .policy-content p {
                font-size: 14px;
            }
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
                    <h4>Processing & Dispatch</h4>
                    <p>We at Wide Wings, dispatch the order within 3-4 business days.</p>

                    <h4>Delivery Timeline</h4>
                    <p>All Products will be delivered within 10 business days.</p>
                </div>
            </div>
        </div>
    </div>
@endsection