<?php
/**
 * The template for displaying content on portfolio pages
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'mdw-wp-theme' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mdw-wp-theme' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php //the_tags( '<div class="entry-meta"><span class="tag-links">', '', '</span></div>' ); ?>
	<?php em_check_for_mdw(get_the_ID()); ?>
</article><!-- #post-## -->
