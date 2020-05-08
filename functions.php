<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */

/**
 * Set our global variables for theme options.
 *
 * @since emdotnet 1.0.0
 */
if ( ! isset( $emdotnet_theme_options ) ) {
    $emdotnet_theme_options = array( 'option_name' => 'emdotnet_theme_options' );
}

if ( ! isset( $emdotnet_theme_options_tabs ) ) {
    $emdotnet_theme_options_tabs = array();
}

if ( ! isset( $emdotnet_theme_options_hooks ) ) {
    $emdotnet_theme_options_hooks = array();
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since emdotnet 1.0.0
 */
if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since emdotnet 1.0.0
 */
function emdotnet_theme_setup() {
    /**
     * add our theme support options
     */
    $custom_header_args = array(
        'width' => 163,
        'height' => 76,
    );

    $custom_background_args = array(
        'deafult-color' => 'ffffff',
    );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header', $custom_header_args );
    add_theme_support( 'custom-background', $custom_background_args );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    /**
     * add our image size(s)
     */
    add_image_size( 'navbar-logo', 163, 100, true );
    add_image_size( 'slide-image', 1200, 500, true );
    add_image_size( 'project-home-thumb', 555, 555, true );
    add_image_size( 'project-single-thumb', 1140, 655, true );

    /**
     * include admin stuff
     */
    include_once( get_template_directory() . '/inc/admin/init.php' );

    /**
     * include theme meta page
     * allows users to hook and filter into the default meta tags in the header
     */
    include_once( get_template_directory() . '/inc/theme-meta.php' );

    /**
     * include theme options
     */
    include_once( get_template_directory() . '/theme-options.php' );

    // register our navigation area
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'emdotnet' ),
        )
    );

    /**
     * This theme styles the visual editor to resemble the theme style
     */
    add_editor_style( 'inc/css/editor-style.css' );

}
add_action( 'after_setup_theme', 'emdotnet_theme_setup' );

/**
 * Register widget area.
 *
 * @since emdotnet 1.0.0
 */
function emdotnet_theme_widgets_init() {

    register_sidebar(
        array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer 1',
            'id' => 'footer-1',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer 2',
            'id' => 'footer-2',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'emdotnet_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since emdotnet 1.0.0
 */
function emdotnet_theme_scripts() {
    global $wp_scripts;

    // enqueue our scripts for slider and theme
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-actual-script', get_template_directory_uri() . '/inc/js/jquery.actual.min.js', array( 'jquery' ), '1.0.16', true );
    wp_enqueue_script( 'emdotnet-theme-script', get_template_directory_uri() . '/js/emdotnet-theme.min.js', array( 'jquery' ), '1.2.0', true );

    if ( is_singular() ) :
        wp_enqueue_script( 'comment-reply' );
    endif;

    /**
     * Load our IE specific scripts for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
     */
    // HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries //
    wp_register_script( 'html5shiv-script', get_template_directory_uri() . '/inc/js/html5shiv.min.js', array(), '3.7.3-pre' );
    wp_register_script( 'respond-script', get_template_directory_uri() . '/inc/js/respond.min.js', array(), '1.4.2' );

    $wp_scripts->add_data( 'html5shiv-script', 'conditional', 'lt IE 9' );
    $wp_scripts->add_data( 'respond-script', 'conditional', 'lt IE 9' );

    // enqueue font awesome and our main stylesheet.
    wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), '5.13.0' );
    wp_enqueue_style( 'emdotnet-theme-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jquery-equalheights-min-script', get_stylesheet_directory_uri() . '/js/jquery.equalheights.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'edm-theme-script', get_stylesheet_directory_uri() . '/js/theme.js', array( 'jquery', 'jquery-equalheights-min-script' ), '1.0.0', false );

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    if ( is_front_page() ) {
        wp_enqueue_script( 'emdotnet-front-page-script', get_stylesheet_directory_uri() . '/js/front-page.min.js' );
    }
}
add_action( 'wp_enqueue_scripts', 'emdotnet_theme_scripts' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since emdotnet 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emdotnet_theme_post_thumbnail( $size = 'full' ) {
    global $post;

    $html = null;
    $attr = array(
        'class' => 'img-responsive',
    );

    if ( post_password_required() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        $html .= '<div class="post-thumbnail">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</div>';
    else :
        $html .= '<a class="post-thumbnail" href="' . get_permalink( $post->ID ) . '">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</a>';
    endif;

    $image = apply_filters( 'emdotnet_theme_post_thumbnail', $html, $size, $attr );

    echo $image;
}

/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since emdotnet 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emdotnet_theme_posted_on() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
        echo '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'emdotnet' ) . '</span>';
    }

    // Set up and print post meta information. -- hide date if sticky
    if ( ! is_sticky() ) :
        echo '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><a href="' . get_permalink() . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time></a></span>';
    endif;
    echo '<span class="byline"><span class="glyphicon glyphicon-user"></span><span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . get_the_author() . '</a></span></span>';
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since emdotnet 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emdotnet_theme_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), esc_url( $pagenum_link ) );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(
        array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => __( '&laquo; Previous', 'emdotnet' ),
            'next_text' => __( 'Next &raquo;', 'emdotnet' ),
        )
    );

    if ( $links ) :
        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <div class="pagination loop-pagination">
                <?php echo $links; ?>
            </div><!-- .pagination -->
        </nav><!-- .navigation -->
        <?php
    endif;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since emdotnet 1.0.1
 * @based on twentyfourteen
 *
 * @return void
 */
