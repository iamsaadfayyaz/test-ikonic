<?php get_header(); ?> 

<main>
<div id="page-wrapper">
    <div class="custom-container"> 
        <?php
        // Check if there are posts available
        if ( have_posts() ) :
            // Start the loop to display each post
            while ( have_posts() ) : the_post();
                ?>
                <h1><?php the_title(); ?></h1>

                <div class="project-thumbnail"> 
                    <?php the_post_thumbnail('large'); ?> 
                </div>

                <div class="project-content">
                    <?php the_content(); ?> 
                </div>

                <div class="project-details"> 
                    <h3>Project Details</h3> 
                    <!-- acf fields -->
                    <ul> 
                        <li><strong>Project Name:</strong> <?php the_title(); ?></li> 
                        <li><strong>Project Description:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'project_description', true)); ?></li> <!-- Display the project description from custom field -->
                        <li><strong>Start Date:</strong> <?php 
                            // Retrieve and format the project start date
                            $start_date = esc_html(get_post_meta(get_the_ID(), 'project_start_date', true)); 
                            echo date('d/m/Y', strtotime($start_date)); // Format date to 'day/month/year'
                        ?></li>
                        <li><strong>End Date:</strong> <?php 
                            // Retrieve and format the project end date
                            $end_date = esc_html(get_post_meta(get_the_ID(), 'project_end_date', true)); 
                            echo date('d/m/Y', strtotime($end_date)); // Format date to 'day/month/year'
                        ?></li>
                        <li><strong>Project URL:</strong> <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'project_url', true)); ?>" target="_blank"><?php echo esc_html(get_post_meta(get_the_ID(), 'project_url', true)); ?></a></li> <!-- Display the project URL with a link -->
                    </ul>
                </div>
                <?php
            endwhile; // End
        else :
            // Message if no project is found
            echo '<p>' . esc_html__('No project found.', 'ikonic') . '</p>';
        endif; 
        ?>
    </div>
    </div>
</main>

<?php get_footer(); ?> 
