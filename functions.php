<?php
/**
 * Tema NEA functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, tema_nea_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'tema_nea_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Tema_nea
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run tema_nea_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'tema_nea_setup' );

if ( ! function_exists( 'tema_nea_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tema_nea_setup() in a child theme, add your own tema_nea_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Tema NEA 1.0
 */
function tema_nea_setup() {

	register_sidebar( array(
			'name' => 'Redes Sociales',
			'id' => 'social_media',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="rounded">',
			'after_title' => '</h2>',
	) );
	
	add_filter('widget_text', 'do_shortcode');

	/* Make Tema NEA available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Tema NEA, use a find and replace
	 * to change 'tema_nea' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tema_nea', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'tema_nea' ) );

	// Add support for a variety of post formats
	//add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// Add Tema NEA's custom image sizes.
	// Used for large feature (header) images.
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'small-feature', 500, 300 );
	add_image_size( 'slider', 390, 350, true );
	add_image_size( 'portada_crop', 450, 250, true );
	add_image_size( 'gallery_thumb', 100, 100, true );
}
endif; // tema_nea_setup


/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function tema_nea_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'tema_nea_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function tema_nea_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tema_nea' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and tema_nea_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function tema_nea_auto_excerpt_more( $more ) {
	return ' &hellip;' . tema_nea_continue_reading_link();
}
add_filter( 'excerpt_more', 'tema_nea_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function tema_nea_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= tema_nea_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'tema_nea_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function tema_nea_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tema_nea_page_menu_args' );


if ( ! function_exists( 'tema_nea_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function tema_nea_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'tema_nea' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'tema_nea' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'tema_nea' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // tema_nea_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Tema NEA 1.0
 * @return string|bool URL or false when no link is present.
 */
function tema_nea_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function tema_nea_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'tema_nea_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tema_nea_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Tema NEA 1.0
 */
function tema_nea_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'tema_nea' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'tema_nea' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'tema_nea' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'tema_nea' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'tema_nea' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tema_nea' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'tema_nea' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for tema_nea_comment()

if ( ! function_exists( 'tema_nea_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own tema_nea_posted_on to override in a child theme
 *
 * @since Tema NEA 1.0
 */
function tema_nea_posted_on() {
	printf( __( '<span class="sep">Publicado el </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> por </span> <span class="author vcard">%5$s</span></span>', 'tema_nea' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('d/m/Y') ),

		get_the_author()
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Tema NEA 1.0
 */
function tema_nea_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'tema_nea_body_classes' );


function echo_first_image ($postID)
{					
	$args = array(
	'numberposts' => 1,
	'order'=> 'ASC',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => null,
	'post_type' => 'attachment'
	);
	
	$attachments = get_children( $args );
	
	//print_r($attachments);
	
	if ($attachments) {
		foreach($attachments as $attachment) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				
			echo '<img src="'.wp_get_attachment_thumb_url( $attachment->ID ).'" class="current">';
			
		}
	}
}

// get all of the images attached to the current post
function aldenta_get_images($size = 'slider') {
	global $post;
 
	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
 
	$results = array();
 
	if ($photos) {
		foreach ($photos as $photo) {
			// get the correct image html for the selected size
			$results[] = wp_get_attachment_image($photo->ID, $size);
		}
	}
 
	return $results;
}


function get_first_image($width=100,$height=100,$zoomcrop=1){
	$tn_src = get_first_content_image();
	if (!isset($tn_src)) //no image? try getting an attached image instead (native media galleries inserted into posts use attachments)
		$tn_src = get_first_attachment();

	if(isset($tn_src))
		$timthumb_url = get_bloginfo('template_url').'/scripts/timthumb.php?src='.$tn_src.'&h='.$height.'&w='.$width.'&zc='.$zoomcrop;
	else
		unset($timthumb_url);

	return $timthumb_url;
}

//[social]
function social_func( $atts ){
	extract( shortcode_atts( array(
		'facebook' => 'NO',
		'twitter' => 'NO',
		'youtube' => 'NO'
	), $atts ) );
	$html .= ($facebook=="NO")? '': '<a href="'.$facebook.'" class="socialicon"><img src="'.get_template_directory_uri().'/images/icon_fb.png"></a> ';
	$html .= ($twitter=="NO")? '': '<a href="'.$twitter.'" class="socialicon"><img src="'.get_template_directory_uri().'/images/icon_tw.png"></a> ';
	$html .= ($youtube=="NO")? '': '<a href="'.$youtube.'" class="socialicon"><img src="'.get_template_directory_uri().'/images/icon_yt.png"></a> ';
	return $html;
}
add_shortcode( 'social', 'social_func' );

// Custom Post Types
// Custom Post Type Proyecto
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'testimonio',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
      'labels' => array(
        'name' => __( 'Testimonios' ),
        'singular_name' => __( 'testimonio' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'patrocinador',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Patrocinadores' ),
        'singular_name' => __( 'patrocinador' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'patrocinador-slider',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Patrocinadores Slider' ),
        'singular_name' => __( 'patrocinador-slider' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'escuela',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Escuelas' ),
        'singular_name' => __( 'escuela' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2010',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2010' ),
        'singular_name' => __( 'galeria-2010' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2010',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2010' ),
        'singular_name' => __( 'galeria-2010' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2011',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2011' ),
        'singular_name' => __( 'galeria-2011' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2012',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2012' ),
        'singular_name' => __( 'galeria-2012' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2013',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2013' ),
        'singular_name' => __( 'galeria-2013' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2014',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2014' ),
        'singular_name' => __( 'galeria-2014' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

  register_post_type( 'galeria-2015',
    array(
      'taxonomies' => array('category'),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
      'labels' => array(
        'name' => __( 'Galeria 2015' ),
        'singular_name' => __( 'galeria-2015' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
