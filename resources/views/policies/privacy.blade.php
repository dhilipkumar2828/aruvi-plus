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
                <h4>Who we are</h4>
                <p>Our website address is: https://auvriplus.com</p>

                <h4>What personal data we collect and why we collect it</h4>
                
                <h4>Comments</h4>
                <p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor’s IP address and browser user agent string to help spam detection.</p>
                <p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>

                <h4>Media</h4>
                <p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>

                <h4>Contact forms & Cookies</h4>
                <p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>
                <p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>
                <p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select “Remember Me”, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>
                <p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>

                <h4>Embedded content from other websites</h4>
                <p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>
                <p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>

                <h4>Who we share your data with & How long we retain your data</h4>
                <p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>
                <p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>

                <h4>What rights you have over your data</h4>
                <p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>

                <h4>Where we send your data</h4>
                <p>Visitor comments may be checked through an automated spam detection service.</p>
            </div>
        </div>
    </div>
</div>
@endsection
