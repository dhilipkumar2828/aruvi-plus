document.addEventListener('DOMContentLoaded', () => {
    // --- 1. Inner Image Sliders (Existing Logic) ---
    const sliders = document.querySelectorAll('.slider-container');

    sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.slide');
        const prevBtn = slider.querySelector('.prev');
        const nextBtn = slider.querySelector('.next');
        let currentSlide = 0;
        let slideInterval;
        const intervalTime = 3000;

        // Function to move to next slide
        const nextSlide = () => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        };

        // Function to move to previous slide
        const prevSlide = () => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        };

        // Auto Scroll
        if (slides.length > 1) {
            slideInterval = setInterval(nextSlide, intervalTime);
        }

        // Event Listeners for Arrows
        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default if button is inside a form or link (though here it's div)
                clearInterval(slideInterval); // Stop auto scroll on interaction
                nextSlide();
                slideInterval = setInterval(nextSlide, intervalTime); // Restart
            });

            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                clearInterval(slideInterval);
                prevSlide();
                slideInterval = setInterval(nextSlide, intervalTime);
            });
        }
    });

    // --- 2. Main Product Carousel Logic (SCROLL Version) ---
    const carouselWrapper = document.querySelector('.premium-carousel-wrapper');
    const productCards = document.querySelectorAll('.premium-product-card');
    const prevProductBtn = document.querySelector('.prev-btn'); // Main arrow
    const nextProductBtn = document.querySelector('.next-btn'); // Main arrow
    const dots = document.querySelectorAll('.dot');
    let currentProductIndex = 0;
    let productInterval;
    const productIntervalTime = 5000; // 5 seconds per product

    if (carouselWrapper && productCards.length > 0) {
        // Function to scroll to specific product
        const showProduct = (index) => {
            // Update Index
            currentProductIndex = index;

            // Scroll logic
            // Use offsetWidth to be safer than clientWidth for pure layout width
            const scrollAmount = carouselWrapper.offsetWidth * currentProductIndex;
            carouselWrapper.scrollTo({
                left: scrollAmount,
                behavior: 'smooth'
            });

            // Update Dots
            dots.forEach(dot => dot.classList.remove('active'));
            if (dots.length > index) dots[index].classList.add('active');
        };

        // Next Product
        const nextProduct = () => {
            let nextIndex = (currentProductIndex + 1) % productCards.length;
            showProduct(nextIndex);
        };

        // Prev Product
        const prevProduct = () => {
            let prevIndex = (currentProductIndex - 1 + productCards.length) % productCards.length;
            showProduct(prevIndex);
        };

        // Auto Play
        productInterval = setInterval(nextProduct, productIntervalTime);

        // Event Listeners
        if (nextProductBtn) {
            nextProductBtn.addEventListener('click', () => {
                clearInterval(productInterval);
                nextProduct();
                productInterval = setInterval(nextProduct, productIntervalTime);
            });
        }

        if (prevProductBtn) {
            prevProductBtn.addEventListener('click', () => {
                clearInterval(productInterval);
                prevProduct();
                productInterval = setInterval(nextProduct, productIntervalTime);
            });
        }

        // Dot Navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(productInterval);
                showProduct(index);
                productInterval = setInterval(nextProduct, productIntervalTime);
            });
        });

        // Handle Resize to readjust scroll position
        window.addEventListener('resize', () => {
            showProduct(currentProductIndex);
        });

        // Pause Auto-Scroll on Hover (e.g. when interacting with card)
        carouselWrapper.addEventListener('mouseenter', () => {
            clearInterval(productInterval);
        });

        carouselWrapper.addEventListener('mouseleave', () => {
            clearInterval(productInterval); // Clear in case of edge cases
            productInterval = setInterval(nextProduct, productIntervalTime);
        });
    }


    // --- 3. Number Counter Animation (Existing) ---
    const statsSection = document.querySelector('.festival-section');
    const counters = document.querySelectorAll('.counter');
    let started = false; // flag to ensure only runs once

    if (statsSection && counters.length > 0) {
        const items = document.querySelectorAll('.festival-item');
        items.forEach(item => item.style.opacity = '0');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !started) {
                    started = true;
                    counters.forEach(counter => {
                        const updateCount = () => {
                            const target = +counter.getAttribute('data-target');
                            const count = +counter.innerText;
                            const speed = 200; // Lower is faster
                            const inc = target / speed;

                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc);
                                setTimeout(updateCount, 20);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        updateCount();
                    });

                    // Trigger CSS animations
                    const items = document.querySelectorAll('.festival-item');
                    items.forEach((item, index) => {
                        item.style.animation = `fadeUp 0.6s ease forwards ${index * 0.2}s`;
                    });
                }
            });
        }, { threshold: 0.1 });

        observer.observe(statsSection);
    }
    // --- 4. Navigation Bar Scroll Effect ---
    const header = document.querySelector('header');
    const floatingNav = document.querySelector('.floating-nav');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
            if (floatingNav) floatingNav.classList.add('docked');
        } else {
            header.classList.remove('scrolled');
            if (floatingNav) floatingNav.classList.remove('docked');
        }
    });

    // --- 5. Hero Background Slider ---
    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        const rawImages = heroSection.getAttribute('data-images');
        let heroImages = [
            'url("/images/hero_bg.jpg")',
            'url("/images/hero_bg_2.jpg")'
        ];

        try {
            if (rawImages) {
                const parsed = JSON.parse(rawImages);
                if (Array.isArray(parsed) && parsed.length > 0) {
                    heroImages = parsed.map(img => `url("${img}")`);
                }
            }
        } catch (e) {
            console.error("Error parsing hero images:", e);
        }

        let currentHeroIndex = 0;
        const heroIntervalTime = 5000;
        let heroInterval;

        // Preload images
        heroImages.forEach(img => {
            const i = new Image();
            i.src = img.replace(/url\(['"]?(.*?)['"]?\)/, '$1');
        });

        const updateHeroBackground = () => {
            heroSection.style.backgroundImage = heroImages[currentHeroIndex];
        };

        const nextHeroImage = () => {
            currentHeroIndex = (currentHeroIndex + 1) % heroImages.length;
            updateHeroBackground();
        };

        const prevHeroImage = () => {
            currentHeroIndex = (currentHeroIndex - 1 + heroImages.length) % heroImages.length;
            updateHeroBackground();
        };

        // Auto Play
        heroInterval = setInterval(nextHeroImage, heroIntervalTime);

        // Controls
        const heroPrevBtn = document.querySelector('.hero-prev');
        const heroNextBtn = document.querySelector('.hero-next');

        if (heroNextBtn) {
            heroNextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                clearInterval(heroInterval);
                nextHeroImage();
                heroInterval = setInterval(nextHeroImage, heroIntervalTime);
            });
        }

        if (heroPrevBtn) {
            heroPrevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                clearInterval(heroInterval);
                prevHeroImage();
                heroInterval = setInterval(nextHeroImage, heroIntervalTime);
            });
        }
    }

    // --- 6. Sorting Animation Logic ---
    const sortSelect = document.getElementById('sortSelect');
    const shopProducts = document.querySelectorAll('.shop-product-grid .premium-product-card');

    if (sortSelect && shopProducts.length > 0) {
        sortSelect.addEventListener('change', () => {
            // Re-trigger animations for each card
            shopProducts.forEach((product, index) => {
                // Remove animation and reset opacity
                product.style.animation = 'none';
                product.style.opacity = '0';

                // Trigger reflow to restart animation
                void product.offsetWidth;

                // Re-apply animation with delay
                product.style.animation = `fadeInUp 0.6s ease-out forwards ${index * 0.1}s`;
            });
        });
    }
    // --- 7. Mobile Menu Toggle Logic ---
    const menuToggle = document.getElementById('menuToggle');
    const closeMenu = document.getElementById('closeMenu');
    const mobileNav = document.getElementById('mobileNav');

    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', () => {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        });
    }

    if (closeMenu && mobileNav) {
        closeMenu.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    }

    // Close menu when clicking outside
    if (mobileNav) {
        mobileNav.addEventListener('click', (e) => {
            if (e.target === mobileNav) {
                mobileNav.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Close menu when clicking on a link
    const mobileLinks = document.querySelectorAll('.mobile-links a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
});
