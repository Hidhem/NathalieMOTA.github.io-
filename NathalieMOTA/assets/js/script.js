document.addEventListener("DOMContentLoaded", () => {

    const burger = document.querySelector(".navigation__burger");
    const menu = document.querySelector("#nav__burger-menu");
    const menuMobile = document.querySelector(".menu__mobile");

    const contactButton = document.querySelector(".burger__contact");
    const contactForm = document.querySelector(".contact__form");
    const overlay = document.querySelector(".overlay");

    // Burger menu
    burger.addEventListener("click", () => {
        menu.classList.toggle("active");
        menuMobile.classList.toggle("active");
        burger.classList.toggle("active");
    });

    // Open contact
    contactButton.addEventListener("click", () => {
        contactForm.classList.add("active");
        overlay.classList.add("active");
    });

    // close contact
    overlay.addEventListener("click", () => {
        contactForm.classList.remove("active");
        overlay.classList.remove("active");
    });

});