document.addEventListener('DOMContentLoaded', () => {
    const thumbnails = document.querySelectorAll('.miniatura-btn');
    const mainImg = document.getElementById('main-product-img');
    const prevBtn = document.getElementById('prev-img-btn');
    const nextBtn = document.getElementById('next-img-btn');

    if (!mainImg || thumbnails.length === 0) return;

    let currentIndex = 0;

    const images = Array.from(thumbnails).map(thumb => {
        const img = thumb.querySelector('img');
        return {
            src: img.src
        };
    });

    function updateCarousel(index) {
        thumbnails[currentIndex].classList.remove('active');

        // Wrap around logic
        currentIndex = (index + images.length) % images.length;

        thumbnails[currentIndex].classList.add('active');
        mainImg.src = images[currentIndex].src;
    }

    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', () => {
            updateCarousel(index);
        });
    });

    prevBtn?.addEventListener('click', () => {
        updateCarousel(currentIndex - 1);
    });

    nextBtn?.addEventListener('click', () => {
        updateCarousel(currentIndex + 1);
    });
});