function emdotnet_theme_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    }

    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php
            if ( is_attachment() ) :
                previous_post_link( __( '<div class="published-in"><span class="meta-nav">Published In:</span> %link</div>', 'emdotnet' ), '%title' );
            else :
                previous_post_link( __( '<div class="prev-post"><span class="meta-nav">Previous Post:</span> %link</div>', 'emdotnet' ), '%title' );
                next_post_link( __( '<div class="next-post"><span class="meta-nav">Next Post:</span> %link</div>', 'emdotnet' ), '%title' );
            endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

/**
 * display_meta_description function.
 *
 * a custom function to display a meta description for our site pages
 *
 * @access public
 * @return void
 */
function display_meta_description() {
    global $post;

    $title = null;

    if ( isset( $post->post_title ) ) {
        $title = $post->post_title;
    }

    if ( is_single() ) {
        return single_post_title( '', false );
    } else {
        return $title . ' - ' . get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
    }

    return false;
}

/**
 * mdw_theme_navbar_brand function.
 *
 * adds our logo or text based on theme options
 *
 * @access public
 * @return void
 */
function emdotnet_theme_navbar_brand() {
    global $emdotnet_theme_options;

    $text = get_bloginfo( 'name' );

    if ( isset( $emdotnet_theme_options['default']['logo']['text'] ) && $emdotnet_theme_options['default']['logo']['text'] != '' ) {
        $text = $emdotnet_theme_options['default']['logo']['text'];
    }

    // display header image or text //
    if ( get_header_image() ) :
        echo '<img src="' . get_header_image() . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="" />';
    else :
        echo '<a class="navbar-brand" href="' . home_url() . '">' . $text . '</a>';
    endif;
}

/**
 * emdotnet_back_to_top function.
 *
 * @access public
 * @return void
 */
function emdotnet_back_to_top() {
    $html = null;

    $html .= '<a href="#0" class="emdotnet-back-to-top"></a>';

    echo $html;
}
add_action( 'wp_footer', 'emdotnet_back_to_top' );

/**
 * emdotnet_wp_parse_args function.
 *
 * Similar to wp_parse_args() just a bit extended to work with multidimensional arrays
 *
 * @access public
 * @param mixed &$a
 * @param mixed $b
 * @return void
 */
function emdotnet_wp_parse_args( &$a, $b ) {
    $a = (array) $a;
    $b = (array) $b;
    $result = $b;
    foreach ( $a as $k => &$v ) {
        if ( is_array( $v ) && isset( $result[ $k ] ) ) {
            $result[ $k ] = emdotnet_wp_parse_args( $v, $result[ $k ] );
        } else {
            $result[ $k ] = $v;
        }
    }
    return $result;
}

/***** PORTFOLIO *****/

/**
 * edm_customfilter_grid_classes function.
 *
 * @access public
 * @param mixed $classes
 * @return void
 */
function edm_customfilter_grid_classes( $classes ) {
    $classes .= 'edm-portfolio-grid';

    return $classes;
}
add_filter( 'customfilter_grid_classes', 'edm_customfilter_grid_classes' );

/**
 * filter_item_output function.
 *
 * @access public
 * @param mixed $default_output
 * @param mixed $post
 * @return void
 */
