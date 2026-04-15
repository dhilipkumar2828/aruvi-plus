@extends('layouts.auri')

@section('title', 'FAQ - Auvri Plus | Frequently Asked Questions')
@section('meta_description', 'Find answers to common questions about our Ayurvedic products, shipping, and wellness practices.')

@section('content')
    <!-- FAQ Hero -->
    <section class="faq-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/faq_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 300px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff;">
        <div class="container hero-inner">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">How can we help?</span>
            <h1 class="sec-title" style="   font-size: 3.5rem; line-height: 1.2;">Frequently Asked Questions</h1>
            <p class="p-text" style="max-width: 800px; margin: 15px auto 0; opacity: 0.9; font-size: 1.1rem;">Find answers to common questions about our products, shipping, and Ayurvedic practices.</p>
        </div>
    </section>

    <!-- FAQ Container -->
    <section class="faq-main-section">
        <div class="container">
            <div class="faq-layout">
                <div class="faq-content">
                    <div class="accordion" id="faq-page-list">
                        @php
                        $faqs = [
                            ['q' => 'What is a Detox Diet?', 'a' => 'Detox diets are generally short period dietary mediations that aim to eliminate toxins from your body. A typical detox diet involves a period of fasting, a strict diet of fruit, vegetables, fruit juices, and water. Herbs, teas, supplements and colon cleanses or enemas.'],
                            ['q' => 'What are the benefits of Detox Diet?', 'a' => 'Stimulates your liver to get rid of toxins. Promote toxin elimination through feces, urine, and sweat. Improve circulation. Provide your body with healthy nutrients.'],
                            ['q' => 'How to use Auvriplus Detox Weight Loss Powder?', 'a' => '1. Take 1.5 spoon of Auvriplus Detox Weight Loss Powder.<br>2. Mix with warm water.<br>3. Drink 30 minutes after dinner.'],
                            ['q' => 'Is it OK to take Auvriplus Detox Weight Loss Powder with medications?', 'a' => 'Auvriplus Detox weight loss powder is a food supplement that contains essential nutrients for our body and free of chemicals. It is completely safe to take Auvriplus Detox weight loss powder. <strong>CAUTION:</strong> Auvriplus Detox Weight Loss Powder is not intended for pregnant women, nursing mothers or children under the age of 12.'],
                            ['q' => 'Is there any side effects of using Auvriplus Detox Weight Loss Powder?', 'a' => '100% Natural herbs are used to manufacture Auvriplus Detox Weight Loss Powder, formulated by Brahma Rishi Agathiyar. Does not have any side effects. No chemical or preservatives added.'],
                            ['q' => 'Is Auvriplus Detox Weight Loss Powder natural?', 'a' => 'Yes, Auvriplus detox is completely natural. It contains no chemical, no artificial color, no artificial flavor.'],
                            ['q' => 'How many days to see weight loss results?', 'a' => 'Weight loss varies from one person to another based on their diet and exercise. If you take Auvriplus Detox Weight Loss Powder daily for one mandalam (48 days), you will lose 10% of your body weight naturally without any special diet or exercise.'],
                            ['q' => 'What are the other benefits of Auvriplus Detox Weight Loss Powder?', 'a' => '1. Boosts metabolism<br>2. Burns extra fat<br>3. Improves blood circulation<br>4. Regulates cholesterol<br>5. Aids proper digestion'],
                            ['q' => 'How many days would a bottle of Auvriplus Detox Weight Loss Powder last?', 'a' => 'If taken daily: 75 grams pack of Auvriplus Detox Weight Loss Powder lasts for 30 days. 25 grams pack of Auvriplus Detox Weight Loss Powder lasts for 10 days.'],
                        ];
                        @endphp
                        @foreach($faqs as $faq)
                        <div class="acc-item" onclick="this.classList.toggle('active')">
                            <div class="acc-head">
                                {{ $faq['q'] }}
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="acc-body">
                                <p>{!! $faq['a'] !!}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
