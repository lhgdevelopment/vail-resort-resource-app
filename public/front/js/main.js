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
