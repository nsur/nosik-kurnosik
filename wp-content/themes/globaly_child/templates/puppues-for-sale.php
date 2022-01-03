<?php
/*
 * Template Name:  Puppies for Sale
 */
while ( have_posts() ) : the_post();

	global $page;

	$breed = (string) get_field( 'breed' );

	get_template_part_with_data( 'template-parts/puppies-litter', array( 'litters' => Dogs_Func::get_litters( "{$breed}_litters" ), ) );

endwhile; // End of the loop.
?>

