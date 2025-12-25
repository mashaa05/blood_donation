document.addEventListener("DOMContentLoaded", () =>
{
    const form = document.getElementById("registrationForm");
    const nameInput = document.querySelector('input[type="text"]');
    const phoneInput = document.querySelector('input[type="tel"]');
    const passwordInput = document.querySelectorAll('input[type="password"]')[0];
    const confirmPasswordInput = document.querySelectorAll('input[type="password"]')[1];
    const termsCheckbox = document.querySelector('input[type="checkbox"]');

    const nameRegex = /^[A-Za-z\s]+$/;
    const phoneRegex = /^\+8801[3-9]\d{8}$/;
    const passwordRegex = /^(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    function showMessage(input, message, color = "red")
    {
        let msg = input.parentElement.querySelector(".inline-msg");
        if (!msg)
        {
            msg = document.createElement("small");
            msg.className = "inline-msg";
            input.parentElement.appendChild(msg);
        }
        msg.textContent = message;
        msg.style.color = color;
    }

    function clearMessage(input)
    {
        const msg = input.parentElement.querySelector(".inline-msg");
        if (msg) msg.textContent = "";
    }

    phoneInput.addEventListener("input", () =>
    {
        let value = phoneInput.value.replace(/\D/g, "");

        if (!value.startsWith("880"))
        {
            value = "880" + value.replace(/^0+/, "");
        }

        value = value.slice(0, 13);
        phoneInput.value = "+" + value;

        if (!phoneRegex.test(phoneInput.value))
        {
            showMessage(phoneInput, "Enter a Validd Bangladeshi Number");
        }
        else
        {
            clearMessage(phoneInput);
        }
    });

    passwordInput.addEventListener("input", () =>
    {
        if (!passwordRegex.test(passwordInput.value))
        {
            showMessage(passwordInput, "Min 8 Characters, 1 Number & 1 Special Character");
        }
        else
        {
            showMessage(passwordInput, "Strong password", "Green");
        }
    });

    confirmPasswordInput.addEventListener("input", () =>
    {
        if (confirmPasswordInput.value !== passwordInput.value)
        {
            showMessage(confirmPasswordInput, "Passwords Do Not Match");
        }
        else
        {
            showMessage(confirmPasswordInput, "Passwords Match", "Green");
        }
    });

    form.addEventListener("submit", e =>
    {
        e.preventDefault();

        const roleInput = document.querySelector('input[name="value"]:checked');

        if(!nameRegex.test(nameInput.value.trim()))
        {
            alert("Name Can Contain Only Letters and Spaces");
            return;
        }

        if(!phoneRegex.test(phoneInput.value))
        {
            alert("Enter A Valid Phone Number Starting With +880");
            return;
        }

        if(!passwordRegex.test(passwordInput.value))
        {
            alert("Password Does Not Meet Security Requirements");
            return;
        }

        if(passwordInput.value !== confirmPasswordInput.value)
        {
            alert("Passwords Do Not Match");
            return;
        }

        if(!roleInput)
        {
            alert("Please Select A Role");
            return;
        }

        if(!termsCheckbox.checked)
        {
            alert("You Must Accept The Terms & Conditions");
            return;
        }

        let roleText = document.querySelector(`label[for="${roleInput.id}"]`).innerText.toLowerCase();
        let activationTime = "now";

        if
        (
            roleText.includes("admin") ||
            roleText.includes("hospital") ||
            roleText.includes("volunteer")
        )
        {
            activationTime = "after 48 hours";
        }

        const popupWidth = 450;
        const popupHeight = 300;
        const left = (screen.width - popupWidth) / 2;
        const top = (screen.height - popupHeight) / 2;

        const popup = window.open
        (
            `registration-popup.html?role=${roleText}&activation=${activationTime}`,
            "registration confirmation",
            `width=${popupWidth},height=${popupHeight},top=${top},left=${left}`
        );

        if (popup)
        {
            window.close();
        }
    });
});
