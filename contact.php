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
        "Contact info", // section heading displayed as text
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
    // create user
    // writte here email
    // input for email value
    // country
    wp_nonce_field( 'contact_country_nonce', 'contact_country_nonce' );
    $valueCountry = get_post_meta( $post->ID, '_contact_country', true );
    echo '<label style="width:100%" for="contact_country">Contact country</label>';
    echo '<input style="width:100%" id="contact_country" name="contact_country" placeholder="' . esc_attr( $valueCountry ) . '">';
    // number
    wp_nonce_field( 'contact_number_nonce', 'contact_number_nonce' );
    $valueNumber = get_post_meta( $post->ID, '_contact_number', true );
    echo '<label style="width:100%" for="contact_number">Contact number</label>';
    echo '<input style="width:100%" id="contact_number" name="contact_number" placeholder="' . esc_attr( $valueNumber ) . '">';
}

// save
function save_global_notice_meta_box_data( $post_id ) {
    // Insert validation conditions here
    // code
    // Check if email already exists here
    // Sanitize user input here
    $contact_country = sanitize_text_field( $_POST['contact_country'] );
    $contact_number = sanitize_text_field( $_POST['contact_number'] );
    // Update the meta field in the database.
    update_post_meta( $post_id, '_contact_country', $contact_country );
    update_post_meta( $post_id, '_contact_number', $contact_number );
}
add_action( 'save_post', 'save_global_notice_meta_box_data' );


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