<?php

/**
 * Plugin name: Q CPT
 * Author: Davor Novoselac
 * Description: This is a test plugin for Q Agency
 * Version: 1.0.0
 * Text Domain: q-cpt
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Create basic security
if ( !defined( 'ABSPATH' ) ) {
    echo 'Hi, nothing for you here when called directly.';
    exit;
}

// Main QCPT class
class QCPT {
    // Running our get_api_data function in contructor
    public function __construct() {
        // Load assets, css, js
        add_action( 'init', [ $this, 'load_assets' ] );
        // Hooking up our function to theme setup
        add_action( 'init', [ $this, 'q_create_cpt' ] );
        // Add meta field
        add_action( 'add_meta_boxes', [ $this, 'q_add_meta_boxes' ] );
        // Save meta field value on save post
        add_action( 'save_post', [ $this, 'q_save_meta_box' ] );
    }
    // Load all assets, css and js
    public function load_assets() {
        // Load css
        wp_enqueue_style(
            'qcpt-css',
            plugin_dir_url( __FILE__ ) . 'css/qcpt.css',
            array(),
            1,
            'all'
        );
    }

    public function q_create_cpt() {
        // CPT Supports
        $supports = array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        );
        // CPT Labels
        $labels = array(
            'name'              => _x( 'Movies', 'plural' ),
            'singular_name'     => _x( 'Movie', 'singular' ),
            'menu_name'         => _x( 'Movies', 'admin menu' ),
            'name_admin_bar'    => _x( 'Movies', 'admin bar' ),
            'add_new'           => _x( 'Add New', 'add new' ),
            'add_new_item'      => __( 'Add New movie' ),
            'new_item'          => __( 'New movie' ),
            'edit_item'         => __( 'Edit movie' ),
            'view_item'         => __( 'View movie' ),
            'all_items'         => __( 'All movies' ),
            'search_items'      => __( 'Search movies' ),
            'not_found'         => __( 'No movies found.' ),
        );
        // CPT Args
        $args = array(
            'supports'          => $supports,
            'labels'            => $labels,
            'public'            => true,
            'query_var'         => true,
            'has_archive'       => true,
            'hierarchical'      => true,
            'capability_type'   => 'post',
            'show_in_rest'      => true
        );
        // Register new CPT
        register_post_type( 'movies', $args );
    }

    // Meta Box Add
    public function q_add_meta_boxes() {
        add_meta_box( 'q-movie-title', __( 'Movie information', 'qTheme' ), 'q_cpt_display_callback', 'movies', 'normal', 'high' );

        // Metabox html and field
        function q_cpt_display_callback( $post ) {
            ?>
                <style>
                    .q-meta-field {
                        display: flex;
                        flex-direction: column;
                    }
                </style>

                <p class="q-meta-field">
                    <label for="q_movie_title">Movie Title</label>
                    <small>This title will be used on front-end</small>
                    <input id="q_movie_title"
                        type="text"
                        name="q_movie_title"
                        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'q_movie_title', true ) ); ?>">
                </p>

            <?php
        }
    }

    // Meta Box Save
    public function q_save_meta_box( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        
        if ( $parent_id = wp_is_post_revision( $post_id ) ) {
            $post_id = $parent_id;
        }

        $fields = [
            'q_movie_title',
        ];

        foreach ( $fields as $field ) {

            if ( array_key_exists( $field, $_POST ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
            }
        }
    }

}

new QCPT;