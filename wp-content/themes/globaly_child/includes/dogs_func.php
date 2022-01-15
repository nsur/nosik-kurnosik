<?php

class Dogs_Func {
	public static function get_archive_data() {
		$archive  = null;
		$taxonomy = get_field( 'taxonomy' );
		$taxonomy = is_array( $taxonomy ) ? array_filter( $taxonomy ) : $taxonomy;
		if ( $taxonomy ) {
			$tax_query = array( 'relation' => 'OR', );
			foreach ( $taxonomy as $tax => $term_ids ) {
				if ( ! empty( $term_ids ) ) {
					array_push( $tax_query, array(
						'taxonomy' => $tax,
						'field'    => 'id',
						'terms'    => $term_ids,
					) );
				}
			}
			$archive = new WP_Query( array(
				'post_type'  => 'any',
				'tax_query'  => $tax_query,
				'orderby'    => array( 'birthday' => 'DESC', 'title' => 'ASC', ),
				'meta_query' => array(
					array(
						'key' => 'birthday',
					)
				),
			) );
		}

		return $archive;
	}

	public static function get_litters( $taxonomy ) {
		$litters = get_terms( array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'meta_value',
			'order'      => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'birthday',
				)
			)
		) );

		foreach ( $litters as &$litter ) {
			$litter->father           = get_field( 'father', $litter );
			$litter->mother           = get_field( 'mother', $litter );
			$litter->puppies_for_sale = array();
			$puppies                  = get_posts( array(
				'post_type'      => 'any',
				'posts_per_page' => - 1,
				'tax_query'      => array(
					array(
						'taxonomy' => $litter->taxonomy,
						'field'    => 'id',
						'terms'    => $litter->term_id
					),
				),
				'orderby'        => array( 'post_title' => 'ASC' ),
			) );
			if ( ! empty( $puppies ) ) {
				$litter->puppies_for_sale = array(
					'girls' => [],
					'boys'  => [],
				);
				foreach ( $puppies as &$puppy ) {
					$status = get_field( 'status', $puppy->ID );
					if ( $status['value'] !== 'archived' ) {
						$puppy->status   = $status;
						$post_taxonomies = get_post_taxonomies( $puppy->ID );
						foreach ( $post_taxonomies as $tax ) {
							if ( in_array( $tax, Dogs::DOG_TAXONOMIES ) ) {
								$post_terms = wp_get_post_terms( $puppy->ID, $tax );
								if ( ! empty( $post_terms ) ) {
									foreach ( $post_terms as $term ) {
										if ( strpos( $term->slug, 'girls' ) !== false ) {
											array_push( $litter->puppies_for_sale['girls'], $puppy );
										}
										if ( strpos( $term->slug, 'boys' ) !== false ) {
											array_push( $litter->puppies_for_sale['boys'], $puppy );
										}
									}
								}
							}
						}

					}
				}
				$litter->puppies_for_sale = array_filter( $litter->puppies_for_sale );
				foreach ( $litter->puppies_for_sale as &$sex ) {
					usort( $sex, array( 'Dogs_Func', 'sort_by_status' ) );
				}
			}
		}

		return $litters;
	}

	public static function sort_by_status( $a, $b ) {
		foreach ( Dogs::STATUSES_ORDER as $order ) {
			if ( $a->status['value'] == $order ) {
				return 0;
			}
			if ( $b->status['value'] == $order ) {
				return 1;
			}
		}
	}
}