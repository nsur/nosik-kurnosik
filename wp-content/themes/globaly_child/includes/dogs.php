<?php

class Dogs {
	const POST_TYPES = array( 'pug', 'chihuahua', );
	const POST_TAXONOMIES = array(
		'pug'       => array(
			'pugs',
			'pug_litters',
		),
		'chihuahua' => array(
			'chihuahuas',
			'chihuahua_litters',
		),
	);
	const DOG_TAXONOMIES = array(
		'pug'       => 'pugs',
		'chihuahua' => 'chihuahuas',
	);
	const STATUSES_ORDER = array( 'selling', 'reserved', 'sold', );

	public static function init() {
		add_action( 'init', array( self::class, 'registerCustomPosts' ) );
		add_filter( 'cherry_core_init_module', array( self::class, 'checkModules' ), 10, 4 );
		add_filter( 'pre_get_posts', array( self::class, 'pre_get_posts' ), 10, 2 );
	}

	public static function pre_get_posts( $query ) {
		if ( $query->is_main_query() && ! is_admin() ) {
			foreach ( self::DOG_TAXONOMIES as $tax ) {
				if ( $query->is_tax( $tax ) ) {
					$query->query_vars['order']      = 'DESC';
					$query->query_vars['orderby']    = 'birthday';
					$query->query_vars['meta_query'] = array( 'birthday' => array( 'key' => 'birthday', ), );
				}
			}
		}

		return $query;
	}

	public static function checkModules( $module_obj, $module, $args, $class_obj ) {
		if ( ! empty( $module_obj->args['page'] ) ) {
			foreach ( self::POST_TYPES as $type ) {
				array_push( $module_obj->args['page'], $type );
			}
		}

		return $module_obj;
	}

	public static function registerCustomPosts() {
		foreach ( self::POST_TYPES as $post_type ) {
			register_post_type( $post_type, array(
				'labels'             => self::getLabels( $post_type ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => true,
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'          => 'dashicons-heart',
				'supports'           => array(
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt'
				)
			) );
			foreach ( self::POST_TAXONOMIES[ $post_type ] as $taxonomy ) {
				register_taxonomy( $taxonomy, $post_type, array(
					'hierarchical'      => true,
					'labels'            => self::getLabels( $taxonomy ),
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				) );
			}
		}
	}

	public static function getLabels( $item ) {
		$labels = array(
			'pug'               => array(
				'name'               => __( 'Pugs', 'globaly_child' ),
				'singular_name'      => __( 'Pug', 'globaly_child' ),
				'add_new'            => __( 'Add Pug', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Pug', 'globaly_child' ),
				'edit_item'          => __( 'Edit Pug', 'globaly_child' ),
				'new_item'           => __( 'New Pug', 'globaly_child' ),
				'view_item'          => __( 'View Pug', 'globaly_child' ),
				'search_items'       => __( 'Find Pug', 'globaly_child' ),
				'not_found'          => __( 'No Pugs found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Pugs at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Pugs', 'globaly_child' ),
			),
			'chihuahua'         => array(
				'name'               => __( 'Chihuahuas', 'globaly_child' ),
				'singular_name'      => __( 'Chihuahua', 'globaly_child' ),
				'add_new'            => __( 'Add Chihuahua', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Chihuahua', 'globaly_child' ),
				'edit_item'          => __( 'Edit Chihuahua', 'globaly_child' ),
				'new_item'           => __( 'New Chihuahua', 'globaly_child' ),
				'view_item'          => __( 'View Chihuahua', 'globaly_child' ),
				'search_items'       => __( 'Find Chihuahua', 'globaly_child' ),
				'not_found'          => __( 'No Chihuahuas found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Chihuahuas at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Chihuahuas', 'globaly_child' ),
			),
			'pugs'              => array(
				'name'               => __( 'Dogs Categories', 'globaly_child' ),
				'singular_name'      => __( 'Dog Category', 'globaly_child' ),
				'add_new'            => __( 'Add Dog Category', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Dog Category', 'globaly_child' ),
				'edit_item'          => __( 'Edit Dog Category', 'globaly_child' ),
				'new_item'           => __( 'New Dog Category', 'globaly_child' ),
				'view_item'          => __( 'View Dog Category', 'globaly_child' ),
				'search_items'       => __( 'Find Dog Category', 'globaly_child' ),
				'not_found'          => __( 'No Dogs Categories found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Dogs Categories at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Dogs Categories', 'globaly_child' ),
			),
			'chihuahuas'        => array(
				'name'               => __( 'Dogs Categories', 'globaly_child' ),
				'singular_name'      => __( 'Dog Category', 'globaly_child' ),
				'add_new'            => __( 'Add Dog Category', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Dog Category', 'globaly_child' ),
				'edit_item'          => __( 'Edit Dog Category', 'globaly_child' ),
				'new_item'           => __( 'New Dog Category', 'globaly_child' ),
				'view_item'          => __( 'View Dog Category', 'globaly_child' ),
				'search_items'       => __( 'Find Dog Category', 'globaly_child' ),
				'not_found'          => __( 'No Dogs Categories found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Dogs Categories at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Dogs Categories', 'globaly_child' ),
			),
			'pug_litters'       => array(
				'name'               => __( 'Litters', 'globaly_child' ),
				'singular_name'      => __( 'Litter', 'globaly_child' ),
				'add_new'            => __( 'Add Litter', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Litter', 'globaly_child' ),
				'edit_item'          => __( 'Edit Litter', 'globaly_child' ),
				'new_item'           => __( 'New Litter', 'globaly_child' ),
				'view_item'          => __( 'View Litter', 'globaly_child' ),
				'search_items'       => __( 'Find Litter', 'globaly_child' ),
				'not_found'          => __( 'No Litters found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Litters at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Litters', 'globaly_child' ),
			),
			'chihuahua_litters' => array(
				'name'               => __( 'Litters', 'globaly_child' ),
				'singular_name'      => __( 'Litter', 'globaly_child' ),
				'add_new'            => __( 'Add Litter', 'globaly_child' ),
				'add_new_item'       => __( 'Add new Litter', 'globaly_child' ),
				'edit_item'          => __( 'Edit Litter', 'globaly_child' ),
				'new_item'           => __( 'New Litter', 'globaly_child' ),
				'view_item'          => __( 'View Litter', 'globaly_child' ),
				'search_items'       => __( 'Find Litter', 'globaly_child' ),
				'not_found'          => __( 'No Litters found', 'globaly_child' ),
				'not_found_in_trash' => __( 'No Litters at the trash', 'globaly_child' ),
				'menu_name'          => __( 'Litters', 'globaly_child' ),
			),
		);

		return isset( $labels[ $item ] ) ? $labels[ $item ] : array();
	}
}

Dogs::init();