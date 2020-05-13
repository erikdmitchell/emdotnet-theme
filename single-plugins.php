<?php get_header(); ?>

<div class="page-header">
    <div class="em-container">
        <div class="em-row">
            <div class="em-col">
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            </div>
        </div>
    </div>
</div>

<div class="em-container">
    <div class="em-row project-thumb-wrap">
        <div class="em-col">
            <?php emdotnet_theme_post_thumbnail( 'project-single-thumb' ); ?>
        </div>
    </div>
    
    <div class="em-row">
        <div class="em-col">
            <?php
            // Start the Loop.
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content', 'plugins' );

                // Previous/next post navigation.
                emdotnet_theme_post_nav();
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php
get_footer();

