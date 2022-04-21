<?php get_header(); ?>
    <h1>List contact public view</h1>
    <p><?php echo get_post_meta( get_the_ID(), '_contact_country', true ); ?></p>
    <p><?php echo get_post_meta( get_the_ID(), '_contact_number', true ); ?></p>
<?php get_footer(); ?>