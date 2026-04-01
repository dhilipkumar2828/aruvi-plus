function updateSpotlight(element) {
    // 1. Remove active class from all side items
    const allItems = document.querySelectorAll('.side-product-card');
    allItems.forEach(item => item.classList.remove('active-trigger'));

    // 2. Add active class to clicked item
    element.classList.add('active-trigger');

    // 3. Get data from clicked item
    const image = element.getAttribute('data-image');
    const title = element.getAttribute('data-title');
    const price = element.getAttribute('data-price');
    const desc = element.getAttribute('data-desc');
    const stars = parseFloat(element.getAttribute('data-stars'));

    // 4. Update Main Card Elements with visual transition
    const mainCard = document.getElementById('spotlight-main');

    // Add fade out effect
    mainCard.classList.add('fade-out');

    setTimeout(() => {
        // Update Content
        document.getElementById('main-image').src = image;
        document.getElementById('main-title').textContent = title;
        document.getElementById('main-price').textContent = price;
        document.getElementById('main-desc').textContent = desc;

        // Update Stars
        const ratingContainer = document.getElementById('main-rating');
        ratingContainer.innerHTML = ''; // clear existing

        // Full stars
        for (let i = 0; i < Math.floor(stars); i++) {
            ratingContainer.innerHTML += '<i class="fas fa-star"></i>';
        }
        // Half star
        if (stars % 1 !== 0) {
            ratingContainer.innerHTML += '<i class="fas fa-star-half-alt"></i>';
        }

        // Remove fade out (fade in)
        mainCard.classList.remove('fade-out');
    }, 300); // 300ms matches CSS transition
}

// Auto-initialize first item logic if needed?
// No, HTML handles default state. JS just handles updates.
