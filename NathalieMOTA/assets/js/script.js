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
jQuery(function($){

    // ouverture contact + inject reference
    $(document).on('click', '.left__button', function(){

        const ref = $(this).data('reference');

        // ouvrir modal
        $('.contact__form').addClass('active');
        $('.overlay').addClass('active');

        // inject reference
        $('#photo-reference').val(ref);

    });

});

// Ajax filtered

jQuery(document).ready(function($) {
    function filterPhotos() {
        let categorie = $('#categorie-filter').val();
        let format = $('#format-filter').val();
        let sort = $('#sort-filter').val();
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_photos',
                categorie: categorie,
                format: format,
                sort: sort
            },
            success: function(response) {
                $('.photo-gallery__loop').html(response);
            }
        });
    }
    $('#categorie-filter').on('change', filterPhotos);
    $('#format-filter').on('change', filterPhotos);
    $('#sort-filter').on('change', filterPhotos);

});

// more load feature

jQuery(function($){
    let currentPage = 1;
    $('.load-more').on('click', function(e){
        e.preventDefault();
        currentPage++;
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                nonce: $(this).data('nonce'),
                page: currentPage,
                categorie: $('#categorie-filter').val(),
                format: $('#format-filter').val(),
                sort: $('#sort-filter').val()
            },
            success: function(response){
                if(response.success){
                    $('.photo-gallery__loop').append(response.data);
                }
            }
        });
    });
});

// lightbox 

document.addEventListener("DOMContentLoaded", () => {

    const lightbox = document.querySelector(".lightbox");
    const lightboxImg = document.querySelector(".lightbox__img");

    const prevBtn = document.querySelector(".lightbox__prev");
    const nextBtn = document.querySelector(".lightbox__next");
    const closeBtn = document.querySelector(".lightbox__close");

    const refBox = document.querySelector(".lightbox__reference");
    const catBox = document.querySelector(".lightbox__category");

    let images = [];
    let currentIndex = 0;

    function refreshImages() {
        images = Array.from(document.querySelectorAll(".photo-card__img"));
    }

    function openLightbox(index) {
        currentIndex = index;

        const img = images[currentIndex];

        lightboxImg.src = img.dataset.full || img.src;
        refBox.textContent = img.dataset.reference || "";
        catBox.textContent = img.dataset.category || "";

        lightbox.classList.add("active");
    }

    function closeLightbox() {
        lightbox.classList.remove("active");
    }

    document.addEventListener("click", (e) => {

        const btn = e.target.closest(".photo-card__expand");

        if (!btn) return;

        refreshImages();

        const wrapper = btn.closest(".photo-card__wrapper");
        const img = wrapper.querySelector(".photo-card__img");

        currentIndex = images.indexOf(img);

        openLightbox(currentIndex);
    });

    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        openLightbox(currentIndex);
    });

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        openLightbox(currentIndex);
    });

    closeBtn.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) closeLightbox();
    });

});