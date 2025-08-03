const form = document.getElementById("donationForm");

const emailInput = document.getElementById("email");
const phoneInput = document.getElementById("phone");
const passwordInput = document.getElementById("password");
const nameInput = document.getElementById("name");
const amountInput = document.getElementById("amount");
const termsCheckbox = document.getElementById("terms");

function validateEmail() {
    const email = emailInput.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (regex.test(email)) {
        setValid(emailInput);
        return true;
    } else {
        setInvalid(emailInput);
        return false;
    }
}

function validatePhone() {
    const phone = phoneInput.value.trim();
    if (/^\d{11}$/.test(phone)) {
        setValid(phoneInput);
        return true;
    } else {
        setInvalid(phoneInput);
        return false;
    }
}

function validatePassword() {
    const password = passwordInput.value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
    if (regex.test(password)) {
        setValid(passwordInput);
        return true;
    } else {
        setInvalid(passwordInput);
        return false;
    }
}

function setValid(element) {
    element.classList.add("valid");
    element.classList.remove("invalid");
}

function setInvalid(element) {
    element.classList.add("invalid");
    element.classList.remove("valid");
}

[emailInput, phoneInput, passwordInput].forEach(input => {
    input.addEventListener("input", () => {
        if (input === emailInput) validateEmail();
        if (input === phoneInput) validatePhone();
        if (input === passwordInput) validatePassword();
    });

    input.addEventListener("focus", () => {
        input.classList.add("focused");
    });

    input.addEventListener("blur", () => {
        input.classList.remove("focused");
    });
});

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const isEmailValid = validateEmail();
    const isPhoneValid = validatePhone();
    const isPasswordValid = validatePassword();
    const isNameFilled = nameInput.value.trim().length >= 3;
    const isAmountFilled = amountInput.value.trim() !== "";
    const isTermsChecked = termsCheckbox.checked;

    if ( isEmailValid && isPhoneValid && isPasswordValid && isNameFilled && isAmountFilled && isTermsChecked ) {
        alert("Form submitted successfully!");
        form.reset();
        document.querySelectorAll("input").forEach(input => {
            input.classList.remove("valid", "invalid");
        });
    }
    else {
        alert("Please fill all fields correctly.");
    }
});
