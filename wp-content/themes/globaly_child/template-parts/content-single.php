<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advisto
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = globaly_utility()->utility; ?>

	<figure class="post-thumbnail">
		<?php $utility->media->get_image( array(
				'size'        => 'globaly-thumb-l',
				'html'        => '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s">',
				'placeholder' => false,
				'echo'        => true,
			) );
		?>
	</figure><!-- .post-thumbnail -->

	<header class="entry-header">
		<?php $cats_visible = globaly_is_meta_visible( 'single_post_categories', 'single' ) ? 'true' : 'false'; ?>

		<?php $utility->meta_data->get_terms( array(
				'visible' => $cats_visible,
				'type'    => 'category',
				'icon'    => '',
				'before'  => '<div class="post__cats">',
				'after'   => '</div>',
				'echo'    => true,
			) );
		?>

		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h2 %1$s>%4$s</h2>',
				'echo'  => true,
			) );
		?>

	</header><!-- .entry-header -->

	<?php globaly_ads_post_before_content() ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'globaly' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links__item">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'globaly' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php globaly_share_buttons( 'single', array(), array('before' => sprintf( '<h4 class="share-btns__text">%s </h4>', esc_html__( 'Share: ', 'globaly' ) ) )); ?>
		<?php $tags_visible = globaly_is_meta_visible( 'single_post_tags', 'single' ) ? 'true' : 'false'; ?>

		<?php $utility->meta_data->get_terms( array(
				'visible'   => $tags_visible,
				'type'      => 'post_tag',
				'delimiter' => '',
				'icon'      => '',
				'before'    => '<div class="post__tags"><h4>' . esc_html__('Tags:', 'globaly') . '</h4>',
				'after'     => '</div>',
				'echo'      => true,
			) );
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
