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
            <h2 class="section-title text-center">Terms & Conditions</h2>
            <div class="policy-content">
                <p>Please read these Terms and Conditions (“Terms”, “Terms and Conditions”) carefully before using the https://auvriplus.com/ website (the “Service”) operated by Auvriplus (“us”, “we”, or “our”).</p>
                <p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>
                <p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service. The Terms and Conditions agreement for AUVRIPLUS is based on the TermsFeed’s Terms and Conditions Template.</p>

                <h4>Accounts</h4>
                <p>When you create an account with us, you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>
                <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>
                <p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>

                <h4>Links to Other Web Sites</h4>
                <p>Our Service may contain links to third-party websites or services that are not owned or controlled by AUVRIPLUS.</p>
                <p>AUVRIPLUS has no control over and assumes no responsibility for, the content, privacy policies, or practices of any third party websites or services. You further acknowledge and agree that AUVRIPLUS shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such websites or services.</p>
                <p>We strongly advise you to read the terms and conditions and privacy policies of any third-party websites or services that you visit.</p>

                <h4>Termination</h4>
                <p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
                <p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
                <p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>

                <h4>Governing Law</h4>
                <p>These Terms shall be governed and construed in accordance with the laws of Tamil Nadu, India, without regard to its conflict of law provisions.</p>
                <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>

                <h4>Changes</h4>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is a material we will try to provide at least 30 days’ notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                <p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>

            </div>
        </div>
    </div>
</div>
@endsection
