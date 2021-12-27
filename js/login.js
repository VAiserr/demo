let loginInput = document.querySelector('#login'),
    emailInput = document.querySelector('#email');

emailInput.style.width = "10%";
emailInput.setAttribute("tabindex", "-1");

function selectSwitch(target1, target2) {
    target1.style.width = "100%";
    target1.removeAttribute("tabindex");

    target2.style.width = "10%";
    target2.value = "";
    target2.setAttribute("tabindex", "-1");
}

loginInput.addEventListener("click", () => { selectSwitch(loginInput, emailInput) });
emailInput.addEventListener("click", () => { selectSwitch(emailInput, loginInput) });