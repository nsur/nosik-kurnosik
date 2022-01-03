<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advisto
 */
?>
<?php $size = globaly_post_thumbnail_size( array( 'class_prefix' => 'post-thumbnail--' ) ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card post-thumbnail__link ' . $size[ 'class' ] ); ?>>

	<?php
	$utility = globaly_utility()->utility;
	$is_news = is_archive() && 'post' === get_post_type() &&  has_term('', 'news');
	?>

	<div class="post-list__item-content">
		<div class="post-list__item-content--inner">
			<header class="entry-header">
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php $tags_visible = globaly_is_meta_visible( 'blog_post_tags', 'loop' ) ? 'true' : 'false';

							$utility->meta_data->get_terms( array(
								'visible'   => $tags_visible,
								'type'      => 'post_tag',
								'delimiter' => ' ',
								'icon'      => '',
								'before'    => '<div class="post__tags">',
								'after'     => '</div>',
								'echo'      => true,
							) );
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php
					$title_html = ( is_single() || $is_news ) ? '<h1 %1$s>%4$s</h1>' : '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>';

					$utility->attributes->get_title( array(
						'class' => 'entry-title',
						'html'  => $title_html,
						'echo'  => true,
					) );
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php if ( $is_news ) {
					the_content();
				} else {
					$blog_content = get_theme_mod( 'blog_posts_content', globaly_theme()->customizer->get_default( 'blog_posts_content' ) );
					$length = ( 'full' === $blog_content ) ? 0 : 45;

					$utility->attributes->get_content( array(
						'length'       => $length,
						'content_type' => 'post_excerpt',
						'echo'         => true,
					) );
				}
				?>

				<div class="entry-content--footer"></div>
			</div><!-- .entry-content -->
		</div>

	</div><!-- .post-list__item-content -->

</article><!-- #post-## -->

<hr class="separator" />
