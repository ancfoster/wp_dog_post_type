<?php

/**
 * Plugin Name: Dog Post Type Plugin for DMTDRSG
 * Description: A plugin to register a custom post type Dogs with taxonomies and post meta fields
 * Version: 1.0.0
 * Author: Alexander Foster
 * Author URI: https://alexanderfoster.design
 */

//define( 'ABSPATH', dirname(__FILE__) . '/' );

class Dogs_Post_Type {

// Constructor 
    public function __construct() {
        add_action( 'init', array( $this, 'register_dog_post_type' ) );
        add_action( 'init', array( $this, 'register_adoption_status_taxonomy' ) );
        // add_action( 'add_meta_boxes', array( $this, 'add_dog_meta_box' ) );
        // add_action( 'save_post', array( $this, 'save_dog_meta' ) );

    }

    // Register Dog Post Type
    public function register_dog_post_type() {
        $labels = array(
            'name' => 'Dogs',
            'singular_name' => 'Dog',
            'add_new' => 'Add New Dog',
            'add_new_item' => 'Add New Dog',
            'edit_item' => 'Edit Dog',
            'new_item' => 'New Dog',
            'all_items' => 'All Dogs',
            'view_item' => 'View Dog',
            'search_items' => 'Search Dogs',
            'not_found' => 'No Dogs Found',
            'not_found_in_trash' => 'No Dogs Found in Trash',
            'menu_name' => 'Dogs'
        );

        $icon_base64 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIGlkPSJMYXllcl8yIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA4OS40OSA1NS41Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2N1cnJlbnRDb2xvcjt9PC9zdHlsZT48L2RlZnM+PGcgaWQ9IkxheWVyXzEtMiI+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNjQuMTIsNTEuMDFjLS41LS4yMS0uODktMi4xMy0xLjE0LTMuOTMtMS4xOS4zNi0yLjQ3LjY0LTMuODUuODYtLjA2LjQ3LS4wOC44Mi0uMDguOTRsMS4wMSwzLjE0Yy41Ni4xNiwyLjY0LjgzLDMuMzksMi4xNS4yNC40Mi4zMS44Ny4yNCwxLjMzaDMuMTRjLjY5LTIuNDktMS45NS00LjE3LTIuNzEtNC40OWgwWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTkuNDQsMjYuNDVjLjEyLS4xMi4yNS0uMjMuMzktLjM0LTEuODQtLjg2LTQuNDYtMi4zNy01LjI1LTQuMzctLjM3LS45NC0uMy0xLjg4LjE5LTIuODIuNzUtMS4zOSwyLjY0LTMuNTIsNi45Mi0yLjE5LjYxLjE5LDEuNDEuMzQsMS43Ni0uMDUuNDItLjQ2LjEyLTEuNTUtLjA2LTIuMDMtLjQ4LS4yMy0zLTEuNC01LjY5LTEuNC0uODMsMC0xLjY4LjExLTIuNDkuMzktMS43LjYtMi45OSwxLjg3LTMuODMsMy43OC0xLjE0LDIuNi0xLjA4LDUuNDkuMTYsNy43MywxLjAyLDEuODUsMi43NSwzLjEyLDUuMDQsMy43NywxLjMyLTEuMzksMi42NS0yLjM0LDIuODUtMi40OGgwWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTE3LjAyLDQyLjkxYy0uNTUuMzQtMS4xMy43LTEuNzgsMS4wOS00LDIuMzQtOC45MiwxLjk4LTkuOTYsMS44Ny0xLjA0LDIuNTEtMS44Niw1LjM5LTEuNDIsNS44MSwxLjYsMS41MSwxLjkzLDIuNSwxLjk5LDIuOTZoMy45NmMwLTIuMzctMS44OC0yLjk0LTEuOTYtMi45Ni0uMTItLjA0LS4yLS4xNi0uMTgtLjI5bC42NC0zLjEzYy4wMi0uMS4xMS0uMTguMjEtLjIsNC40MS0uNjIsNy4wMS0zLjAxLDguNDktNS4xNWguMDJaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNLjI1LDU0LjY0aDUuMWMtLjA3LS4zNi0uMzgtMS4yMy0xLjgzLTIuNi0uOTItLjg3LjgyLTUuMjMsMS4zNy02LjU0LjA0LS4xLjE0LS4xNy4yNi0uMTUuMDUsMCw1LjU4LjcxLDkuODMtMS43OC45Mi0uNTQsMS43My0xLjA1LDIuNDUtMS41MSwyLjc1LTEuNzUsNC40Mi0yLjgsNy41NC0yLjM3LDEuMjkuMTgsNC4wNSwxLjIyLDcuNTUsMi41NCw2LjcxLDIuNTQsMTUuNzksNS45NSwyMS4xOCw1Ljg0LS4wNS0uMjctLjA3LS41MS0uMDYtLjY3LjA4LTEuMTMuNzItOC4wOSwxLjE5LTkuMjYuMDUtLjEzLjItLjE5LjMzLS4xNC4xMy4wNS4xOS4yLjE0LjMyLS4zOS45OC0xLjAzLDcuMjktMS4xNiw5LjExLS4wOCwxLjE1LDEuNzgsNi4wNiwyLjU5LDguMDZoNi40N2MuMDgtLjM4LjAyLS43NC0uMTgtMS4wOC0uNzUtMS4zMi0zLjE5LTEuOTQtMy4yMS0xLjk1LS4wOC0uMDItLjE1LS4wOC0uMTgtLjE3bC0xLjA3LTMuMzFzLS4wMS0uMDUtLjAxLS4wOGMwLS4xOS4xMS00LjU4LDIuNDktNS43Nyw1LjI1LTIuNjQsNS43My05LjQ0LDUuNzQtOS41MSwwLS4xNC4xLS4yNS4yNy0uMjMuMTQsMCwuMjQuMTMuMjMuMjYsMCwuMDctLjUsNy4xNS02LjAxLDkuOTMtMS4yOS42NS0xLjgzLDIuNS0yLjA1LDMuODQsNS4yMy0uODcsOC45OS0yLjQ2LDExLjMzLTcuMDYsMS42Ni0zLjI2LDEuOTItOC4yMSwyLjE1LTEyLjU5LjE4LTMuNS4zNC02LjUyLDEuMTYtOC4xOCwxLjgyLTMuNywzLjE0LTQuMDIsMy4yOC00LjA0LjE1LS4wMiwzLjY5LS41OSw1LjY3LS40MywxLjg2LjE2LDYuMS0yLjkxLDYuMzctMy42My4yMi0uNTcuNDQtMS4xNi4yMi0xLjYxLS4xMy0uMjctLjQyLS40OC0uODctLjYzLTEuNTgtLjUzLTguMTQtMi45NC04LjkzLTMuNTEtLjE5LS4xMy0uMzYtLjQtLjYyLS44MS0uOTMtMS40NC0yLjg1LTQuNDUtNy45OC00LjI3LS4xMSwwLS4yMS4wMi0uMzIuMDItLjAzLjk5LS4wNSw0Ljk3LDEuMjgsNy45OSwxLjE2LDIuNjQsMS4zNSw1LjMyLjQ3LDYuNjctLjQuNjItMS4wMS45NC0xLjc2Ljk0LTIuMDMsMC02LjkyLTQuNzktOC43OC05LS40OSwxLjI2LS44OSwyLjY2LTEuMjMsNC4xOC0uNDEsMS44Mi0uNTQsMy40Mi0uNjUsNC44My0uMjksMy42Ny0uNDgsNi4xLTUuNTQsNi45LTIuMTUuMzQtNywuMzMtMTIuNjEuMzEtMTIuMTMtLjA0LTI4LjczLS4wOS0zMi4wNiwzLjMxLS4wMS4wMS0uMDIuMDItLjA0LjAzLS4wNS4wNC01LjM5LDMuNzYtNS40OSw3LjU0LS4xLDMuODgsMCw1LjIyLDAsNS4yMywwLC4wNy0uMDIuMTUtLjA3LjItLjA1LjA1LS4xMy4wOC0uMi4wNy0uMDMsMC0yLjUtLjItMy4yNywxLjU0LS40Mi45NC0uMzIsMi44Ny0uMjIsNC43NC4wOSwxLjgzLjE4LDMuNTYtLjIsNC40NC0uNTksMS4zNi0uMTgsMy40MS0uMDMsNC4wM2wtLjAzLjAyWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTcwLjY1LDE1LjhjLjU4LDAsMS4wMy0uMjQsMS4zNC0uNzIuNzgtMS4yLjU3LTMuNzQtLjUtNi4yLTEuNDctMy4zNC0xLjM1LTcuNjQtMS4zMi04LjM1LS4zLS4zMy0xLjA2LS41My0yLjAzLS41My0uODIsMC0xLjc4LjE0LTIuNzYuNDYtMS4xMy4zNy0zLjc3LDEuNS0zLjczLDMuOTguMDcsNC4xOSw2LjY5LDExLjM2LDksMTEuMzZoMFoiLz48L2c+PC9zdmc+';

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'menu_icon' => $icon_base64,
            'supports' => array( 'title', 'thumbnail', 'custom-fields' ),
            'rewrite' => array( 'slug' => 'dogs')
        );

        register_post_type( 'dog', $args );
    }

    public function register_adoption_status_taxonomy() {
        $labels = array(
            'name' => 'Adoption Status',
            'singular_name' => 'Adoption Status',
        );
        $args = array(
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'show_in_quick_edit' => false,
            'hierarchical' => false,
            'show_in_rest' => true,
            'capabilities' => array(
                'manage_terms' => false,
                'edit_terms' => false,
                'delete_terms' => false,
                'assign_terms' => true
            )
        );

        register_taxonomy('adoption_status', 'dog', $args);

        $adoption_statuses = array(
            'adopted' => 'Adopted',
            'accepting_applications' => 'Accepting Applications',
            'processing_applications' => 'Processing Applications',
            'applications_opening_soon' => 'Applications Opening Soon',
            'alumni' => 'Alumni',
            'crossed_the_rainbow_bridge' => 'Crossed the Rainbow Bridge'
        );

        foreach ($adoption_statuses as $slug => $name) {
            if (!term_exists($slug, 'adoption_status')) {
                wp_insert_term($name, 'adoption_status', array('slug' => $slug));
            }
        }
    }

}

$dog_post_type = new Dogs_Post_Type();