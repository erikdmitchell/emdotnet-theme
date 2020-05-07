<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

  <head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

		<div class="container-fluid primary-nav">
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".emdotnet-mobile-menu">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php emdotnet_theme_navbar_brand(); ?>
					</div>
					<div class="collapse navbar-collapse primary-menu">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container' => false,
							'menu_class' => 'nav navbar-nav pull-right',
							//'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
							//'walker' => new wp_bootstrap_navwalker()
						));
						?>
					</div> <!-- .primary-menu -->
				</nav>
			</div><!-- .container -->
		</div><!-- .navigation -->
