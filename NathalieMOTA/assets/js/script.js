document.addEventListener("DOMContentLoaded", () => {

    const burger = document.querySelector(".navigation__burger");
    const menu = document.querySelector("#nav__burger-menu");
    const menuMobile = document.querySelector(".menu__mobile");

    const contactButton = document.querySelector(".burger__contact");
    const contactForm = document.querySelector(".contact__form");
    const overlay = document.querySelector(".overlay");

    const singleContactButton = document.querySelector(".left__button");

    // Burger menu
    if (burger && menu && menuMobile) {
        burger.addEventListener("click", () => {
            menu.classList.toggle("active");
            menuMobile.classList.toggle("active");
            burger.classList.toggle("active");
        });
    }

    // Open contact (header button)
    if (contactButton && contactForm && overlay) {
        contactButton.addEventListener("click", () => {
            contactForm.classList.add("active");
            overlay.classList.add("active");
        });
    }

    // Open contact (single page button)
    if (singleContactButton && contactForm && overlay) {
        singleContactButton.addEventListener("click", () => {
            contactForm.classList.add("active");
            overlay.classList.add("active");
        });
    }

    // close contact on overlay click
    if (overlay && contactForm) {
        overlay.addEventListener("click", () => {
            contactForm.classList.remove("active");
            overlay.classList.remove("active");
        });
    }

});


// Jquerry

jQuery(function($) {

    $(document).on('click', '.left__button', function() {

        const ref = $(this).data('reference');

        $('#photo-reference').val(ref);

    });

});