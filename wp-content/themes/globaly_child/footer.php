<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Advisto
 */

?>

	</div><!-- #content -->

	<footer id="colophon" <?php globaly_footer_class() ?> role="contentinfo">
		<?php get_template_part( 'template-parts/footer/layout', get_theme_mod( 'footer_layout_type' ) ); ?>
		<div class="banner-container">
			<div class="container">
				<img src="<?php echo get_theme_mod( 'footer_logo_url' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer-banner" />
				<div class="shadow"></div>
			</div>
		</div>
		<div class="copyright-container">
			<div class="container">
				<div class="footer-copyright">
					<?php $copyright = pll__('%%year%% Nosik-Kurnosik. All rights reserved.');
					echo wp_kses( globaly_render_macros( $copyright ), wp_kses_allowed_html( 'post' ) ); ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!-- {%FOOTER_LINK} -->
</body>
</html>
