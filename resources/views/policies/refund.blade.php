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
                <h1>Return & Refund</h1>
                <p>Our fair policies for your satisfaction and peace of mind.</p>
            </div>
        </div>

        <div class="container">
            <div class="policy-card animate-fade">
                <h2 class="section-title">Returns & Refunds</h2>
                <div class="policy-content">
                    <h4>Overview</h4>
                    <p>Our refund and returns policy lasts 30 days. If 30 days have passed since your purchase, we can’t
                        offer you a full refund or exchange.</p>
                    <p>To be eligible for a return, your item must be unused and in the same condition that you received it.
                        It must also be in the original packaging.</p>
                    <p>To complete your return, we require a receipt or proof of purchase.</p>

                    <h4>Refunds</h4>
                    <p>Once your return is received and inspected, we will send you an email to notify you that we have
                        received your returned item. We will also notify you of the approval or rejection of your refund.
                    </p>
                    <p>If you are approved, then your refund will be processed, and a credit will automatically be applied
                        to your credit card or original method of payment, within a 10 days.</p>

                    <h4>Late or missing refunds</h4>
                    <p>If you haven’t received a refund yet, first check your bank account again.</p>
                    <p>Then contact your credit card company, it may take some time before your refund is officially posted.
                    </p>
                    <p>Next contact your bank. There is often some processing time before a refund is posted.</p>
                    <p>If you’ve done all of this and you still have not received your refund yet, please contact us.</p>

                    <h4>Sale items</h4>
                    <p>Only regular priced items may be refunded. Sale items cannot be refunded.</p>

                    <h4>Shipping returns</h4>
                    <p>To return your product, you should mail your product. You will be responsible for paying for your own
                        shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund,
                        the cost of return shipping will be deducted from your refund.</p>
                    <p>Depending on where you live, the time it may take for your exchanged product to reach you may vary.
                    </p>
                    <p>If you are returning more expensive items, you may consider using a trackable shipping service or
                        purchasing shipping insurance. We don’t guarantee that we will receive your returned item.</p>

                    <h4>Need help?</h4>
                    <p>Contact us for questions related to refunds and returns.</p>

                </div>
            </div>
        </div>
    </div>
@endsection