<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advisto
 */

switch(get_field('breed')) {
	case 'pug':
		$message = pll__( 'To date, there are no Pug puppies for sale', 'globaly' );
		break;
	case 'chihuahua':
		$message = pll__( 'To date, there are no Chihuahua puppies for sale', 'globaly' );
		break;
	default:
		$message = pll__( 'To date, there are no puppies for sale', 'globaly' );
		break;
}
?>
<section class="no-results">
	<header class="page-header">
		<h1 class="page-title"><?php echo $message ?></h1>
	</header><!-- .page-header -->

	<div class="page-content"></div><!-- .page-content -->
</section><!-- .no-results -->
