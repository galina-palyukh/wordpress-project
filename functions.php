<?php 
// add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 )

add_action( 'wp_enqueue_scripts', 'style_theme', 3 );
add_action('wp_footer' , 'scripts_theme', 5);
add_action('wp_enqueue_scripts', 'my_update_jquery');
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

add_action( 'widgets_init', 'register_my_widgets' );



function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'Right Sidebar',
		'id'            => "right-sidebar",
		'description'   => 'Описание нашего сайдбара',
		'class'         => '',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n"
	) );

	register_sidebar( array(
		'name'          => 'Top Sidebar',
		'id'            => "top-sidebar",
		'description'   => 'Описание нашего сайдбара',
		'class'         => '',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n"
	) );
}


function theme_register_nav_menu() {
	register_nav_menu( 'top', 'Top Menu' );
	
	register_nav_menu( 'bottom', 'Bottom Menu' );

	register_nav_menu( 'footer', 'Footer Menu' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails', array( 'post' )); 

	add_image_size( 'post_thumb', 1300, 600, true );

	add_filter( 'excerpt_more', 'new_excerpt_more' );
	function new_excerpt_more( $more ){
		global $post;
		return '<a href="'. get_permalink($post) . '">Читать дальше...</a>';
	}
}

function style_theme() {

	wp_enqueue_style( 'style', get_stylesheet_uri());
	wp_enqueue_style( 'default  ', get_template_directory_uri() . '/assets/css/default.css');
	wp_enqueue_style( 'layout ', get_template_directory_uri() . '/assets/css/layout.css');
	wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/assets/css/media-queries.css');
}

function scripts_theme() {
	wp_deregister_script('jquery');
	wp_enqueue_script('init', get_template_directory_uri() . '/assets/js/init.js');
	wp_enqueue_script('doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js');
	wp_enqueue_script('jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js');
	wp_enqueue_script('jquery-migrate', get_template_directory_uri() . '/assets/js/jquery-migrate-1.2.1.min.js') ;
}
function my_update_jquery () {
	if ( !is_admin() ) { 
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, false, true);
		wp_enqueue_script('jquery');
	}
}

?>

