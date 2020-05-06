<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.1.0
 */
?>
<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h1 class="page-title"><?php _e( 'Not Found', 'emdotnet' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<h2><?php _e( "This is somewhat embarrassing, isn't it?", 'emdotnet' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'emdotnet' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->
		</div>
	</div>
</div>

<?php get_footer(); ?>