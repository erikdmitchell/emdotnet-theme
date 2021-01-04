<?php
/**
 * The template for displaying the blog page
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

?>

<?php get_header(); ?>
    <div class="blog-posts">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <?php get_template_part( 'template-parts/content', 'home' ); ?>
        <?php endwhile; ?>
    </div>
    <?php emdotnet_theme_paging_nav(); // Previous/next post navigation. ?>

<?php
get_footer();
