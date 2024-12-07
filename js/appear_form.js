document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll('form');
    forms.forEach((form, index) => {
        setTimeout(() => {
            form.classList.add('appear');
        }, index * 200);
    });
});