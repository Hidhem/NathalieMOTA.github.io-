<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <nav id="site-navigation" class="site-navigation">
            <img class="navigation__logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/Nathalie_Mota.png" alt="logo">
            <div class="navigation__burger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
            <ul>
                <li><a href=".accueil">ACCUEIL</a></li>
                <li><a href=".accueil">À PROPOS</a></li>
                <li class="burger__contact">CONTACT</li>
            </ul>
		</nav>
        <div id="nav__burger-menu" class="nav__burger-menu">
                <?php get_template_part( 'assets/parts/burgerMenu' ); ?>
        </div>
    </header>
<div id="container">
<main id="content" role="main">