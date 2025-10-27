document.addEventListener('DOMContentLoaded', function () {
    const animatedElements = document.querySelectorAll('.animated');
    
    // Define the IntersectionObserver callback
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the animation class to trigger the animation
                entry.target.classList.add('in-view');
                // Unobserve the element after animation triggers to prevent retriggering
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2 // Trigger when 20% of the element is visible
    });

    // Observe each animated element
    animatedElements.forEach(element => {
        observer.observe(element);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('feel-special-slider');
    
    if (!slider) {
        return; // Exit if slider doesn't exist
    }
    
    const items = slider.querySelectorAll('.slider-item');
    
    if (!items || items.length === 0) {
        return; // Exit if no slider items
    }
    
    let currentIndex = 0;

    function showSlide(index) {
        items.forEach((item, i) => {
            item.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % items.length;
        showSlide(currentIndex);
    }

    // Initialize slider and set interval
    showSlide(currentIndex);
    setInterval(nextSlide, 2500); // Change every 2.5 seconds
});


document.addEventListener('DOMContentLoaded', function () {
    const secondItem = document.querySelector('.breadcrumb-item.second-item');
    
    if (!secondItem) {
        return; // Exit if breadcrumb item doesn't exist
    }
    
    const url = '/lto/list';

    secondItem.addEventListener('click', function () {
        window.location.href = url;
    });
});
