document.addEventListener('DOMContentLoaded', () => {

    // 1. Reveal on Scroll Observer
    const revealElements = document.querySelectorAll('.reveal');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    });

    revealElements.forEach(el => revealObserver.observe(el));

    // 2. FAQ Accordion Logic
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const head = item.querySelector('.faq-head');
        head.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all
            faqItems.forEach(i => {
                i.classList.remove('active');
                i.querySelector('i').classList.replace('fa-minus', 'fa-plus');
            });

            // Toggle clicked
            if (!isActive) {
                item.classList.add('active');
                head.querySelector('i').classList.replace('fa-plus', 'fa-minus');
            }
        });
    });

    // 3. Navbar background on scroll
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.style.boxShadow = "0 5px 20px rgba(0,0,0,0.05)";
            nav.style.padding = "10px 0";
        } else {
            nav.style.boxShadow = "none";
            nav.style.padding = "20px 0";
        }
    });

    // 4. Pancha Buthas Orbit & Side Popup Logic (Stepped Rotation)
    const centerpiece = document.querySelector('.radial-centerpiece');
    const nodes = document.querySelectorAll('.radial-node');
    const popup = document.getElementById('orbit-side-popup');
    const popupTitle = document.getElementById('popup-title');
    const popupText = document.getElementById('popup-text');

    if (centerpiece && nodes.length > 0 && popup) {
        let currentRotation = 0;
        const totalNodes = nodes.length;
        const stepAngle = 360 / totalNodes;

        const updateOrbitStep = () => {
            // Increase rotation for clockwise movement
            currentRotation += stepAngle;
            centerpiece.style.transform = `rotate(${currentRotation}deg)`;

            nodes.forEach((node, index) => {
                const element = node.getAttribute('data-element');
                const info = node.getAttribute('data-info');

                // Initial degree offsets for the 5 elements (must match CSS)
                let initialOffset = 0;
                if (node.classList.contains('node-ether')) initialOffset = 0;
                if (node.classList.contains('node-air')) initialOffset = 72;
                if (node.classList.contains('node-fire')) initialOffset = 144;
                if (node.classList.contains('node-water')) initialOffset = 216;
                if (node.classList.contains('node-earth')) initialOffset = 288;

                // Sync counter-rotation to keep icons upright
                node.style.transform = `rotate(${initialOffset}deg) translate(250px) rotate(${-initialOffset - currentRotation}deg)`;

                // Landing on the right means world angle is 0 (mod 360)
                // World angle = initialOffset + currentRotation
                const worldAngle = (initialOffset + currentRotation) % 360;

                if (Math.abs(worldAngle) < 1 || Math.abs(worldAngle - 360) < 1) {
                    node.classList.add('active');

                    // Update Dynamic Popup
                    popup.classList.remove('active');
                    setTimeout(() => {
                        popupTitle.innerText = element;
                        popupText.innerText = info;
                        popup.classList.add('active');
                    }, 300);
                } else {
                    node.classList.remove('active');
                }
            });
        };

        // Initial trigger
        updateOrbitStep();

        // 4 seconds interval: 1s transition (CSS) + 3s pause
        setInterval(updateOrbitStep, 4000);
    }


});
