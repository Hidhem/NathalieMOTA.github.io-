<article class="photo-card">

    <div class="photo-card__wrapper">

        <img
            class="photo-card__img"
            src="<?= get_the_post_thumbnail_url(get_the_ID(),'large'); ?>"
            data-full="<?= get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"
            data-reference="<?= esc_attr(get_post_meta(get_the_ID(),'reference',true)); ?>"
            data-category="<?= esc_attr(strip_tags(get_the_term_list(get_the_ID(),'categorie','',''))); ?>"
            alt="<?php the_title(); ?>"
        >

        <div class="photo-card__overlay">

            <button class="photo-card__expand" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.svg">
            </button>

            <a class="photo-card__eye" href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.svg"></a>

            <div class="photo-card__infos">
                <span><?= get_post_meta(get_the_ID(),'reference',true); ?></span>
                <span>
                    <?php
                    $terms = get_the_terms(get_the_ID(),'categorie');
                    echo ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : '';
                    ?>
                </span>
            </div>

        </div>

    </div>

</article>