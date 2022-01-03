<?php
/*
 * Template Name:  Archive Page
 */

while ( have_posts() ) : the_post();

	if ( $litters_list = get_field( 'litters' ) ) :
		get_template_part_with_data( 'template-parts/puppies-litter', array( 'litters' => Dogs_Func::get_litters( $litters_list ), ) );
	else :
		$image = get_field( 'image' ); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php $utility = globaly_utility()->utility; ?>

			<header class="entry-header">
				<?php $utility->attributes->get_title( array(
					'class' => 'entry-title screen-reader-text',
					'html'  => '<h1 %1$s>%4$s</h1>',
					'echo'  => true,
				) );
				?>
			</header>
			<!-- .entry-header -->

			<div class="entry-content">
				<?php $query = Dogs_Func::get_archive_data();
				if ( $query && $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						get_template_part( 'template-parts/content-archive' );
					}
				} else {
					get_template_part( 'template-parts/content', 'empty' );
				}
				wp_reset_postdata(); ?>
			</div>
			<!-- .entry-content -->

		</article><!-- #post-## -->

	<?php endif;
endwhile; // End of the loop.
?>