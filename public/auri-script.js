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

    // 3. Header Styling on Scroll
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
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
            // Decrease rotation to pull the next element straight to the card
            currentRotation -= stepAngle;
            centerpiece.style.transform = `rotate(${currentRotation}deg)`;

            nodes.forEach((node, index) => {
                const element = node.getAttribute('data-element');
                const info = node.getAttribute('data-info');

                // Perfectly space the elements (72 degrees apart for 5 nodes)
                const initialOffset = index * (360 / totalNodes);

                // Sync counter-rotation to keep icons upright
                node.style.transform = `rotate(${initialOffset}deg) translate(var(--orbit-radius)) rotate(${-initialOffset - currentRotation}deg)`;

                // Normalize angle to 0-360 range
                let normalizedAngle = (initialOffset + currentRotation) % 360;
                while (normalizedAngle < 0) normalizedAngle += 360;

                // Active detection: triggers when a node lands at the RIGHT (0 deg)
                if (Math.abs(normalizedAngle) < 1 || Math.abs(normalizedAngle - 360) < 1) {
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
