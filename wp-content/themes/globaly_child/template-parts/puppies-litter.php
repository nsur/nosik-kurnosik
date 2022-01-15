<?php
if( !empty( $litters ) ) :
	foreach( $litters as $litter ) : ?>
		<div class="litter separated-item">
			<div class="parents">
				<div class="item-row">
					<a href="<?php echo get_permalink( $litter->father ) ?>" class="item">
						<?php if( has_post_thumbnail( $litter->father ) ) {
							echo wp_get_attachment_image( get_post_thumbnail_id( $litter->father ), array( 300, 300 ), true, array( 'class' => 'image-bordered', ) );
						} ?>
					</a>

					<div class="item hearts">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/hearts.png"
						     alt="<?php pll_e( 'Hearts', 'globaly' ) ?>"/>
					</div>
					<a href="<?php echo get_permalink( $litter->mother ) ?>" class="item">
						<?php if( has_post_thumbnail( $litter->mother ) ) {
							echo wp_get_attachment_image( get_post_thumbnail_id( $litter->mother ), array( 300, 300 ), true, array( 'class' => 'image-bordered', ) );
						} ?>
					</a>
				</div>
				<div class="item-row">
					<a href="<?php echo get_permalink( $litter->father ) ?>" class="item">
						<h3><?php echo get_the_title( $litter->father ) ?></h3>
					</a>

					<div class="item"></div>
					<a href="<?php echo get_permalink( $litter->mother ) ?>" class="item">
						<h3><?php echo get_the_title( $litter->mother ) ?></h3>
					</a>
				</div>
			</div>
			<div class="date-of-birth">
				<h1><?php echo pll__( 'Born date', 'globaly' ) . ': ' . date_format( date_create( get_field( 'birthday', $litter ) ), 'd.m.Y' ) ?></h1>
				<?php if( $character = get_field( 'character', $litter ) ) {?>
					<p><?php echo( pll__( 'Litera', 'globaly' ) . ' ' . $character ); ?></p>
				<?php } ?>
				<?php echo term_description( $litter->term_id ); ?>
			</div>
			<div class="puppies">
				<?php if ( $gallery_litter = get_field( 'gallery', $litter ) ) : ?>
					<div class="items-wrap">
						<div class="item">
							<?php get_template_part_with_data( 'template-parts/gallery-dog', array(
								'gallery' => $gallery_litter,
								'classes' => 'grid-2 grid-center'
							) ); ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $litter->puppies_for_sale ) :
					foreach ( $litter->puppies_for_sale as $sex => $puppies_list ) : ?>
						<div class="items-title"><?php pll_e( ucfirst( $sex ), 'globaly' ) ?></div>
						<div class="items-wrap">
							<?php foreach ( $puppies_list as $puppy ) :
								$gallery = get_field( 'gallery', $puppy ); ?>
								<div class="item">
									<h2><?php echo get_the_title( $puppy->ID ) ?></h2>
									<p class="status-<?php echo $puppy->status['value'] ?>"><?php pll_e( $puppy->status['label'], 'globaly' ) ?></p>
									<?php get_template_part_with_data( 'template-parts/gallery-dog', array(
										'gallery' => $gallery,
										'classes' => 'grid-2 grid-center'
									) ); ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach;
				endif; ?>
			</div>
			<hr class="separator"/>
		</div>
	<?php endforeach ?>
<?php else : ?>
	<?php get_template_part( 'template-parts/content-no-puppies' ); ?>
<?php endif ?>
