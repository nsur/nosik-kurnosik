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
			$litter->puppies_for_sale = get_field( 'puppies_for_sale', $litter );
			if ( $litter->puppies_for_sale) {
				foreach ( $litter->puppies_for_sale as &$gender_group ) {
					if(is_array($gender_group)) {
						$gender_group = array_filter( $gender_group, array( 'Dogs_Func', 'filter_by_status' ));
						usort( $gender_group, array( 'Dogs_Func', 'sort_by_name' ) );
						usort( $gender_group, array( 'Dogs_Func', 'sort_by_status' ) );
					}
				}
				$litter->puppies_for_sale = array_filter( $litter->puppies_for_sale );
			}
		}

		return $litters;
	}

	public static function filter_by_status( $item ) {
		return $item[ 'status' ][ 'value' ] !== 'archived';
	}

	public static function sort_by_name( $a, $b ) {
		return strnatcmp($a['name'],$b['name']);
	}

	public static function sort_by_status( $a, $b ) {
		$a_status = array_search($a['status']['value'], Dogs::STATUSES_ORDER);
		$b_status = array_search($b['status']['value'], Dogs::STATUSES_ORDER);
		if ($a_status == $b_status) {
        return 0;
    }
    return ($a_status < $b_status) ? -1 : 1;
	}
}
