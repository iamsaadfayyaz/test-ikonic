<?php
/*
Template Name: Blog
*/ // This comment defines the template name for the WordPress admin to identify it

// Include the header template
get_header(); ?>
<div id="page-wrapper">
<div id="blog-content"> <!-- Main content area for the blog -->
    <div class="container">
    <h2>Latest Posts</h2> <!-- Heading for the blog section -->
    <?php
    // Create a new WP_Query to fetch the latest 5 posts
    $blog_posts = new WP_Query( array( 'posts_per_page' => 5 ) );

    // Check if there are any posts to display
    if ( $blog_posts->have_posts() ) :
        // Loop through the posts
        while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
            <h3><a href="<?php the_permalink(); ?>"> <!-- Link to the full post -->
                <?php the_title(); ?></a> <!-- Display the post title -->
            </h3>
            <p><?php the_excerpt(); ?></p> <!-- Display the post excerpt -->
        <?php endwhile; // End the loop
    else :
        // If no posts found, display a message
        echo '<p>No posts found</p>';
    endif;

    // Reset post data to ensure global post data is restored
    wp_reset_postdata();
    ?>
    </div>
</div>
</div>
<?php // Include the footer template
get_footer(); ?>
