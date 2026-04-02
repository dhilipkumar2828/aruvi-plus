@extends('layouts.auri')

@section('title', 'FAQ - Auvri Plus | Frequently Asked Questions')
@section('meta_description', 'Find answers to common questions about our Ayurvedic products, shipping, and wellness practices.')

@section('content')
    <!-- FAQ Hero -->
    <section class="faq-hero" style="background-image: linear-gradient(rgba(0, 66, 0, 0.6), rgba(0, 66, 0, 0.6)), url('{{ asset('auri-images/headers/faq_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 300px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff;">
        <div class="container hero-inner">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 10px;">How can we help?</span>
            <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; line-height: 1.2;">Frequently Asked Questions</h1>
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
                            ['q' => 'What is a Detox Diet?', 'a' => 'A detox diet is a short-period dietary approach designed to help eliminate toxins from the body. It typically includes:<br>• A period of fasting<br>• A strict diet of fruits, vegetables, fruit juices, and water<br>• Herbs, teas, supplements, and colon cleanses or enemas'],
                            ['q' => 'What are the benefits of a Detox Diet?', 'a' => 'A detox diet may help:<br>• Stimulate the liver to remove toxins<br>• Promote toxin elimination through feces, urine, and sweat<br>• Improve circulation<br>• Provide healthy nutrients to the body'],
                            ['q' => 'How to use Auvriplus Detox Weight Loss Powder', 'a' => 'Suggested usage:<br>• Take 1.5 spoons of Auvriplus Detox Weight Loss Powder<br>• Mix with warm water<br>• Drink 30 minutes after dinner'],
                            ['q' => 'Can it be taken with medications?', 'a' => 'The Detox Weight Loss Powder is a food supplement made from essential nutrients and free of chemicals. It is generally safe to take with medications. However, it is not intended for pregnant women, nursing mothers, or children under the age of 12.'],
                            ['q' => 'Are there any side effects?', 'a' => 'The product uses 100% natural herbs and is formulated by Brahma Rishi Agathiyar. It does not contain chemicals or preservatives and does not have side effects as per the FAQ.'],
                            ['q' => 'Is Auvriplus Detox Weight Loss Powder natural?', 'a' => 'Yes — it is completely natural, free from chemicals and preservatives. It is made of five ancient herbal ingredients:<br>• Cuminum cyminum<br>• Indigofera tinctoria<br>• Terminalia<br>• Acalypha indica<br>• Abutilon indicum'],
                            ['q' => 'How many days to see weight loss results?', 'a' => 'Results vary between individuals based on diet and exercise habits. If taken daily for one mandalam (48 days), it claims you can lose about 10% of body weight naturally without special diet or exercise.'],
                            ['q' => 'Other benefits of Auvriplus Detox Weight Loss Powder', 'a' => 'The product may also help to:<br>• Boost metabolism<br>• Burn extra fat<br>• Improve blood circulation<br>• Regulate cholesterol<br>• Aid proper digestion'],
                            ['q' => 'How long does one bottle last?', 'a' => 'Depending on the pack size:<br>• 75 g pack lasts approximately 30 days<br>• 25 g pack lasts approximately 10 days when taken daily'],
                        ];
                        @endphp
                        @foreach($faqs as $faq)
                        <div class="acc-item" onclick="this.classList.toggle('active'); this.querySelector('.fas').classList.toggle('fa-chevron-down'); this.querySelector('.fas').classList.toggle('fa-chevron-up');">
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