function filter_item_output( $default_output, $post ) {
    $html = null;

    if ( has_post_thumbnail( $post->ID ) ) :
        $thumb = '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'project-home-thumb' ) . '</a>';
    else :
        $thumb = '<a href="' . get_permalink( $post->ID ) . '"><img src="http://placehold.it/350x150" class="img-responsive"></a>';
    endif;

    $html .= '<div class="project" id="post-' . $post->ID . '">';
        $html .= $thumb;
        $html .= '<a href="' . get_permalink( $post->ID ) . '"><h3>' . get_the_title( $post->ID ) . '</h3></a>';
        $html .= get_post_excerpt_by_id( $post->ID, 45, '', '...' );
        $html .= '<p><a href="' . get_permalink() . '" class="btn btn-primary">Read More</a></p>';
    $html .= '</div>';

    return $html;
}
add_filter( 'customfilter_item_output', 'filter_item_output', 10, 2 );

/**
 * get_terms_list function.
 *
 * @access public
 * @param bool $term (default: false)
 * @return void
 */
function get_terms_list( $term = false ) {
    if ( ! $term ) {
        return false;
    }

    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    );
    $terms = get_terms( $term, $args );
    $html = null;

    if ( ! count( $terms ) ) {
        return false;
    }

    $html .= '<div class="term-wrapper term-' . $term . '">';
        $html .= '<h3 class="title">' . ucwords( $term ) . '</h3>';
        $html .= '<ul class="term-list term-list-' . $term . '">';
    foreach ( $terms as $t ) :
        if ( $t->count ) :
            $html .= '<li id="term-' . $t->term_id . '"><a href="/portfolio#' . $t->slug . '">' . $t->name . '</a></li>';
        else :
            $html .= '<li id="term-' . $t->term_id . '">' . $t->name . '</li>';
        endif;
            endforeach;
        $html .= '</ul>';
    $html .= '</div>';

    return $html;
}

/**
 * get_home_projects function.
 *
 * @access public
 * @param string $post_type (default: 'portfolio')
 * @param int    $limit (default: 6)
 * @return void
 */
