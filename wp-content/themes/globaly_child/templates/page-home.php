<?php
/*
 * Template Name:  Home Page
 */

while( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php $utility = globaly_utility()->utility; ?>

		<header class="entry-header">
			<?php $utility->attributes->get_title( array(
				'class' => 'entry-title screen-reader-text',
				'html' => '<h1 %1$s>%4$s</h1>',
				'echo' => true,
			) );
			?>
		</header>
		<!-- .entry-header -->

		<div class="entry-content">
			<div class="title-wrap">
				<?php if( $logo_1 = get_field( 'logo_1' ) ) : ?>
					<img src="<?php echo $logo_1[ 'sizes' ][ 'medium' ] ?>" alt="<?php echo $logo_1[ 'alt' ] ?>" />
				<?php endif; ?>
				<h1><?php the_field( 'title' ) ?></h1>
				<?php if( $logo_2 = get_field( 'logo_2' ) ) : ?>
					<img src="<?php echo $logo_2[ 'sizes' ][ 'medium' ] ?>" alt="<?php echo $logo_2[ 'alt' ] ?>" />
				<?php endif; ?>
			</div>
			<?php if( $image = get_field( 'image' ) ) : ?>
				<div class="image">
					<img src="<?php echo $image[ 'sizes' ][ 'medium' ] ?>" alt="<?php echo $image[ 'alt' ] ?>" class="image-bordered" />
				</div>
			<?php endif; ?>
			<div><?php the_field( 'text' ) ?></div>
		</div>
		<!-- .entry-content -->

	</article><!-- #post-## -->

<?php endwhile; // End of the loop. ?>

