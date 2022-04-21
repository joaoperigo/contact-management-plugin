<?php get_header(); ?>
    <div class="contact-container">
        <h1><?php the_title() ?></h1>
        <p><strong>Email: </strong><?php echo get_post_meta( get_the_ID(), '_contact_email', true ); ?></p>
        <p><strong>Country: </strong><?php echo get_post_meta( get_the_ID(), '_contact_country', true ); ?></p>
        <p><strong>Number: </strong><?php echo get_post_meta( get_the_ID(), '_contact_number', true ); ?></p>
    </div>
<?php get_footer(); ?>