<?php
/**
 * The template for displaying all single chihuahuas
 */

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content-dog' );

	globaly_post_author_bio();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
