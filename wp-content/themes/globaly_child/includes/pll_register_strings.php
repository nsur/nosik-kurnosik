<?php

class ThemeTranslation {
	public $translations = [
		'Menu',
		'Home',
		'Home nickname',
		'Born date',
		'Died',
		'Years of live',
		'Color',
		'Hair',
		'Sire',
		'Dam',
		'Hearts',
		'Litera',
		'Boys',
		'Girls',
		'selling',
		'reserved',
		'sold',
		'This section is in progress...',
		'To date, there are no Pug puppies for sale',
		'To date, there are no Chihuahua puppies for sale',
		'To date, there are no puppies for sale',
		'Please verify that you are not a robot',
	    '%%year%% Nosik-Kurnosik. All rights reserved.'
	];

	public function __construct() {
		if ( function_exists( 'pll_register_string' ) ) {
			foreach ( $this->translations as $trans ) {
				pll_register_string( str_replace( ' ', '_', $trans ), $trans, 'globaly' );
			}
		}
	}
}

new ThemeTranslation;