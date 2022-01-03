<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Advisto
 */
?>
</section><!-- .error-404 -->

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<h4><?php pll_e( "We couldn't find the page you're looking for...", 'globaly' ); ?></h4>
		<p><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php pll_e( 'Visit home page', 'globaly' ); ?></a></p>
	</div><!-- .page-content -->
</section><!-- .error-404 -->

