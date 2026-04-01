const app = {
  // State
  state: {
    cartTotal: 0,
    cart: JSON.parse(localStorage.getItem('auvri-cart')) || [],
    products: [
      {
        id: 1,
        name: "Herbal Hair Oil",
        price: 450,
        rating: "★★★★★",
        image: "images/products/herbal-hair-oil.png",
        type: "Hair",
        description: "A potent blend of 18 Ayurvedic herbs infused in pure coconut oil to promote hair growth and scalp health.",
        wisdom: "Inspired by the 'Keshya' rituals of ancient scriptures, this oil uses heating and cooling herbs to balance Pitta dosha in the scalp.",
        ingredients: ["Bhringraj", "Amalaki", "Brahmi", "Pure Coconut Oil", "Fenugreek"],
        ritual: "Gently massage 10ml into scalp. Leave for 45 minutes before washing with a mild cleanser. Use 3 times a week."
      },
      {
        id: 2,
        name: "Weight Loss Powder",
        price: 650,
        rating: "★★★★☆",
        image: "images/products/weight-loss.png",
        type: "Detox",
        description: "A natural metabolic booster designed to detoxify the system and support healthy weight management.",
        wisdom: "Formulated by Brahma Rishi Agathiyar, this powder targets the 'Agni' (digestive fire) to ensure efficient fat metabolism.",
        ingredients: ["Cuminum cyminum", "Indigofera tinctoria", "Terminalia", "Acalypha indica", "Abutilon indicum"],
        ritual: "Mix 1.5 spoons in a glass of warm water. Consume 30 minutes after dinner for optimal results."
      },
      {
        id: 3,
        name: "Diabetic Care",
        price: 850,
        rating: "★★★★★",
        image: "images/products/diabetic-wound-healing.png",
        type: "Health",
        description: "Specially formulated to support healthy blood sugar levels and promote natural healing processes.",
        wisdom: "Utilizes the grounding properties of Earth and Water elements to stabilize fluctuating internal energies.",
        ingredients: ["Turmeric", "Neem", "Bitter Gourd Extract", "Jamun Seed", "Gymnema Sylvestre"],
        ritual: "Take one capsule twice daily before meals, or as directed by an Ayurvedic practitioner."
      },
      {
        id: 4,
        name: "Kamaayush Vitality",
        price: 999,
        rating: "★★★★★",
        image: "images/products/kamaayush.png",
        type: "Men",
        description: "A premium energy and vitality supplement for men, boosting stamina and overall well-being.",
        wisdom: "A 'Rasayana' tonic that rejuvenates the 'Dhatus' (tissues), particularly focusing on vitality and strength.",
        ingredients: ["Ashwagandha", "Safed Musli", "Shilajit", "Gokshura", "Shatavari"],
        ritual: "One capsule with warm milk at bedtime. Consistent use for 48 days (one Mandalam) is recommended."
      },
      {
        id: 5,
        name: "Herbal Hair Pack",
        price: 1250,
        rating: "★★★★★",
        image: "images/products/herbal-hair.png",
        type: "Hair",
        description: "A deep-conditioning hair mask that restores natural shine and strengthens roots from within.",
        wisdom: "Mimics the traditional 'Shirolepa' therapy to detoxify the scalp and nourish the hair follicles.",
        ingredients: ["Henna", "Hibiscus", "Aloe Vera", "Neem", "Shikakai"],
        ritual: "Mix with water/curd to form a paste. Apply from root to tip. Wash after 30 minutes. Use once a week."
      },
      {
        id: 6,
        name: "Weight Loss Combo",
        price: 1499,
        rating: "★★★★★",
        image: "images/products/pack-weight-loss.png",
        type: "Detox",
        description: "A comprehensive 30-day retreat for your metabolism, combining our signature powder with herbal tea.",
        wisdom: "A holistic approach to weight loss that balances Kapha dosha while energizing the entire body.",
        ingredients: ["Detox Powder", "Herbal Tea Blend", "Metabolism Booster Capsules"],
        ritual: "Follow the included 30-day guide for timing and dosage of each component in the kit."
      },
    ],
    faqs: [
      {
        q: "What is a Detox Diet?",
        a: "A detox diet is a short-period dietary approach designed to help eliminate toxins from the body. It typically includes:<br>• A period of fasting<br>• A strict diet of fruits, vegetables, fruit juices, and water<br>• Herbs, teas, supplements, and colon cleanses or enemas",
      },
      {
        q: "What are the benefits of a Detox Diet?",
        a: "A detox diet may help:<br>• Stimulate the liver to remove toxins<br>• Promote toxin elimination through feces, urine, and sweat<br>• Improve circulation<br>• Provide healthy nutrients to the body",
      },
      {
        q: "How to use Auvriplus Detox Weight Loss Powder",
        a: "Suggested usage:<br>• Take 1.5 spoons of Auvriplus Detox Weight Loss Powder<br>• Mix with warm water<br>• Drink 30 minutes after dinner",
      },
      {
        q: "Can it be taken with medications?",
        a: "The Detox Weight Loss Powder is a food supplement made from essential nutrients and free of chemicals. It is generally safe to take with medications. However, it is not intended for pregnant women, nursing mothers, or children under the age of 12.",
      },
      {
        q: "Are there any side effects?",
        a: "The product uses 100% natural herbs and is formulated by Brahma Rishi Agathiyar. It does not contain chemicals or preservatives and does not have side effects as per the FAQ.",
      },
      {
        q: "Is Auvriplus Detox Weight Loss Powder natural?",
        a: "Yes — it is completely natural, free from chemicals and preservatives. It is made of five ancient herbal ingredients:<br>• Cuminum cyminum<br>• Indigofera tinctoria<br>• Terminalia<br>• Acalypha indica<br>• Abutilon indicum",
      },
      {
        q: "How many days to see weight loss results?",
        a: "Results vary between individuals based on diet and exercise habits. If taken daily for one mandalam (48 days), it claims you can lose about 10% of body weight naturally without special diet or exercise.",
      },
      {
        q: "Other benefits of Auvriplus Detox Weight Loss Powder",
        a: "The product may also help to:<br>• Boost metabolism<br>• Burn extra fat<br>• Improve blood circulation<br>• Regulate cholesterol<br>• Aid proper digestion",
      },
      {
        q: "How long does one bottle last?",
        a: "Depending on the pack size:<br>• 75 g pack lasts approximately 30 days<br>• 25 g pack lasts approximately 10 days when taken daily",
      },
    ],
  },

  // Initialize
  init() {
    this.renderProducts();
    this.renderFAQs();
    this.updateCartCount();
    this.handleRouting();
    window.addEventListener("hashchange", () => this.handleRouting());

    // Scroll Listener
    window.addEventListener("scroll", () => this.handleScroll());

    const scrollBtn = document.getElementById("premiumScrollBtn");
    const wrapper = document.getElementById("premiumScrollWrapper");
    if (wrapper && scrollBtn) {
      // Initialized reveal observer
      this.initReveal();
    }
  },

  initReveal() {
    const observerOptions = {
      threshold: 0.15,
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("revealed");
        }
      });
    }, observerOptions);

    // Track all sections and cards for reveal
    document
      .querySelectorAll(
        "section, .sense-card, .radial-container, .dosha-strip, .about-split",
      )
      .forEach((el) => {
        el.classList.add("reveal-on-scroll");
        observer.observe(el);
      });
  },

  handleScroll() {
    const btn = document.getElementById("premiumScrollBtn");
    const circle = document.querySelector(".progress-ring__circle");

    // Calculate Scroll Percentage
    const scrollTop = window.scrollY;
    const docHeight = document.body.offsetHeight - window.innerHeight;
    const scrollPercent = Math.min((scrollTop / docHeight) * 100, 100);

    // Update Ring
    if (circle) {
      const radius = circle.r.baseVal.value;
      const circumference = 2 * Math.PI * radius;
      const offset = circumference - (scrollPercent / 100) * circumference;
      circle.style.strokeDashoffset = offset;
    }

    // Visibility Logic
    if (scrollTop > 100) {
      btn.classList.add("visible");
    } else {
      btn.classList.remove("visible");
    }
  },


  scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });

    // Effect on click
    const btn = document.getElementById("premiumScrollBtn");
    btn.style.transform = "scale(0.9)";
    setTimeout(() => (btn.style.transform = "scale(1)"), 200);
  },

  // Routing
  handleRouting() {
    const hash = window.location.hash || "#home";

    // Hide all views
    document
      .querySelectorAll("#app > div")
      .forEach((div) => (div.style.display = "none"));

    // Show specific view
    if (hash === "#home") {
      document.getElementById("home-view").style.display = "block";
      this.renderProducts("product-list", 4); // Show only 4 on home
      this.renderFAQs("faq-list", 3); // Show only 3 on home
      window.scrollTo(0, 0);
    } else if (hash === "#shop") {
      document.getElementById("shop-view").style.display = "block";
      this.renderProducts("full-product-list"); // Show all on shop
      window.scrollTo(0, 0);
    } else if (hash === "#about") {
      document.getElementById("about-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash === "#faq") {
      document.getElementById("faq-view").style.display = "block";
      this.renderFAQs("faq-page-list"); // Show all on faq page
      window.scrollTo(0, 0);
    } else if (hash === "#contact") {
      document.getElementById("contact-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash === "#terms") {
      document.getElementById("terms-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash === "#shipping") {
      document.getElementById("shipping-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash === "#refund") {
      document.getElementById("refund-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash === "#privacy") {
      document.getElementById("privacy-view").style.display = "block";
      window.scrollTo(0, 0);
    } else if (hash.startsWith("#product/")) {
      const id = parseInt(hash.split("/")[1]);
      document.getElementById("product-view").style.display = "block";
      this.renderProductDetail(id);
      window.scrollTo(0, 0);
    } else if (hash === "#cart") {
      document.getElementById("cart-view").style.display = "block";
      this.renderCart();
      window.scrollTo(0, 0);
    } else {
      document.getElementById("home-view").style.display = "block";
    }

    // Update Nav Active State
    document.querySelectorAll(".nav-links a").forEach((a) => {
      a.classList.toggle("active", a.getAttribute("href") === hash);
    });
  },

  // Render Functions
  renderProducts(targetId = "product-list", limit = null, filter = "All") {
    const list = document.getElementById(targetId);
    if (!list) return;

    let filtered = this.state.products;
    if (filter !== "All") {
      filtered = filtered.filter((p) => p.type === filter);
    }

    if (limit) {
      filtered = filtered.slice(0, limit);
    }

    list.innerHTML = filtered
      .map(
        (p) => `
            <div class="product-card" onclick="window.location.hash = '#product/${p.id}'">
                <div class="p-img-wrap">
                    <img src="${p.image}" onerror="this.src='https://via.placeholder.com/300?text=Auvri+Product'" alt="${p.name}">
                    <button class="quick-view-btn" onclick="event.stopPropagation(); app.openModal(${p.id})">Quick View</button>
                </div>
                <div class="p-info">
                    <div class="p-rating">${p.rating}</div>
                    <h4 class="p-title">${p.name}</h4>
                    <div class="p-bot">
                        <span class="p-price">₹${p.price.toLocaleString()}</span>
                        <button class="add-btn" onclick="event.stopPropagation(); app.addToCart(${p.id}, 1)"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        `,
      )
      .join("");
  },

  renderProductDetail(id) {
    const p = this.state.products.find((prod) => prod.id === id);
    const container = document.getElementById("product-view");
    if (!p || !container) return;

    container.innerHTML = `
        <div class="luxury-detail-wrapper animate-fade">
            <!-- 1. Product Hero Section -->
            <section class="product-hero-premium">
                <div class="container hero-grid-luxury">
                    
                    <!-- Left: Gallery with Vertical Thumbs -->
                    <div class="gallery-luxury">
                        <div class="thumb-strip-vertical">
                            <div class="v-thumb active" onclick="app.swapImgLuxury(this, '${p.image}')"><img src="${p.image}"></div>
                            <div class="v-thumb" onclick="app.swapImgLuxury(this, '${p.image}')"><img src="${p.image}"></div>
                            <div class="v-thumb" onclick="app.swapImgLuxury(this, '${p.image}')"><img src="${p.image}"></div>
                        </div>
                        <div class="main-img-luxury">
                            <img src="${p.image}" id="main-product-img-luxury" alt="${p.name}">
                            <div class="zoom-indicator"><i class="fas fa-search-plus"></i></div>
                        </div>
                    </div>

                    <!-- Right: Product Info -->
                    <div class="info-luxury">
                        <nav class="luxury-breadcrumbs">
                            <a href="#home">Home</a> / <a href="#shop">Shop</a> / <span>${p.type}</span>
                        </nav>
                        
                        <h1 class="luxury-title">${p.name}</h1>
                        
                        <div class="luxury-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="review-count">(124 Reviews)</span>
                        </div>

                        <div class="luxury-price-card">
                            <div class="price-top">
                                <span class="label">Investment in Wellness</span>
                                <div class="price-val">₹${p.price.toLocaleString()}</div>
                            </div>
                            <div class="price-badges">
                                <span><i class="fas fa-leaf"></i> 100% Organic</span>
                                <span><i class="fas fa-flask-vial"></i> Lab Tested</span>
                            </div>
                        </div>

                        <div class="luxury-actions">
                            <button class="btn btn-premium-cart" onclick="app.addToCart(${p.id}, 1)">
                                <span>ADD TO CART</span>
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                            
                            <div class="contact-buttons-luxury">
                                <a href="https://wa.me/919818299669" class="btn-lx-outline"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                <a href="tel:+919818299669" class="btn-lx-outline"><i class="fas fa-phone-alt"></i> Consultation</a>
                            </div>
                        </div>

                        <div class="benefit-highlights-row">
                            <div class="b-mini"><i class="fas fa-check-circle"></i> Chemical Free</div>
                            <div class="b-mini"><i class="fas fa-check-circle"></i> Artisan Crafted</div>
                            <div class="b-mini"><i class="fas fa-check-circle"></i> Ancient Recipe</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. Ayurvedic Benefits Section -->
            <section class="benefits-luxury-sec">
                <div class="container">
                    <h2 class="lx-sec-title">Healing Benefits</h2>
                    <div class="benefits-glass-grid">
                        <div class="glass-card">
                            <div class="glass-icon"><i class="fas fa-heartbeat"></i></div>
                            <h3>Vitality Boost</h3>
                            <p>Restores your natural energy balance and strengthens the immune system through potent botanical extracts.</p>
                        </div>
                        <div class="glass-card">
                            <div class="glass-icon"><i class="fas fa-spa"></i></div>
                            <h3>Deep Calm</h3>
                            <p>Infused with meditative herbs that soothe the nervous system and promote restorative mental peace.</p>
                        </div>
                        <div class="glass-card">
                            <div class="glass-icon"><i class="fas fa-feather-alt"></i></div>
                            <h3>Pure Detox</h3>
                            <p>Gently flushes out environmental toxins, leaving your body feeling light, clean, and rejuvenated.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. Tabs Section -->
            <section class="tabs-luxury-sec">
                <div class="container">
                    <div class="lx-tabs-header">
                        <button class="lx-tab-btn active" onclick="app.switchLxTab(this, 'lx-desc')">Healing Description</button>
                        <button class="lx-tab-btn" onclick="app.switchLxTab(this, 'lx-specs')">Ayurvedic Specs</button>
                        <button class="lx-tab-btn" onclick="app.switchLxTab(this, 'lx-usage')">Usage Instructions</button>
                        <button class="lx-tab-btn" onclick="app.switchLxTab(this, 'lx-ingredients')">Ingredients</button>
                    </div>
                    
                    <div class="lx-tabs-content">
                        <div id="lx-desc" class="lx-content-pane active">
                            <p>${p.description}</p>
                        </div>
                        <div id="lx-specs" class="lx-content-pane">
                            <div class="lx-spec-grid">
                                <div class="spec-item"><strong>Ancient Wisdom:</strong> ${p.wisdom}</div>
                                <div class="spec-item"><strong>The Ritual:</strong> ${p.ritual}</div>
                            </div>
                        </div>
                        <div id="lx-usage" class="lx-content-pane">
                            <p>Apply a small amount to the focal points or as directed by an Ayurvedic practitioner. Best used during early morning or before sleep for maximum absorption.</p>
                        </div>
                        <div id="lx-ingredients" class="lx-content-pane">
                            <div class="ing-tags">
                                ${p.ingredients.map(ing => `<span>${ing}</span>`).join('')}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. Pure Origins Section -->
            <section class="origins-luxury-sec">
                <div class="container">
                    <h2 class="lx-sec-title">Our Pure Origins</h2>
                    <p class="lx-sec-sub">The five elements of existence, carefully balanced in every drop.</p>
                    <div class="origins-circle-grid">
                        <div class="origin-element">
                            <div class="origin-icon-wrap"><i class="fas fa-mountain"></i></div>
                            <span>Prithvi (Earth)</span>
                        </div>
                        <div class="origin-element">
                            <div class="origin-icon-wrap"><i class="fas fa-tint"></i></div>
                            <span>Jala (Water)</span>
                        </div>
                        <div class="origin-element">
                            <div class="origin-icon-wrap"><i class="fas fa-fire"></i></div>
                            <span>Agni (Fire)</span>
                        </div>
                        <div class="origin-element">
                            <div class="origin-icon-wrap"><i class="fas fa-wind"></i></div>
                            <span>Vayu (Air)</span>
                        </div>
                        <div class="origin-element">
                            <div class="origin-icon-wrap"><i class="fas fa-infinity"></i></div>
                            <span>Akasha (Ether)</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 5. Trust Indicators -->
            <section class="trust-lx-sec">
                <div class="container lx-trust-flex">
                    <div class="lx-trust-item"><i class="fas fa-medal"></i> <span>GMP Certified</span></div>
                    <div class="lx-trust-item"><i class="fas fa-leaf"></i> <span>100% Natural</span></div>
                    <div class="lx-trust-item"><i class="fas fa-microscope"></i> <span>Lab Tested</span></div>
                    <div class="lx-trust-item"><i class="fas fa-award"></i> <span>Safe & Authentic</span></div>
                </div>
            </section>

            <!-- 6. Related Remedies -->
            <section class="related-lx-sec">
                <div class="container">
                    <div class="lx-sec-header-flex">
                        <h2 class="lx-sec-title">Related Remedies</h2>
                        <a href="#shop" class="lx-link">Explore Collection <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="product-grid" id="related-list-lx">
                        <!-- Injected -->
                    </div>
                </div>
            </section>
        </div>
    `;

    this.renderRelatedProductsLx(p.type, p.id);
  },

  swapImgLuxury(el, src) {
    const main = document.getElementById('main-product-img-luxury');
    if (main) {
      main.style.opacity = '0';
      setTimeout(() => {
        main.src = src;
        main.style.opacity = '1';
      }, 300);
    }
    document.querySelectorAll('.v-thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
  },

  switchLxTab(btn, targetId) {
    document.querySelectorAll('.lx-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.lx-content-pane').forEach(p => p.classList.remove('active'));

    btn.classList.add('active');
    document.getElementById(targetId).classList.add('active');
  },

  renderRelatedProductsLx(type, currentId) {
    const list = document.getElementById("related-list-lx");
    if (!list) return;

    const related = this.state.products
      .filter(p => p.type === type && p.id !== currentId)
      .slice(0, 4);

    list.innerHTML = related.map(p => `
        <div class="product-card animate-up" onclick="window.location.hash = '#product/${p.id}'">
            <div class="p-img-wrap">
                <img src="${p.image}" alt="${p.name}">
            </div>
            <div class="p-info">
                <h4 class="p-title">${p.name}</h4>
                <div class="p-bot">
                    <span class="p-price">₹${p.price.toLocaleString()}</span>
                    <div class="add-btn" onclick="event.stopPropagation(); app.addToCart(${p.id}, 1)"><i class="fas fa-plus"></i></div>
                </div>
            </div>
        </div>
    `).join('');
  },

  renderFAQs(targetId = "faq-list", limit = null) {
    const list = document.getElementById(targetId);
    if (!list) return;

    let faqs = this.state.faqs;
    if (limit) {
      faqs = faqs.slice(0, limit);
    }

    list.innerHTML = faqs
      .map(
        (f, i) => `
            <div class="acc-item" onclick="app.toggleFAQ(this)">
                <div class="acc-head">
                    ${f.q}
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="acc-body">
                    <p>${f.a}</p>
                </div>
            </div>
        `,
      )
      .join("");
  },

  // Interactions
  addToCart(id, qty = 1) {
    const product = this.state.products.find(p => p.id === id);
    if (!product) return;

    const existing = this.state.cart.find(item => item.id === id);
    if (existing) {
      existing.qty += qty;
    } else {
      this.state.cart.push({ ...product, qty });
    }

    this.saveCart();
    this.updateCartCount();
    this.showToast(`Added ${qty} ${product.name} to cart`);
  },

  removeFromCart(id) {
    this.state.cart = this.state.cart.filter(item => item.id !== id);
    this.saveCart();
    this.renderCart();
    this.updateCartCount();
  },

  updateQuantity(id, change) {
    const item = this.state.cart.find(i => i.id === id);
    if (item) {
      item.qty += change;
      if (item.qty <= 0) {
        this.removeFromCart(id);
      } else {
        this.saveCart();
        this.renderCart();
        this.updateCartCount();
      }
    }
  },

  saveCart() {
    localStorage.setItem('auvri-cart', JSON.stringify(this.state.cart));
  },

  updateCartCount() {
    const totalQty = this.state.cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.querySelector(".cart-count");
    if (badge) badge.innerText = totalQty;
  },

  renderCart() {
    const container = document.getElementById("cart-view");
    if (!container) return;

    if (this.state.cart.length === 0) {
      container.innerHTML = `
        <div class="empty-cart-state">
            <i class="fas fa-shopping-basket"></i>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added any Ayurvedic remedies yet.</p>
            <a href="#shop" class="btn btn-primary">Start Shopping</a>
        </div>
      `;
      return;
    }

    const total = this.state.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    container.innerHTML = `
        <div class="container cart-page">
            <h1 class="page-title">Shopping Cart</h1>
            <div class="cart-layout">
                <div class="cart-items">
                    ${this.state.cart.map(item => `
                        <div class="cart-item">
                            <img src="${item.image}" alt="${item.name}">
                            <div class="ci-info">
                                <h3>${item.name}</h3>
                                <p class="ci-price">₹${item.price.toLocaleString()}</p>
                            </div>
                            <div class="ci-qty">
                                <button onclick="app.updateQuantity(${item.id}, -1)">-</button>
                                <span>${item.qty}</span>
                                <button onclick="app.updateQuantity(${item.id}, 1)">+</button>
                            </div>
                            <div class="ci-total">₹${(item.price * item.qty).toLocaleString()}</div>
                            <button class="ci-remove" onclick="app.removeFromCart(${item.id})">&times;</button>
                        </div>
                    `).join('')}
                </div>
                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <div class="cs-row">
                        <span>Subtotal</span>
                        <span>₹${total.toLocaleString()}</span>
                    </div>
                    <div class="cs-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="cs-total">
                        <span>Total</span>
                        <span>₹${total.toLocaleString()}</span>
                    </div>
                    <button class="btn btn-primary btn-block" onclick="alert('Proceeding to Checkout...')">Checkout</button>
                </div>
            </div>
        </div>
    `;
  },

  showToast(msg) {
    let toast = document.getElementById('toast-msg');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'toast-msg';
      toast.style.cssText = `
        position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%);
        background: var(--primary); color: white; padding: 12px 30px;
        border-radius: 50px; z-index: 1000; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        font-weight: 500; transition: all 0.3s ease; opacity: 0;
      `;
      document.body.appendChild(toast);
    }
    toast.innerText = msg;
    toast.style.opacity = '1';
    toast.style.bottom = '50px';
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.bottom = '30px';
    }, 3000);
  },

  filterCategory(cat) {
    // Handle Pills
    const pills = document.querySelectorAll(".filter-pill");
    pills.forEach((p) => {
      p.classList.toggle(
        "active",
        p.innerText.includes(cat) ||
        (cat === "All" && p.innerText === "All Products"),
      );
    });

    // If not on shop page, go there
    if (window.location.hash !== "#shop") {
      window.location.hash = "#shop";
      // handleRouting will call renderProducts
    } else {
      this.renderProducts("full-product-list", null, cat);
    }
  },

  toggleFAQ(el) {
    el.classList.toggle("active");
    const icon = el.querySelector(".fas");
    if (el.classList.contains("active")) {
      icon.classList.replace("fa-chevron-down", "fa-chevron-up");
    } else {
      icon.classList.replace("fa-chevron-up", "fa-chevron-down");
    }
  },

  openModal(id) {
    const product = this.state.products.find((p) => p.id === id);
    const modalBody = document.getElementById("modal-body");
    modalBody.innerHTML = `
            <img src="${product.image}" onerror="this.src='https://via.placeholder.com/300'" style="height:200px; margin:0 auto 20px;">
            <h2>${product.name}</h2>
            <p  style="color:#555; margin-bottom:20px;">Authentic herbal remedy for ${product.type}</p>
            <h3 style="color:#004200;">₹${product.price.toFixed(2)}</h3>
            <button class="btn btn-primary" onclick="app.addToCart(${product.id}, 1); app.closeModal()">Add to Cart</button>
        `;
    document.getElementById("modal-overlay").style.display = "flex";
  },

  qtyChange(btn, amt) {
    const qtyEl = btn.parentElement.querySelector('span');
    let currentQty = parseInt(qtyEl.innerText);
    currentQty = Math.max(1, currentQty + amt);
    qtyEl.innerText = currentQty;
  },

  closeModal() {
    document.getElementById("modal-overlay").style.display = "none";
  },
};

// Start App
document.addEventListener("DOMContentLoaded", () => {
  app.init();
});
