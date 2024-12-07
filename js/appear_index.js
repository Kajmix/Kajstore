document.addEventListener("DOMContentLoaded", () => {
    const productBoxes = document.querySelectorAll('.product-box');
    productBoxes.forEach((box, index) => {
        setTimeout(() => {
            box.classList.add('appear');
        }, index * 100);
    });
});