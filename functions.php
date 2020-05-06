<?php
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('slide-image',1200,500,true);
	add_image_size('project-home-thumb',555,555,true);
	add_image_size('project-single-thumb',1140,655,true);
}

/**
 * edm_scripts_styles function.
 *
 * @access public
 * @return void
 */
function edm_scripts_styles() {
	wp_enqueue_script('jquery-equalheights-min-script',get_stylesheet_directory_uri().'/js/jquery.equalheights.min.js',array('jquery'));
	wp_enqueue_script('edm-theme-script',get_stylesheet_directory_uri().'/js/theme.js',array('jquery','jquery-equalheights-min-script'),'1.0.0',false);

	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');

	//wp_enqueue_style('font-awesome-style','//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',array(),'4.3.0');

	if (is_front_page())
		wp_enqueue_script('edm-theme-front-page-script',get_stylesheet_directory_uri().'/js/front-page.js');

}
add_action('wp_enqueue_scripts','edm_scripts_styles');

/**
 * edm_customfilter_grid_classes function.
 *
 * @access public
 * @param mixed $classes
 * @return void
 */
function edm_customfilter_grid_classes($classes) {
	$classes.='edm-portfolio-grid';

	return $classes;
}
add_filter('customfilter_grid_classes','edm_customfilter_grid_classes');

/**
 * filter_item_output function.
 *
 * @access public
 * @param mixed $default_output
 * @param mixed $post
 * @return void
 */
function filter_item_output($default_output,$post) {
	$html=null;

	if (has_post_thumbnail($post->ID)) :
		$thumb='<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID,'project-home-thumb').'</a>';
	else:
		$thumb='<a href="'.get_permalink($post->ID).'"><img src="http://placehold.it/350x150" class="img-responsive"></a>';
	endif;

	$html.='<div class="project" id="post-'.$post->ID.'">';
		$html.=$thumb;
		$html.='<a href="'.get_permalink($post->ID).'"><h3>'.get_the_title($post->ID).'</h3></a>';
		$html.=get_post_excerpt_by_id($post->ID,45,'','...');
		$html.='<p><a href="'.get_permalink().'" class="btn btn-primary">Read More</a></p>';
	$html.='</div>';

	return $html;
}
add_filter('customfilter_item_output','filter_item_output',10,2);

/**
 * get_terms_list function.
 *
 * @access public
 * @param bool $term (default: false)
 * @return void
 */
function get_terms_list($term=false) {
	if (!$term)
		return false;

	$args=array(
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => false
	);
	$terms=get_terms($term,$args);
	$html=null;

	if (!count($terms))
		return false;

	$html.='<div class="term-wrapper term-'.$term.'">';
		$html.='<h3 class="title">'.ucwords($term).'</h3>';
		$html.='<ul class="term-list term-list-'.$term.'">';
			foreach ($terms as $t) :
				if ($t->count) :
					$html.='<li id="term-'.$t->term_id.'"><a href="/portfolio#'.$t->slug.'">'.$t->name.'</a></li>';
				else :
					$html.='<li id="term-'.$t->term_id.'">'.$t->name.'</li>';
				endif;
			endforeach;
		$html.='</ul>';
	$html.='</div>';

	return $html;
}

/**
 * get_home_projects function.
 *
 * @access public
 * @param string $post_type (default: 'portfolio')
 * @param int $limit (default: 6)
 * @return void
 */
function get_home_projects($post_type='portfolio',$limit=6) {
	$html=null;
	$args=array(
		'posts_per_page' => $limit,
		'orderby' => 'rand',
		'post_type' => $post_type
	);
	$posts=get_posts($args);

	if (!count($posts))
		return false;

	foreach ($posts as $post) :
		if (has_post_thumbnail($post->ID)) :
			$thumb='<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID,'project-home-thumb').'</a>';
		else:
			$thumb='<a href="'.get_permalink($post->ID).'"><img src="http://placehold.it/555x555" class="img-responsive"></a>';
		endif;

		$html.='<div class="col-md-4 project-wrap">';
			$html.='<div class="project" id="post-'.$post->ID.'">';
				$html.=$thumb;
				$html.='<a href="'.get_permalink($post->ID).'"><div class="title"><h3>'.get_the_title($post->ID).'</h3></div></a>';
				//$html.=get_post_excerpt_by_id($post->ID,45,'','...');
				//$html.='<p><a href="'.get_permalink($post->ID).'" class="btn btn-primary">Read More</a></p>';
			$html.='</div>';
		$html.='</div><!-- .col-md-4 -->';
	endforeach;

	return $html;
}

/**
 * get_page_content function.
 *
 * @access public
 * @param bool $post_id (default: false)
 * @param bool $title (default: false)
 * @return void
 */
