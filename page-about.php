<?php
/**
 * Template Name: About
 */
?>
<?php get_header(); ?>

<div class="container-fluid page-header">
    <div class="container">
        <div class="row">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                <div class="col-md-12">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </div>
                    <?php
            endwhile;
endif;
            ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <?php the_content(); ?>
                    <?php
            endwhile;
endif;
            ?>
        </div>
        <div class="col-md-4 sidebar">
            <?php
            if ( function_exists( 'get_terms_list' ) ) {
                echo get_terms_list( 'skills' );}
            ?>
            <?php
            if ( function_exists( 'get_terms_list' ) ) {
                echo get_terms_list( 'services' );}
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
