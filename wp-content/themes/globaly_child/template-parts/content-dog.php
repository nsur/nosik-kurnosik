<h1 class="name"><?php the_title() ?></h1>
<?php if( $titles = get_field( 'titles' ) ) : ?>
	<h2 class="titles"><?php echo $titles ?></h2>
<?php endif; ?>
<?php $gallery = get_field( 'gallery' );
get_template_part_with_data( 'template-parts/gallery-dog', array( 'gallery' => $gallery, 'classes' => 'grid-2' ) ) ?>
<div class="params">
	<?php if( $nickname = get_field( 'nickname' ) ) : ?>
		<div>
			<strong><?php pll_e( 'Home nickname', 'globaly' ) ?>:</strong>
			<span><?php echo $nickname ?></span>
		</div>
	<?php endif; ?>
	<?php if( $birthday = get_field( 'birthday' ) ) : ?>
		<div>
			<strong><?php pll_e( 'Born date', 'globaly' ) ?>:</strong>
			<span><?php echo date_format( date_create( $birthday ), 'd.m.Y' ) ?></span>
		</div>
	<?php endif; ?>
	<?php if( $deathdate = get_field( 'deathdate' ) ) : ?>
		<div>
			<strong><?php pll_e( 'Died', 'globaly' ) ?>:</strong>
			<span><?php echo date_format( date_create( $deathdate ), 'd.m.Y' ) ?></span>
		</div>
	<?php endif; ?>
	<?php if( $color = get_field( 'color' ) ) : ?>
		<div>
			<strong><?php pll_e( 'Color', 'globaly' ) ?>:</strong>
			<span><?php echo $color ?></span>
		</div>
	<?php endif; ?>
	<?php if( $hear = get_field( 'hair' ) ) : ?>
		<div>
			<strong><?php pll_e( 'Hair', 'globaly' ) ?>:</strong>
			<span><?php echo $hear ?></span>
		</div>
	<?php endif; ?>
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
	<?php if( $family_tree_link = get_field( 'family_tree_link' ) ) : ?>
		<strong>
			<a href="<?php echo $family_tree_link ?>" target="_blank"><?php pll_e( 'Link to pedigree', 'globaly' ) ?>&nbsp;<i class="fa fa-external-link" aria-hidden="true"></i></a>
		</strong>
	<?php endif; ?>
</div>
<div class="description">
	<?php if( $text = get_field( 'text' ) ) : ?>
		<p><?php echo $text ?></p>
	<?php endif; ?>
</div>
<?php if( $family_tree_image = get_field( 'family_tree_image' ) ) : ?>
	<div>
		<img src="<?php echo $family_tree_image['url'] ?>" alt="<?php pll_e( 'Pedigree image', 'globaly' ) ?>" />
	</div>
<?php endif; ?>
<div class="family-tree" id="pedigree-table">
	<?php
	$family_tree = get_field( 'family_tree' );
	if( is_numeric( $family_tree ) ) { ?>
		<!-- Start of pedigree table -->
		<link href="http://ingrus.net/newver/styles/pedigree.css" rel="stylesheet" type="text/css">
		<script>
            jQuery(document).ready(function() {
                jQuery.ajax({'url': "http://ingrus.net/newver/ajax/dynint.php",
                    'dataType': 'jsonp',
                    'jsonp': "callback",
                    'data': {
                        'func':'GetHorizPedigree',
                        'breed': '<?php echo get_post_type() ?>',
                        'pref': '',
                        'id': <?php echo $family_tree ?>,
                        'lev': 4,
                        'lang': 'ru',
                        'img': 'yes',
                    },
                    'success':function(data){
                        if (data.ret == 'ok' && data.tbl != '') jQuery('#pedigree-table').append(data.tbl);
                    },
                    'error':function(data){}
                });
            });
		</script>
		<!-- End of pedigree table -->
	<?php } else {
		echo $family_tree;
	} ?>
</div>
