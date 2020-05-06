<?php
/**
 * Template Name: Front Page
**/
?>
<?php get_header(); ?>

	<?php //get_template_part('content','slider'); ?>

	<div class="container-full banner">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cobbles.jpg" />
	</div>

	<div class="container-fluid tools-i-use">
		<div class="container">
			<div class="col-md-4 tools-block">
				<div class="icon"><i class="fa fa-wordpress"></i></div>
				<h2 class="title">WordPress</h2>
				<p>Currently powering 25% of the web, WordPress is web software that can be used to create beautiful and powerful websites, apps and virtually anything you can imagine.</p>
			</div>
			<div class="col-md-4 tools-block">
				<div class="icon"><i class="fa fa-code"></i></div>
				<h2 class="title">Development</h2>
				<p>The three core "languages" I use for development are PHP, JavaScript and CSS. I leverage these languages to create powerful experiences that are easy to manage and grow.</p>
			</div>
			<div class="col-md-4 tools-block">
				<div class="icon"><i class="fa fa-picture-o"></i></div>
				<h2 class="title">Design/UX</h2>
				<p> I utilize tools such as react, jQuery, node and Sass to maximize performance and create beautiful websites/applications that also deliver a powerful user experience.</p>
			</div>
		</div>
	</div>

	<div class="container-fluid home-feature">
		<div class="container projects">
			<?php echo get_home_projects('projects'); ?>
		</div><!-- .container -->
	</div>

	<div class="container-fluid home-about">
		<div class="container">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>

<?php get_footer();