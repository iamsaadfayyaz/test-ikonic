<?php

// Enque stylesheet and js and cdn's
function ikonic_enqueue_scripts() {
        // Enqueue main stylesheet
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    // Enqueue jQuery from Google CDN
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);

    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true);

    // Enqueue your theme's main stylesheet (if you have one)
    wp_enqueue_style('ikonic-style', get_stylesheet_directory_uri() . '/assets/css/style.css');
     // Enqueue the main stylesheet
     wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all' );

     // Enqueue the main script file
     wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/mobile-menu.js', array('jquery'), '1.0.0', true );
}

add_action('wp_enqueue_scripts', 'ikonic_enqueue_scripts');

// Register Navigation Menu
function ikonic_register_main_menu() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu', 'ikonic' ),
        )
    );
}
add_action( 'init', 'ikonic_register_main_menu' );

// Register Custom Post Type: Projects
function create_project_post_type() {
    $labels = array(
        'name'               => __( 'Projects', 'text_domain' ),
        'singular_name'      => __( 'Project', 'text_domain' ),
        'menu_name'          => __( 'Projects', 'text_domain' ),
        'name_admin_bar'     => __( 'Project', 'text_domain' ),
        'add_new'            => __( 'Add New', 'text_domain' ),
        'add_new_item'       => __( 'Add New Project', 'text_domain' ),
        'new_item'           => __( 'New Project', 'text_domain' ),
        'edit_item'          => __( 'Edit Project', 'text_domain' ),
        'view_item'          => __( 'View Project', 'text_domain' ),
        'all_items'          => __( 'All Projects', 'text_domain' ),
        'search_items'       => __( 'Search Projects', 'text_domain' ),
        'not_found'          => __( 'No Projects found.', 'text_domain' ),
        'not_found_in_trash' => __( 'No Projects found in Trash.', 'text_domain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'create_project_post_type' );



// Register Custom API Endpoint for Projects
function register_projects_api_endpoint() {
    register_rest_route( 'my_ikonic/v1', '/projects', array(
        'methods'  => 'GET',
        'callback' => 'get_projects_list',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'register_projects_api_endpoint' );

// Callback function to fetch projects
function get_projects_list( $request ) {
    // Query for projects
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1, 
    );
    $projects = get_posts( $args );

    // Prepare response data
    $project_list = array();
    foreach ( $projects as $project ) {
        $project_list[] = array(
            'title' => get_the_title( $project->ID ),
            'url'   => esc_url(get_post_meta($project->ID, 'project_url', true)),
            'start_date' => esc_html(get_post_meta($project->ID, 'project_start_date', true)),
            'end_date'   => esc_html(get_post_meta($project->ID, 'project_end_date', true)),
        );
    }

    // Return the response
    return new WP_REST_Response( $project_list, 200 );
}


?>