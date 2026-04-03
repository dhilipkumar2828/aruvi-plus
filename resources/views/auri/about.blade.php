@extends('layouts.auri')

@section('title', 'About Us - Auvri Plus | Authenticity & Tradition')
@section('meta_description', 'Discover the ancient Ayurvedic wisdom behind Auvri Plus. Bridging tradition with modern living through the harmony of Panchabuthas.')

@section('content')
    <!-- 1. Immersive Hero -->
    <section class="about-hero-sec" style="background-image: linear-gradient(rgba(0, 66, 0, 0.5), rgba(0, 66, 0, 0.5)), url('{{ asset('auri-images/headers/about_v2.jpg') }}'); background-size: cover; background-position: center; min-height: 300px; display: flex; align-items: center; text-align: center; color: #fff; position: relative;">
        <div class="container hero-inner" style="max-width: 900px; margin: 0 auto; position: relative; z-index: 2;">
            <span class="sub-title" style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; opacity: 0.8; display: block; margin-bottom: 15px;">AUVRIPLUS TRADITION</span>
            <h1 class="sec-title" style="font-family: 'Playfair Display', serif; font-size: 4rem; line-height: 1.1; margin-bottom: 25px;">Authenticity & Tradition</h1>
            <p class="p-text" style="font-size: 1.2rem; line-height: 1.7; opacity: 0.95; margin: 0 auto;">Going way back to the ancient times, and infusing that wisdom to the present-day culture, is where we come from. Auvriplus is the best brand in the combination of authenticity and tradition to give the best products for Hair Care.<br>Our foundations come from the ancient ayurvedic scriptures and science.</p>
        </div>
    </section>

    <!-- 2. The Essence (Cinematic Split) -->
    <section class="about-story-sec">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <span class="sub-title" style="color: #004200; font-weight: 800;">Our Purpose</span>
                <h1 class="sec-title" style="color: #092e09;">What do we do at Auvri Plus?</h1>
            </div>
            <div class="about-split">
                <div class="split-img">
                    <img src="{{ asset('auri-images/about/image.png') }}" alt="Ayurvedic Ritual">
                </div>
                <div class="split-info">
                    <div class="story-block">
                        <p class="p-text">We believe in the creation of the universe from the five basic elements, commonly known as <strong>Panchabuthaas</strong>. Every cell of a human is built from the elements of nature, a phenomenon familiarly known as <em>"Indriya Pancha Panchakas"</em>.</p>
                        <p class="p-text">Auvriplus treasures the secrets of our ancestors, bringing them to life through modern-day supplements and products that holistically care for your skin, body, and hair.</p>
                    </div>
                    <div class="highlight-box">
                        <p class="p-text" style="font-weight: 600; font-style: italic; color: #004200; margin: 0;">
                            "Secrets of ancient health rituals, brought to life through pain-staking research for the modern-day customer."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Advanced Philosophy of the Five Elements -->
    <section class="advanced-philosophy-sec">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <span class="sub-title">Auvriplus Tradition</span>
                <h2 class="sec-title">The Philosophy of the Five Elements</h2>
                <p class="p-text" style="margin: 0 auto; opacity: 0.9;">Auvriplus bridges tradition and modern living through the harmony of Panchabuthas and the five senses.</p>
            </div>

            <div class="pancha-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 50px; flex-wrap: wrap;">
                <div class="radial-container">
                    <div class="glow-core"></div>
                    <div class="center-hub">
                        <h3>Pancha<br>buthas</h3>
                    </div>
                    <div class="radial-centerpiece orbit-animation">
                        <div class="radial-node node-ether" data-element="Ether" data-info="Representing the spiritual expanse in which all creation exists. It is the foundation of sound and the source of pure vibration.">
                            <img src="{{ asset('auri-images/icons/panchabuthas/ether_vortex.png') }}" alt="Ether" class="node-icon-vortex">
                            <span>Ether</span>
                        </div>
                        <div class="radial-node node-air" data-element="Air" data-info="Designed to deliver softness and purity, every formulation reflects the gentle element of air.">
                            <i class="fas fa-wind"></i>
                            <span>Air</span>
                        </div>
                        <div class="radial-node node-fire" data-element="Fire" data-info="Visually pleasing and thoughtfully packaged, our products honor the element of fire and perception.">
                            <i class="fas fa-fire"></i>
                            <span>Fire</span>
                        </div>
                        <div class="radial-node node-water" data-element="Water" data-info="Herbal infusions are carefully balanced to support wellness while remaining pleasant and harmonious.">
                            <i class="fas fa-tint"></i>
                            <span>Water</span>
                        </div>
                        <div class="radial-node node-earth" data-element="Earth" data-info="With earthy, grounding fragrances inspired by nature after rain, our products embody the essence of earth.">
                            <i class="fas fa-mountain"></i>
                            <span>Earth</span>
                        </div>
                    </div>
                </div>
                <!-- Side Message Popup -->
                <div id="orbit-side-popup" class="orbit-popup">
                    <div class="popup-inner">
                        <h4 id="popup-title">Panchabuthas</h4>
                        <p id="popup-text">The five basic elements of nature that build every cell of human life.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="leaf-watermark-bot" style="bottom: 50px; right: 5%; opacity: 0.03; font-size: 15rem;">
            <i class="fas fa-leaf"></i>
        </div>
    </section>

    <!-- 5. Dosha Panels (Grid) -->
    <section class="dosha-panels">
        <div class="container">
            <div class="dosha-grid">
                <!-- Kapha -->
                <div class="dosha-card" id="dosha-kapha">
                    <img src="{{ asset('auri-images/icons/doshas/kapha_symbol.svg') }}" alt="Kapha Symbol" class="dosha-symbol">
                    <h3 class="dosha-card-title">Kapha</h3>
                    <p class="dosha-card-text">Kapha represents calm, soft, and cool energy, like the gentle nature of earth. People with Kapha qualities are peaceful, caring, and graceful, with soft and cool skin. Warm colors like red and purple suit them well. When out of balance, they may become overly attached or possessive. To regain balance, activities like a warm sesame oil massage or listening to energetic music can help refresh and energize them.</p>
                </div>
                <!-- Pitta -->
                <div class="dosha-card" id="dosha-pitta">
                    <img src="{{ asset('auri-images/icons/doshas/pitta_symbol.svg') }}" alt="Pitta Symbol" class="dosha-symbol">
                    <h3 class="dosha-card-title">Pitta</h3>
                    <p class="dosha-card-text">Pitta represents fire energy — strong, intense, and powerful. People with Pitta qualities are passionate, active, and focused. Cool colors like green and blue help calm and balance them. When balanced, they are warm, joyful, and inspiring. When out of balance, they may become angry or irritable. To restore balance, they should relax, take breaks, meditate, enjoy calming scents like sandalwood, or take peaceful walks.</p>
                </div>
                <!-- Vatta -->
                <div class="dosha-card" id="dosha-vatta">
                    <img src="{{ asset('auri-images/icons/doshas/vatta_symbol.svg') }}" alt="Vatta Symbol" class="dosha-symbol">
                    <h3 class="dosha-card-title">Vatta</h3>
                    <p class="dosha-card-text">Vata represents wind energy — light, active, and delicate. People with Vata qualities often have thin, cool, and dry skin with gentle features. Warm colors suit them well, and they look bright in green and gold. They feel emotions quickly and can be easily disturbed by harsh sounds or behavior. Gentle touch and calming scents like jasmine or rose help them relax and stay balanced.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Our Commitment -->
    <section class="commitment-sec">
        <div class="container">
            <span class="sub-title">Our Promise</span>
            <h2 class="sec-title">Purity, Curation, Care</h2>
            <div class="com-list">
                <div class="com-item">
                    <i class="fas fa-check-circle"></i>
                    <h4>Purity First</h4>
                    <p>100% natural formulations rooted in ancient science.</p>
                </div>
                <div class="com-item">
                    <i class="fas fa-hand-holding-heart"></i>
                    <h4>Expert Curation</h4>
                    <p>Every product is a result of pain-staking research by specialists.</p>
                </div>
                <div class="com-item">
                    <i class="fas fa-globe-asia"></i>
                    <h4>Global Care</h4>
                    <p>Spreading health and holistic wellness from us to you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Cinematic CTA -->
    <section class="about-cta">
        <div class="container" style="position: relative; z-index: 2; text-align: center;">
            <h2 class="sec-title" style="color: #fff;">Experience the Auvriplus Ritual</h2>
            <div class="cta-btns" style="margin-top: 50px;">
                <a href="{{ route('shop') }}" class="btn btn-primary" style="background: #fff; color: #004200; padding: 18px 40px; font-size: 1.1rem;">Explore Collection</a>
                <a href="https://wa.me/919818299669" class="btn btn-outline" style="border-color: #fff; color: #fff; margin-left: 25px; padding: 18px 40px;">Consult an Expert</a>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
<script>
    // Orbit Popup
    document.querySelectorAll('.radial-node').forEach(node => {
        node.addEventListener('mouseenter', function() {
            const el = document.getElementById('orbit-side-popup');
            const title = document.getElementById('popup-title');
            const text = document.getElementById('popup-text');
            if (title) title.textContent = this.dataset.element;
            if (text) text.textContent = this.dataset.info;
            if (el) el.classList.add('active');
        });
        node.addEventListener('mouseleave', function() {
            const el = document.getElementById('orbit-side-popup');
            if (el) el.classList.remove('active');
        });
    });
</script>
@endsection
