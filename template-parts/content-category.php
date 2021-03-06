<?php
/**
 * The template for displaying blog category posts
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php emdotnet_theme_post_thumbnail( 'home-blog-feature-image' ); ?>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

        <div class="entry-meta">
            <?php
            emdotnet_theme_posted_on();

            edit_post_link( __( 'Edit', 'emdotnet' ), '<span class="edit-link">', '</span>' );
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            $link = '...<a href="' . get_permalink( get_the_ID() ) . '">read more</a>';
            emdotnet_excerpt( get_the_ID(), 25, '<a><em><strong>', $link );
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'emdotnet' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )
            );
            ?>
    </div><!-- .entry-content -->
                        
</article><!-- #post-## -->
