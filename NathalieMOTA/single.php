<?php get_header(); ?>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<main class="single-photo">

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<section class="single-photo__hero">

    <div class="single-photo__infos">

        <h1><?php the_title(); ?></h1>

        <ul>
            <li>RÉFÉRENCE : <?php echo get_post_meta(get_the_ID(),'reference',true); ?></li>

            <li>CATÉGORIE :
                <?php the_terms(get_the_ID(),'categorie'); ?>
            </li>

            <li>FORMAT :
                <?php the_terms(get_the_ID(),'format'); ?>
            </li>

            <li>TYPE :
                <?php echo get_post_meta(get_the_ID(),'type',true); ?>
            </li>

            <li>ANNÉE :
                <?php echo get_the_date('Y'); ?>
            </li>
        </ul>

        <div class="separator__middle"></div>

    </div>

    <div class="single-photo__image">
        <?php the_post_thumbnail('large'); ?>
    </div>
</section>


<section class="single-contact">

    <div class="contact__left">
        <p>Cette photo vous intéresse ?</p>
        <button
            class="left__button"
            data-reference="<?php echo get_post_meta(get_the_ID(),'reference',true); ?>">
            Contact
        </button>
    </div>

    <div class="contact__right">

        <div class="preview">
            <?php if($next_post): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>">
                    <?php echo get_the_post_thumbnail($next_post->ID,'medium'); ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="navigation">
            <?php if($prev_post): ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/left_arrow.png" alt="">
                </a>
            <?php endif; ?>
            <?php if($next_post): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/right_arrow.png" alt="">
                </a>
            <?php endif; ?>
        </div>

    </div>

</section>

<div class="separator"></div>

<section class="single-more">

    <h2>VOUS AIMEREZ AUSSI</h2>

    <?php
    $current_categories = wp_get_post_terms(
        get_the_ID(),
        'categorie',
        ['fields'=>'ids']
    );
    $args = [
        'post_type'=>'photo',
        'posts_per_page'=>2,
        'post__not_in'=>[get_the_ID()],
        'tax_query'=>[
            [
                'taxonomy'=>'categorie',
                'field'=>'term_id',
                'terms'=>$current_categories
            ]
        ]
    ];
    $related = new WP_Query($args);
    ?>

    <div class="more__photos">

        <?php while($related->have_posts()) : $related->the_post(); ?>
            <?php get_template_part('template-parts/photo-card'); ?>
        <?php endwhile; wp_reset_postdata(); ?>

    </div>

</section>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>