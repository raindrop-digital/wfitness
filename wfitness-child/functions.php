<?php
/**
 * W Fitness Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package W Fitness Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_W_FITNESS_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	// CSS
	wp_enqueue_style( 'w-fitness-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_W_FITNESS_CHILD_VERSION, 'all' );
    wp_enqueue_style( 'bootstrap-theme', get_stylesheet_directory_uri() . '/assets/css/bootstrap-style.css', array(), 'all');
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css', array(),'all' );
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(),'all' );	

	// JS
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.min.js',array('jquery'),'1.8.0',true);

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/**
 * Add revisions support to the Custom Layout.
 *
 * @param array $defaults Default values to the `support` param.
 *
 * @return array
 */
function astra_add_revision_cl( $defaults ) {
	$defaults[] = 'revisions';
	return $defaults;
}
add_filter( 'astra_advanced_hooks_supports', 'astra_add_revision_cl' );

/**
 * Disable Featured image on all post types.
 */
function your_prefix_featured_image() {
	$post_types = array('page');
   
	// bail early if the current post type if not the one we want to customize.
	if ( ! in_array( get_post_type(), $post_types ) ) {
	return;
	}
	
	// Disable featured image.
	add_filter( 'astra_featured_image_enabled', '__return_false' );
   }
   
   add_action( 'wp', 'your_prefix_featured_image' );

   /* Disable title on all post types. */ 
  function your_prefix_post_title() { 
	$post_types = array('page'); 
	// bail early if the current post type if not the one we want to customize. 
if ( ! in_array( get_post_type(), $post_types ) ) { return; } // Disable Post featured image. 
add_filter( 'astra_the_title_enabled', '__return_false' ); 
}
add_action( 'wp', 'your_prefix_post_title' );

/**
 * Display only last modified date in the post metadata.
 *
 * @param String $output Markup for the last modified date.
 * @return void
 */
function your_prefix_post_date( $output ) {
	$output        = '';
	$format        = apply_filters( 'astra_post_date_format', '' );
	$modified_date = esc_html( get_the_modified_date( $format ) );
	$modified_on   = sprintf(
		esc_html( '%s' ),
		$modified_date
	);
	$output       .= '';
	$output       .= ' ' . $modified_on . '';
	$output       .= '';
	return $output;
}
add_filter( 'astra_post_date', 'your_prefix_post_date' );

/* Add Google Tag Manager javascript code as close to 
the opening <head> tag as possible
=====================================================*/
function add_gtm_head(){
	?>
	 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KHL3C99');</script>
<!-- End Google Tag Manager -->
	 
	<?php 
	}
	add_action( 'wp_head', 'add_gtm_head', 10 );
	 
	/* Add Google Tag Manager noscript codeimmediately after 
	the opening <body> tag
	========================================================*/
	function add_gtm_body(){
	?>
	 
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHL3C99"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	 
	<?php 
	}
	add_action( 'body_top', 'add_gtm_body' );

// Setup cron job for amelia notifications
function amelia_send_notification() {
	echo file_get_contents('https://www.wfitness.co.uk/wp-admin/admin-ajax.php?action=wpamelia_api&call=/notifications/scheduled/send');
}	

// Custom Gutenberg Blocks

// Register a slider block.
function custom_blocks() {

    // check function exists.
    if( function_exists('acf_register_block_type') ) {

		// Register a Testimonial Carousel block.
        acf_register_block_type(array(
            'name'              => 'testimonial-carousel',
            'title'             => __('Testimonial Carousel'),
            'description'       => __('A testimonial carousel block.'),
            'render_template'   => 'template-parts/blocks/testimonial/testimonial-block.php',
			'category'          => 'formatting',
			'icon' 				=> 'images-alt2',
			'supports'			=> array(
				'align'		=> false,
			),
			'enqueue_assets' 	=> function(){
				wp_enqueue_style('testimonial-block-css', get_stylesheet_directory_uri() . '/template-parts/blocks/testimonial/testimonial-block.css', array(), '1.0.0' );
				wp_enqueue_script('testimonial-block-controls-js', get_stylesheet_directory_uri() . '/template-parts/blocks/testimonial/testimonial-block-controls.js', array('slick-js', 'jquery'),'NULL',true);
			  },
        ));
    }
}

add_action('acf/init', 'custom_blocks');