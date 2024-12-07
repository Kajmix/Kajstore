document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const inputs = form.querySelectorAll("input[type='text'], input[type='date'], input[type='email'], input[type='password']");

    inputs.forEach(input => {
        const savedValue = localStorage.getItem(input.name);
        if (savedValue) {
            input.value = savedValue;
        }
    });

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            localStorage.setItem(input.name, input.value);
        });
    });

    form.addEventListener("submit", () => {
        inputs.forEach(input => localStorage.removeItem(input.name));
    });
});