<?php get_header(); ?> <!-- Include the header template -->

<main>
<div id="page-wrapper">
    <div class="my-container">
        <h1><?php post_type_archive_title(); ?></h1> 

        <!-- Date filter form -->
        <form method="GET" id="project-filter">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo esc_attr( isset($_GET['start_date']) ? $_GET['start_date'] : '' ); ?>">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo esc_attr( isset($_GET['end_date']) ? $_GET['end_date'] : '' ); ?>">
            <button type="submit">Filter</button>
        </form>

        <?php
        // Set WP_Query
        $args = array(
            'post_type' => 'projects', 
            'posts_per_page' => -1,    
        );

        // Check for start date filter and add to query
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $start_date = sanitize_text_field($_GET['start_date']); // Sanitize input
            $args['meta_query'][] = array(
                'key'     => 'project_start_date',
                'value'   => $start_date,
                'compare' => '>=', 
                'type'    => 'DATE',
            );
        }

        // Check for end date filter and add to query
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $end_date = sanitize_text_field($_GET['end_date']); // Sanitize input
            $args['meta_query'][] = array(
                'key'     => 'project_end_date',
                'value'   => $end_date,
                'compare' => '<=',
                'type'    => 'DATE',
            );
        }

        // Execute the query
        $projects = new WP_Query( $args );

        // Check if there are any projects found
        if ( $projects->have_posts() ) :
            echo '<div class="projects-list">'; 
            while ( $projects->have_posts() ) : $projects->the_post(); ?>
                <div class="project-item">
                    <h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="project-thumbnail">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="project-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
            endwhile; // End loop
            echo '</div>'; 

            // Pagination
            the_posts_pagination( array(
                'mid_size' => 2, 
                'prev_text' => __( 'Previous', 'ikonic' ), 
                'next_text' => __( 'Next', 'ikonic' ), 
            ) );
        else :
            // If no projects found, display a message
            echo '<p>' . esc_html__('No projects found.', 'ikonic') . '</p>';
        endif;

        
        wp_reset_postdata();
        ?>
    </div>
    </div>
</main>

<?php get_footer(); ?>
