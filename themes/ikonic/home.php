<?php
/*
Template Name: Home
*/

// Get the header template for the theme
get_header(); ?>

<!-- Main content area for the homepage -->
<div id="page-wrapper">
<div id="homepage-content">
    <div class="container">
        <!-- Main heading for the homepage -->
        <p class="text-left l-p"><strong>Welcome to Ikonic Theme</strong></p>
    </div>

    <?php
    // Check if there are posts to display
    if ( have_posts() ) :
        // Loop through each post
        while ( have_posts() ) : the_post();
            // Display the content of the post
            the_content();
        endwhile;
    else :
        // Display a message if no content is found
        echo '<p>No content found</p>';
    endif;
    ?>
</div>
</div>
<!-- Get the footer template for the theme -->
<?php get_footer(); ?>
