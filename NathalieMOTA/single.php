<?php get_header(); ?>
<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<main>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
                <div class="full-single">

                    <div class="single__hero">
                        <div class="single__description">
                            <ul>
                                <h1><?php the_title(); ?></h1>
                                <li>RÉFÉRENCE : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></li>
                                <li>CATÉGORIE :  <?php the_terms(get_the_ID(), 'categorie'); ?></li>
                                <li>FORMAT :  <?php the_terms(get_the_ID(), 'format'); ?></li>
                                <li>TYPE : <?php echo get_post_meta(get_the_ID(), 'type', true); ?></li>
                                <li>ANNÉE : <?php echo get_the_date('Y'); ?></li>
                            </ul>
                            <span class="separator"></span>
                        </div>
                        <div class="single__photo">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    </div>

                    <div class="single__contact">
                        <div contact__left>
                            <span>Cette photo vous intéresse ?</span>
                            <button class="left__button"
                                data-reference="<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>">
                                Contact
                            </button>
                        </div>
                        <div class="contact__side">
                            <div class="side__previeuw">
                                <?php if($next_post): ?>
                                <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <?php echo get_the_post_thumbnail($next_post->ID, 'medium'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="side__arrow">
                                <div class="arrow__left">
                                    <?php if($prev_post): ?>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/left_arrow.png" alt="">
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <div class="arrow__right">
                                    <?php if($next_post): ?>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/right_arrow.png" alt="">
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="separator"></div>

                    <div class="single__more">

                        <span>VOUS AIMEREZ AUSSI</span>
                            <?php $current_categories = wp_get_post_terms(get_the_ID(), 'categorie', ['fields' => 'ids']);
                                $args = [
                                'post_type' => 'photo',
                                'posts_per_page' => 2,
                                'post__not_in' => [get_the_ID()],
                                'tax_query' => [[
                                'taxonomy' => 'categorie',
                                'field' => 'term_id',
                                'terms' => $current_categories]]];
                                $related_photos = new WP_Query($args);?>

                        <div class="more__photos">
                            <?php if ($related_photos->have_posts()) : ?>
                            <?php while ($related_photos->have_posts()) : $related_photos->the_post(); ?>

                        <div class="photo-card">
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                            </a>

                        </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                        
                </div>
        </div>
<?php endwhile; ?>
<?php endif; ?>

</main>

<?php get_footer(); ?>