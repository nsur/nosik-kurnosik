<?php
/**
 * Template part for minimal Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advisto
 */
?>

<div class="header-container__flex">
	<?php globaly_main_menu(); ?>
	<div class="header__message">
		<?php
		$message = get_theme_mod( 'header_text_message', globaly_theme()->customizer->get_default( 'header_text_message' ) );
		if ( $message ) {
			echo do_shortcode( $message );
		} ?>
	</div>
</div>
