<?php

class PostTaxonomies {
	const POST_TYPE = 'post';
	const TAXONOMIES = array( 'news', 'articles', );

	public static function init() {
		add_action( 'init', array( self::class, 'registerCustomTaxonomies' ) );
	}

	public static function registerCustomTaxonomies() {
		foreach( self::TAXONOMIES as $taxonomy ) {
			register_taxonomy( $taxonomy, self::POST_TYPE, array(
				'hierarchical' => true,
				'labels' => self::getLabels( $taxonomy ),
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
			) );
		}
	}

	public static function getLabels( $item ) {
		$labels = array(
			'articles' => array(
				'name' => __( 'Articles', 'globaly_child' ),
				'singular_name' => __( 'Article', 'globaly_child' ),
				'search_items' => __( 'Search Articles', 'globaly_child' ),
				'all_items' => __( 'All Articles', 'globaly_child' ),
				'parent_item' => __( 'Parent Article', 'globaly_child' ),
				'parent_item_colon' => __( 'Parent Article:', 'globaly_child' ),
				'edit_item' => __( 'Edit Article', 'globaly_child' ),
				'update_item' => __( 'Update Article', 'globaly_child' ),
				'add_new_item' => __( 'Add New Article', 'globaly_child' ),
				'new_item_name' => __( 'New Article Name', 'globaly_child' ),
				'menu_name' => __( 'Articles', 'globaly_child' ),
			),
			'news' => array(
				'name' => __( 'News', 'globaly_child' ),
				'singular_name' => __( 'News', 'globaly_child' ),
				'search_items' => __( 'Search News', 'globaly_child' ),
				'all_items' => __( 'All News', 'globaly_child' ),
				'parent_item' => __( 'Parent News', 'globaly_child' ),
				'parent_item_colon' => __( 'Parent News:', 'globaly_child' ),
				'edit_item' => __( 'Edit News', 'globaly_child' ),
				'update_item' => __( 'Update News', 'globaly_child' ),
				'add_new_item' => __( 'Add New News', 'globaly_child' ),
				'new_item_name' => __( 'New News Name', 'globaly_child' ),
				'menu_name' => __( 'News', 'globaly_child' ),
			),
		);

		return isset( $labels[ $item ] ) ? $labels[ $item ] : array();
	}
}

PostTaxonomies::init();