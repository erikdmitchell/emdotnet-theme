<?php get_header(); ?>

<div class="container-fluid red page-header">
	<div class="container">
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-md-12">
					<header class="entry-header">
						<?php
						if ( is_single() ) :
							the_title( '<h1 class="page-title">', '</h1>' );
						else :
							the_title( '<h1 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
						endif;
						?>
					</header><!-- .entry-header -->
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php koksijde_theme_post_thumbnail('project-single-thumb'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();
				get_template_part('content','portfolio');

				// Previous/next post navigation.
				koksijde_theme_post_nav();
			endwhile;
			?>
		</div>
		<div class="col-md-4">
			<?php echo get_portfolio_sidebar(get_the_ID()); ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>