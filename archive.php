<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

?>

<?php get_header(); ?>

    <header class="archive-header">
        <h1 class="archive-title page-title">
            <?php
            if ( is_day() ) :
                printf( __( 'Daily Archives: %s', 'emdotnet' ), get_the_date() );
                elseif ( is_month() ) :
                    printf( __( 'Monthly Archives: %s', 'emdotnet' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'emdotnet' ) ) );
                elseif ( is_year() ) :
                    printf( __( 'Yearly Archives: %s', 'emdotnet' ), get_the_date( _x( 'Y', 'yearly archives date format', 'emdotnet' ) ) );
                else :
                    _e( 'Archives', 'emdotnet' );
                endif;
                ?>
        </h1>
    </header>


        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <?php get_template_part( 'template-parts/content' ); ?>
            <?php endwhile; ?>

            <?php // emdotnet_theme_paging_nav(); // Previous/next post navigation. ?>
            <?php // emdotnet_theme_post_nav(); ?>

    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
            

<?php
get_footer();
