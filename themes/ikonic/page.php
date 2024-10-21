<?php get_header(); ?> <!-- Include the header -->

<div id="page-wrapper"> <!-- Wrapper to hold content and footer -->
    <div id="main-content"> <!-- Main content area -->
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content(); // Display the page content
                endwhile;
            else :
                echo '<p>No content found</p>';
            endif;
            ?>
        </div>
    </div>

    <?php get_footer(); ?> <!-- Include the footer -->
</div>
