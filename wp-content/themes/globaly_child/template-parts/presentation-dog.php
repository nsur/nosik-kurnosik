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
$disable_links = !empty( $disable_links ) ? $disable_links : get_field( 'disable_links', get_queried_object() );
$utility = globaly_utility()->utility;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
					<?php if( $father_text = get_field( 'father_text' ) ) : ?>
						<div>
							<strong><?php pll_e( 'Sire', 'globaly' ) ?>:</strong>
							<span><?php echo $father_text ?></span>
						</div>
					<?php endif; ?>
					<?php if( $mother_text = get_field( 'mother_text' ) ) : ?>
						<div>
							<strong><?php pll_e( 'Dam', 'globaly' ) ?>:</strong>
							<span><?php echo $mother_text ?></span>
						</div>
					<?php endif; ?>
					<?php if ( $titles = get_field( 'titles' ) ) : ?>
						<div class="titles">
							<?php echo $titles ?>
						</div>
					<?php endif; ?>
					<?php $gallery = get_field( 'gallery' );
					get_template_part_with_data( 'template-parts/gallery-dog', array( 'gallery' => $gallery, 'classes' => 'grid-2' ) ); ?>
				</div>

				<?php if( ! $disable_links ) { ?>
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

<hr style="visibility: hidden;"/>
