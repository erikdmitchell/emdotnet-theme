<?php
/**
 * Template Name: Portfolio
 */
?>
<?php get_header(); ?>

<div class="page-header">
    <div class="em-container">
        <div class="em-row">
            <div class="em-col">
                <h1 class="page-title">Portfolio</h1>
            </div>
        </div>
    </div>
</div>

<div class="em-container">
    <div class="em-row">
        <div class="emdotnet-portfolio-wrapper">
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
</div>

<?php get_footer(); ?>
