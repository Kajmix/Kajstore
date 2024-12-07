document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const inputs = form.querySelectorAll("input[type='text'], input[type='email']");
    const selects = form.querySelectorAll("select");

    inputs.forEach(input => {
        const savedValue = localStorage.getItem(input.name);
        if (savedValue) {
            input.value = savedValue;
        }
    });

    selects.forEach(select => {
        const savedValue = localStorage.getItem(select.name);
        if (savedValue) {
            select.value = savedValue;
        }
    });

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            localStorage.setItem(input.name, input.value);
        });
    });

    selects.forEach(select => {
        select.addEventListener("change", () => {
            localStorage.setItem(select.name, select.value);
        });
    });

    form.addEventListener("submit", () => {
        inputs.forEach(input => localStorage.removeItem(input.name));
        selects.forEach(select => localStorage.removeItem(select.name));
    });
});