<div class="overlay"></div>

<div class="contact__form" id="contact__form">
    <?php get_template_part('assets/parts/contact'); ?>
</div>

<div class="lightbox">

    <button class="lightbox__close">✕</button>

    <button class="lightbox__prev">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-left_arrow.png" alt="">
        Précédente
    </button>

    <div class="lightbox__media">
        <img class="lightbox__img" src="" alt="">
    </div>

    <button class="lightbox__next">
        Suivante
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-right_arrow.png" alt="">
    </button>

    <div class="lightbox__footer">
        <span class="lightbox__reference"></span>
        <span class="lightbox__category"></span>
    </div>

</div>

<div class="footer">

<div class="separator"></div>
    <ul>
        <li><a href=".mentions-legales">Mentions Légales</a></li>
        <li><a href=".vie-privee">Vie privée</a></li>
        <li>Tous droits réservés</li>
    </ul>
</div>

<?php wp_footer(); ?>