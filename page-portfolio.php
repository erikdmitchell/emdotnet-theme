<?php
/**
 * Template Name: Portfolio
 */
?>
<?php get_header(); ?>

<div class="container-fluid page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">Portfolio</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ( class_exists( 'CustomFilter' ) ) :
                $config = array(
                    'post_type' => 'projects',
                    'filter_tax' => array( 'skills', 'services' ),
                    'cols' => '3cols',
                );
                $custom_filter = new CustomFilter( $config );
                echo $custom_filter->generate_filter();
                echo $custom_filter->generate_content();
            endif;
            ?>
        </div>
    </div>
</div><!-- .container -->

<?php get_footer(); ?>
