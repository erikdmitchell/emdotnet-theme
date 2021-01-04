<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <header class="archive-header">
        <h1 class="archive-title"><?php echo single_cat_title( '', false ); ?></h1>
    </header><!-- .archive-header -->

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <?php get_template_part( 'template-parts/content' ); ?>
    <?php endwhile; ?>

    <?php emdotnet_theme_paging_nav(); // Previous/next post navigation. ?>

<?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php
get_footer();
