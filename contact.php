<?php 
/*
Plugin Name: Contact Management Plugin
Description: Alfasoft test
Author: João Périgo
*/

//* Don't access this file directly
defined( 'ABSPATH' ) or die();    

/* Custom post type */
//Custom post type
function create_post_type_contact() {
    register_post_type( 'contact',

        array(

            'labels' => array(

                'name' => __( 'Contact' ),

                'singular_name' => __( 'Contact' )

            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'contacts'),
            'show_in_rest' => true,
            'supports' => ['title', 'thumbnail', 'custom-fields'],

        )
    );
}

add_action( 'init', 'create_post_type_contact' );

/* Assign custom template to contact post type*/
function load_contact_template( $template ) {
    global $post;
    if ( 'contact' === $post->post_type && locate_template( array( 'single-contact.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'single-contact.php';
    }
    return $template;
}
add_filter( 'single_template', 'load_contact_template' );
?>