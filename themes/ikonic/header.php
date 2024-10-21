<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <div class="container">
        <header>
            <nav class="navbar">
                <!-- Hamburger icon -->
                <button class="menu-toggle" aria-label="Toggle Navigation" id="hamburger">
                    <span class="hamburger-icon"></span>
                    <span class="hamburger-icon"></span>
                    <span class="hamburger-icon"></span>
                </button>

                <!-- Main Navigation Menu -->
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'menu_class'     => 'nav-menu cstm-class',
                    'container'      => false,
                    'depth'          => 4,
                ));
                ?>
            </nav>
        </header>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
