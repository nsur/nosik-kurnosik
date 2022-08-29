<?php
//Includes
include_once 'includes/dogs.php';
include_once 'includes/dogs_func.php';
include_once 'includes/pll_register_strings.php';
include_once 'includes/post_taxonomies.php';

// Hooks
add_action( 'after_setup_theme', 'theme_after_setup' );
add_action( 'admin_head', 'admin_custom_css' );
add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );
add_filter( "theme_mod_single_author_block", 'update_single_author_block' );
add_filter( 'globaly_get_dynamic_css_options', 'get_dynamic_css_options' );
add_filter( 'globaly_breadcrumbs_settings', 'update_breadcrumbs_settings' );
add_filter( 'cherry_breadcrumbs_trail_taxonomies', 'update_breadcrumbs_trail_taxonomies' );
add_filter( 'cherry_breadcrumbs_items', 'update_cherry_breadcrumbs_items', 10, 2 );
add_action( 'wp_enqueue_scripts', 'recaptcha_enqueue_scripts', 10, 99 );
add_filter( 'gettext', 'search_for_pll_translations', 10, 3 );

add_filter( 'term_description', 'wpautop' );
add_filter( 'term_description', 'do_shortcode' );

add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );

function recaptcha_enqueue_scripts() {
	if ( function_exists( 'pll__' ) ) {
		wp_localize_script( 'google-recaptcha', 'wpcf7iqfix', array(
			'recaptcha_empty' => pll__( 'Please verify that you are not a robot', 'globaly' ),
		) );
	}
}

function search_for_pll_translations( $translation, $text, $domain ) {
	if ( function_exists( 'pll__' ) && $domain !== 'pll_string' ) {
		$translation = pll__( $translation );
	}

	return $translation;
}


// Shortcodes
add_shortcode( 'languages-switcher', 'get_language_switcher' );

// Functions
function theme_after_setup() {
	load_theme_textdomain( 'globaly_child', get_stylesheet_directory() . '/languages' );
}

function admin_custom_css() {
  echo '<style>
    .fixed .column-categories,
    .fixed .column-rel,
    .fixed .column-response,
    .fixed .column-role,
    .fixed .column-tags {
      width: auto;
    }
  </style>';
}

function enqueue_theme_scripts() {
	// Connect styles of parent theme
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	// Fix header response
	wp_enqueue_style( 'header-fix', get_stylesheet_directory_uri() . '/assets/css/custom/header-fix.css' );
	// jQuert Colorbox
	wp_enqueue_style( 'lightgallery', get_stylesheet_directory_uri() . '/js/lightgallery/css/lightgallery.min.css' );
	wp_enqueue_script( 'lightgallery', get_stylesheet_directory_uri() . '/js/lightgallery/js/lightgallery-all.min.js', array( 'jquery' ) );
	// Main theme js file
	wp_enqueue_script( 'all-js', get_stylesheet_directory_uri() . '/js/theme.js', array( 'jquery' ) );
}

function get_dynamic_css_options( $data ) {
	if ( ! empty( $data['css_files'] ) ) {
		foreach ( $data['css_files'] as &$file ) {
			$child_file = get_stylesheet_directory() . '/assets/css/' . basename( $file );
			if ( ! file_exists( $child_file ) ) {
				$child_file = get_stylesheet_directory() . '/assets/css/dynamic/site/' . basename( $file );
			}
			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			}
		}
	}

	return $data;
}

function update_breadcrumbs_settings( $args ) {
	if ( function_exists( 'pll__' ) ) {
		$args['labels']['home']      = pll__( 'Home', 'globaly' );
		$args['labels']['error_404'] = pll__( '404 Not Found', 'globaly' );
	}

	return $args;
}

function update_breadcrumbs_trail_taxonomies( $taxonomies ) {
	if ( is_single() ) {
		$post_type = get_post_type();

		if ( $post_type == 'post' ) {
			foreach ( PostTaxonomies::TAXONOMIES as $tax ) {
				if ( has_term( '', $tax ) ) {
					$taxonomies['post'] = $tax;
					break;
				}
			}
		} else if ( in_array( $post_type, Dogs::POST_TYPES ) ) {
			$taxonomies[ $post_type ] = Dogs::DOG_TAXONOMIES[ $post_type ];
		}
	}

	return $taxonomies;
}

function update_cherry_breadcrumbs_items( $items, $args ) {
	$post_type = '';
	if ( is_archive() ) {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = isset( $taxonomy->object_type[0] ) ? $taxonomy->object_type[0] : $post_type;
	} else if ( is_single() ) {
		global $post;
		$post_type = $post->post_type;
	}
	if ( $post_type && 'post' != $post_type ) {
		array_splice( $items, 1, 1 );
	}

	return $items;
}

function get_language_switcher( $atts ) {
	if ( function_exists( 'pll_the_languages' ) ) {
		pll_the_languages( $atts );
	}
}

function update_single_author_block( $author_block ) {
	$author_block = false;

	return $author_block;
}

function get_template_part_with_data( $slug, array $data = array() ) {
	$slug = '/' . $slug . '.php';
	extract( $data );

	require get_stylesheet_directory() . $slug;
}

function add_dashboard_widgets() {
	global $wp_meta_boxes;

	wp_add_dashboard_widget( 'custom_help_widget', 'Подсказки по работе с сайтом', 'custom_dashboard_helper' );
}

function custom_dashboard_helper() {
	$post = get_post( 1976 );

	if( !empty( $post->post_content ) ) {
		echo $post->post_content;
	}
}
