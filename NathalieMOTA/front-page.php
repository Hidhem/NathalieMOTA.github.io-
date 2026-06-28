<?php get_header(); ?>
<section class="hero">
    <h1>PHOTOGRAPHE EVENT</h1>
</section>
<section class="photo-gallery">
    <div class="photo-gallery__filter">
        <div>
            <div class="select-wrapper">
                <select class="filter" name="categorie" id="categorie-filter">
                    <option value="">CATÉGORIES</option>
                        <?php
                        $categories = get_terms([
                        'taxonomy' => 'categorie',
                        'hide_empty' => true,
                        ]);
                        foreach ($categories as $categorie) :
                        ?>
                        <option value="<?php echo esc_attr($categorie->slug); ?>">
                        <?php echo esc_html($categorie->name); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="select-wrapper">
                <select class="filter" name="format" id="format-filter">
                    <option value="">FORMATS</option>
                        <?php
                        $format = get_terms([
                        'taxonomy' => 'format',
                        'hide_empty' => true,
                        ]);
                        foreach ($format as $format) :
                        ?>
                        <option value="<?php echo esc_attr($format->slug); ?>">
                        <?php echo esc_html($format->name); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="select-wrapper">
            <div class="select-wrapper">
                <select class="filter" name="sort by" id="sort-filter">
                    <option value="">TRIER PAR</option>
                    <option value="DESC">Plus récentes</option>
                    <option value="ASC">Plus anciennes</option>
                </select>
            </div>
        </div>      
    </div>

    <div class="photo-gallery__loop">
        <?php
            $args = [
            'post_type' => 'photo',
            'posts_per_page' => 8];
            $photos = new WP_Query($args);
            if ($photos->have_posts()) :
            while ($photos->have_posts()) :
            $photos->the_post();
            get_template_part('template-parts/photo-card');
            endwhile;
            wp_reset_postdata();
            endif;
        ?>
    </div>
    <div class="photo-gallery__button">
        <div class="photo-gallery__button">
            <button
                class="load-more"
                data-nonce="<?php echo wp_create_nonce('load_more_photos'); ?>">Charger plus
            </button>
</div>
    </div>
</section>
<?php get_footer(); ?>