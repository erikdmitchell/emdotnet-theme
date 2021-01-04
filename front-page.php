<?php
/**
 * Template Name: Front Page
 **/

?>

<?php get_header(); ?>

    <div class="banner">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cobbles.jpg" />
    </div>

    <div class="home-about">
        
            
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <?php the_content( 'template-parts/content', 'front-page' ); ?>
                    <?php
            endwhile;
endif;
            ?>
                       

    </div>

<?php
get_footer();
