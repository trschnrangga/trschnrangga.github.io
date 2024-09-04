const container = document.getElementById('scroll-container');

container.addEventListener('wheel', (event) => {
    event.preventDefault();
    container.scrollLeft += event.deltaY * 2;  // Adjust the multiplier to change scroll speed
});


container.addEventListener('wheel', (event) => {
    event.preventDefault();

    // Scroll by a certain amount, making it smoother using requestAnimationFrame
    smoothScroll(container, event.deltaY);
});

function smoothScroll(element, delta) {
    const duration = 1; // Scroll animation duration in milliseconds
    const start = element.scrollLeft;
    const end = start + delta * 4; // Adjust multiplier to change scroll speed
    const startTime = performance.now();

    function scrollAnimation(currentTime) {
        const elapsedTime = currentTime - startTime;
        const progress = Math.min(elapsedTime / duration, 1); // Clamp progress to [0, 1]
        element.scrollLeft = start + (end - start) * easeInOutQuad(progress);

        if (progress < 1) {
            requestAnimationFrame(scrollAnimation);
        }
    }

    requestAnimationFrame(scrollAnimation);
}

// Ease-in-out quad function for a smooth scroll effect
function easeInOutQuad(t) {
    return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
}