function get_home_projects( $post_type = 'portfolio', $limit = 6 ) {
    $html = null;
    $args = array(
        'posts_per_page' => $limit,
        'orderby' => 'rand',
        'post_type' => $post_type,
    );
    $posts = get_posts( $args );

    if ( ! count( $posts ) ) {
        return false;
    }

    foreach ( $posts as $post ) :
        if ( has_post_thumbnail( $post->ID ) ) :
            $thumb = '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'project-home-thumb' ) . '</a>';
        else :
            $thumb = '<a href="' . get_permalink( $post->ID ) . '"><img src="http://placehold.it/555x555" class="img-responsive"></a>';
        endif;

        $html .= '<div class="project" id="post-' . $post->ID . '">';
            $html .= $thumb;
            $html .= '<a href="' . get_permalink( $post->ID ) . '"><div class="title"><h3>' . get_the_title( $post->ID ) . '</h3></div></a>';
        $html .= '</div>';
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
function get_page_content( $post_id = false, $title = false ) {
    if ( ! $post_id ) {
        return false;
    }

    $html = null;
    $post = get_post( $post_id );
    $thumb = '<i class="fa fa-user"></i>';

    if ( ! $title ) {
        $title = get_the_title( $post->ID );
    }

    $html .= '<div class="page-content-function">';
        $html .= '<div class="content">';
            $html .= '<h2 class="title">' . $title . '</h2>';
            $html .= apply_filters( 'the_content', $post->post_content );
        $html .= '</div>';
    $html .= '</div>';

    return $html;
}

/**
 * shortcode_page_content function.
 *
 * @access public
 * @param mixed $atts
 * @return void
 */
function shortcode_page_content( $atts ) {
    $atts = extract(
        shortcode_atts(
            array(
                'id' => false,
                'title' => false,
            ),
            $atts,
            'page-content'
        )
    );

    return get_page_content( $id, $title );
}
add_shortcode( 'page-content', 'shortcode_page_content' );

/**
 * Gets the excerpt of a specific post ID or object
 *
 * @param - $post - object/int - the ID or object of the post to get the excerpt of
 * @param - $length - int - the length of the excerpt in words
 * @param - $tags - string - the allowed HTML tags. These will not be stripped out
 * @param - $extra - string - text to append to the end of the excerpt
 */
function get_post_excerpt_by_id( $post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .' ) {

    if ( is_int( $post ) ) {
        // get the post object of the passed ID
        $post = get_post( $post );
    } elseif ( ! is_object( $post ) ) {
        return false;
    }

    if ( has_excerpt( $post->ID ) ) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters( 'the_content', $the_excerpt );
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes( strip_tags( $the_excerpt ), $tags );
    $the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
    $excerpt_waste = array_pop( $the_excerpt );
    $the_excerpt = implode( $the_excerpt );
    $the_excerpt .= $extra;

    return apply_filters( 'the_content', $the_excerpt );
}

/**
 * get_portfolio_sidebar function.
 *
 * @access public
 * @param bool              $post_id (default: false)
 * @param string            $taxonomies (default: array('skills')
 * @param mixed 'services')
 * @return void
 */
function get_portfolio_sidebar( $post_id = false, $taxonomies = array( 'skills', 'services' ) ) {
    if ( ! $post_id ) {
        return false;
    }

    $html = null;

    $html .= '<div class="project-details">';
        $html .= '<h3 class="project-details-title">Project Details</h3>';
        $html .= '<ul class="project-details-list">';
    if ( get_post_meta( $post_id, '_project_details_client', true ) ) {
        $html .= '<li class="client"><span class="header">Client:</span> ' . get_post_meta( $post_id, '_project_details_client', true ) . '</li>';
    }

    if ( get_post_meta( $post_id, '_project_details_date', true ) ) {
        $html .= '<li class="date"><span class="header">Completed:</span> ' . date( 'F Y', strtotime( get_post_meta( $post_id, '_project_details_date', true ) ) ) . '</li>';
    }

    if ( get_post_meta( $post_id, '_project_details_url', true ) ) {
        $html .= '<li class="url"><span class="header">URL:</span> <a href="' . get_post_meta( $post_id, '_project_details_url', true ) . '" target="_blank">' . get_post_meta( $post_id, '_project_details_url', true ) . '</a></li>';
    }

        $html .= '</ul>';

    foreach ( $taxonomies as $tax ) :
        $tax_details = get_taxonomy( $tax );
        $terms = get_the_terms( $post_id, $tax );

        if ( is_array( $terms ) ) :
            $html .= '<h5>' . $tax_details->labels->name . '</h5>';
            $html .= '<ul class="' . $tax . '">';
            foreach ( $terms as $term ) :
                $html .= '<li><a href="/projects#' . $term->slug . '">' . $term->name . '</a></li>';
                endforeach;
                $html .= '</ul>';
            endif;
        endforeach;

    $html .= '</div>';

    return $html;
}

/**
 * get_social_media function.
 *
 * @access public
 * @param string $title (default: 'Social Media')
 * @return void
 */
function get_social_media( $title = 'Social Media' ) {
    $html = null;
    $sm_options = get_option( 'social_media_options' );

    $html .= '<h3>' . $title . '</h3>';
    $html .= '<ul class="social-media">';
    foreach ( $sm_options as $sm_id => $sm ) :
        $html .= '<li id="sm-' . $sm_id . '">';
            $html .= '<a href="' . $sm['url'] . '"><i class="fa ' . $sm['icon'] . '"></i></a>';
        $html .= '</li>';
        endforeach;
    $html .= '</ul>';

    return $html;
}

/**
 * em_get_plugins function.
 *
 * @access public
 * @param array $args (default: array())
 * @return void
 */
function em_get_plugins( $args = array() ) {
    $html = null;
    $default_args = array(
        'posts_per_page' => -1,
        'post_type' => 'plugins',
    );
    $args = array_merge( $default_args, $args );
    $posts = get_posts( $args );

    if ( ! count( $posts ) ) {
        return false;
    }

    foreach ( $posts as $post ) :
        $html .= '<article id="plugin-' . $post->ID . '" class="plugin">';
            $html .= '<h3>' . get_the_title( $post->ID ) . '</h3>';
            $html .= get_the_post_thumbnail( $post->ID, 'thumbnail' );
            $html .= '<div class="description">';
                $html .= apply_filters( 'the_content', $post->post_content );
            $html .= '</div>';
        $html .= '</article><!-- .plugin -->';
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
function display_plugins( $args = array() ) {
    echo em_get_plugins( $args );
}

/**
 * em_check_for_mdw function.
 *
 * @access public
 * @param int $post_id (default: 0)
 * @return void
 */
function em_check_for_mdw( $post_id = 0 ) {
    $post_tags = wp_get_post_tags( $post_id, array( 'fields' => 'slugs' ) );

    if ( in_array( 'mdw', $post_tags ) ) {
        echo '<strong>This project was done while working at Miller Designworks</strong>';
    }
}
