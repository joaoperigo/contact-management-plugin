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
                'name' => __( 'All Contacts' ),
                'singular_name' => __( 'Contact' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'contacts'),
            'show_in_rest' => true,
            'supports' => ['title'],
        )
    );
}
add_action( 'init', 'create_post_type_contact' );

// add contact date field to contacts post type
function add_post_meta_boxes() {
    add_meta_box(
        "post_metadata_contacts_post", // div id containing rendered fields
        "Contact", // section heading displayed as text
        "post_meta_box_contacts_post", // callback function to render fields
        "contact", // name of post type on which to render fields
        "normal", // location on the screen
        "low" // placement priority
    );
}
add_action( "admin_init", "add_post_meta_boxes" );

// callback function to render fields
function post_meta_box_contacts_post(){
    global $post;
    $custom = get_post_custom( $post->ID );
    echo "hello";
}


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