function get_page_content($post_id=false,$title=false) {
	if (!$post_id)
		return false;

	$html=null;
	$post=get_post($post_id);
	$thumb='<i class="fa fa-user"></i>';

	if (!$title)
		$title=get_the_title($post->ID);

	if (has_post_thumbnail($post->ID))
		$thumb=get_the_post_thumbnail($post->ID);


	$html.='<div class="page-content-function">';
		$html.='<div class="content">';
			$html.='<h2 class="title">'.$title.'</h2>';
			$html.='<div class="image">'.$thumb.'</div>';
			$html.=apply_filters('the_content', $post->post_content);
		$html.='</div>';
	$html.='</div>';

	return $html;
}

/**
 * shortcode_page_content function.
 *
 * @access public
 * @param mixed $atts
 * @return void
 */
function shortcode_page_content($atts) {
	$atts=extract(shortcode_atts( array(
		'id' => false,
		'title' => false
	), $atts, 'page-content'));

	return get_page_content($id,$title);
}
add_shortcode('page-content','shortcode_page_content');

/**
 * Gets the excerpt of a specific post ID or object
 * @param - $post - object/int - the ID or object of the post to get the excerpt of
 * @param - $length - int - the length of the excerpt in words
 * @param - $tags - string - the allowed HTML tags. These will not be stripped out
 * @param - $extra - string - text to append to the end of the excerpt
 */
function get_post_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {

	if(is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}

	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}

	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
	$the_excerpt .= $extra;

	return apply_filters('the_content', $the_excerpt);
}

/**
 * get_portfolio_sidebar function.
 *
 * @access public
 * @param bool $post_id (default: false)
 * @param string $taxonomies (default: array('skills')
 * @param mixed 'services')
 * @return void
 */
function get_portfolio_sidebar($post_id=false,$taxonomies=array('skills','services')) {
	if (!$post_id)
		return false;

	$html=null;

	$html.='<div class="project-details">';
		$html.='<h3 class="project-details-title">Project Details</h3>';
		$html.='<ul class="project-details-list">';
			if (get_post_meta($post_id,'_project_details_client',true))
				$html.='<li class="client"><span class="header">Client:</span> '.get_post_meta($post_id,'_project_details_client',true).'</li>';

			if (get_post_meta($post_id,'_project_details_date',true))
				$html.='<li class="date"><span class="header">Completed:</span> '.date('F Y',strtotime(get_post_meta($post_id,'_project_details_date',true))).'</li>';

			if (get_post_meta($post_id,'_project_details_url',true))
				$html.='<li class="url"><span class="header">URL:</span> <a href="'.get_post_meta($post_id,'_project_details_url',true).'" target="_blank">'.get_post_meta($post_id,'_project_details_url',true).'</a></li>';

		$html.='</ul>';

		foreach ($taxonomies as $tax) :
			$tax_details=get_taxonomy($tax);
			$terms=get_the_terms($post_id,$tax);

			if (is_array($terms)) :
				$html.='<h5>'.$tax_details->labels->name.'</h5>';
				$html.='<ul class="'.$tax.'">';
					foreach ($terms as $term) :
						$html.='<li><a href="/projects#'.$term->slug.'">'.$term->name.'</a></li>';
					endforeach;
				$html.='</ul>';
			endif;
		endforeach;

	$html.='</div>';

	return $html;
}

/**
 * get_social_media function.
 *
 * @access public
 * @param string $title (default: 'Social Media')
 * @return void
 */
function get_social_media($title='Social Media') {
	$html=null;
	$sm_options=get_option('social_media_options');

	$html.='<h3>'.$title.'</h3>';
	$html.='<ul class="social-media">';
		foreach ($sm_options as $sm_id => $sm) :
			$html.='<li id="sm-'.$sm_id.'">';
				$html.='<a href="'.$sm['url'].'"><i class="fa '.$sm['icon'].'"></i></a>';
			$html.='</li>';
		endforeach;
	$html.='</ul>';

	return $html;
}

/**
 * em_get_plugins function.
 *
 * @access public
 * @param array $args (default: array())
 * @return void
 */
function em_get_plugins($args=array()) {
	$html=null;
	$default_args=array(
		'posts_per_page' => -1,
		'post_type' => 'plugins'
	);
	$args=array_merge($default_args,$args);
	$posts=get_posts($args);

	if (!count($posts))
		return false;

	foreach ($posts as $post) :
		$html.='<article id="plugin-'.$post->ID.'" class="plugin">';
			$html.='<h3>'.get_the_title($post->ID).'</h3>';
			$html.=get_the_post_thumbnail($post->ID,'thumbnail');
			$html.='<div class="description">';
				$html.=apply_filters('the_content',$post->post_content);
			$html.='</div>';
		$html.='</article><!-- .plugin -->';
	endforeach;

	return $html;
}

/**
 * display_plugins function.
 *
 * @access public
 * @param array $args (default: array())
 * @return void
 */
function display_plugins($args=array()) {
	echo em_get_plugins($args);
}

/**
 * em_check_for_mdw function.
 *
 * @access public
 * @param int $post_id (default: 0)
 * @return void
 */
function em_check_for_mdw($post_id=0) {
	$post_tags=wp_get_post_tags($post_id, array('fields' => 'slugs'));

	if (in_array('mdw', $post_tags))
		echo '<strong>This project was done while working at Miller Designworks</strong>';
}
?>