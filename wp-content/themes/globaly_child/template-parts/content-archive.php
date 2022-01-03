<?php switch ( get_post_type() ) :
	case 'pug':
	case 'chihuahua':
		global $post;
		$post_taxonomies = get_post_taxonomies( $post->ID );
		$is_presentation = false;
		foreach ( $post_taxonomies as $tax ) {
			if ( in_array( $tax, Dogs::DOG_TAXONOMIES ) ) {
				$post_terms = wp_get_post_terms( $post->ID, $tax );
				if ( ! empty( $post_terms ) ) {
					foreach ( $post_terms as $term ) {
						$disable_links   = get_field( 'disable_links', $term );
						$is_presentation = get_field( 'is_presentation', $term );
					}
				}
			}
		}
		if ( $is_presentation ) {
			get_template_part_with_data( 'template-parts/presentation-dog', array( 'disable_links' => $disable_links, ) );
		} else {
			get_template_part_with_data( 'template-parts/excerpt-dog', array( 'disable_links' => $disable_links, ) );
		}
		break;
	default:
		get_template_part( 'template-parts/content', get_post_format() );
		break;
endswitch;
