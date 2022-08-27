<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advisto
 */
?>
<?php
$size = globaly_post_thumbnail_size( array( 'class_prefix' => 'post-thumbnail--' ) );
$disable_links = !empty( $disable_links ) ? $disable_links : get_field( 'disable_links', get_queried_object() );
$utility = globaly_utility()->utility;
?>
<article
	id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card post-thumbnail__link ' . $size[ 'class' ] ); ?>>

	<figure class="post-thumbnail">

		<?php if( has_post_thumbnail() ) { ?>
			<?php if( !$disable_links ) { ?>
				<a href="<?php echo get_permalink() ?>">
			<?php } ?>
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), array( 300, 300 ), true, array( 'class' => 'image-bordered', ) ); ?>
			<?php if( !$disable_links ) { ?>
				</a>
			<?php } ?>
		<?php } else { ?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/no-image.png" width="300" height="300"
			     class="image-bordered"/>
		<?php } ?>


	</figure>
	<!-- .post-thumbnail -->

	<div class="post-list__item-content">
		<div class="post-list__item-content--inner">
			<header class="entry-header">
				<?php
				$title_html = ( is_single() || $disable_links ) ? '<h1 %1$s>%4$s</h1>' : '<h1 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h1>';

				$utility->attributes->get_title( array( 'class' => 'entry-title', 'html' => $title_html, 'echo' => true, ) );
				?>
			</header>
			<!-- .entry-header -->

			<div class="entry-summary">
				<div class="entry-summary--body">
					<?php if( $titles = get_field( 'titles' ) ) : ?>
						<div class="titles"><?php echo $titles ?></div>
					<?php endif; ?>
					<div class="params">
						<?php if( $birthday = get_field( 'birthday' ) ) :
							$birthday_date = date_format( date_create( $birthday ), 'd.m.Y' ); ?>
							<?php if( $deathdate = get_field( 'deathdate' ) ) :
								$deathdate_date = date_format( date_create( $deathdate ), 'd.m.Y' ); ?>
								<div>
									<strong><?php pll_e( 'Years of live', 'globaly' ) ?>:</strong>
									<span><?php echo $birthday_date ?> - <?php echo $deathdate_date ?></span>
								</div>
							<?php else : ?>
								<div>
									<strong><?php pll_e( 'Born date', 'globaly' ) ?>:</strong>
									<span><?php echo $birthday_date ?></span>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>

				<?php if( !$disable_links ) { ?>
					<div class="entry-summary--footer">
						<?php $utility->attributes->get_button( array( 'class' => 'btn btn-primary', 'text' => pll__( globaly_theme()->customizer->get_default( 'blog_read_more_text' ) ), 'icon' => '<i class="material-icons">arrow_forward</i>', 'html' => '<a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a>', 'echo' => true, ) ); ?>

						<?php globaly_share_buttons( 'loop' ); ?>
					</div>
				<?php } ?>

			</div>
			<!-- .entry-summary -->
		</div>

	</div>
	<!-- .post-list__item-content -->

</article><!-- #post-## -->

<hr class="separator right"/>
