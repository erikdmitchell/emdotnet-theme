<?php
/**
 * Single pages/posts
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

?>

<?php get_header(); ?>

    <?php
        // Start the Loop.
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'single' );

        // Previous/next post navigation.
        emdotnet_theme_post_nav();

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        endwhile;
    ?>

<?php
get_footer();
