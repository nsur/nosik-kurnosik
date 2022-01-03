<?php if( ! empty($gallery) ) :
	$classes = isset($classes) ? $classes : '' ?>
	<div class="gallery grid <?php echo $classes ?> lightbox">
		<?php foreach( $gallery as $img ) : ?>
			<?php if( !empty( $img[ 'image' ] ) ) : ?>
				<a href="<?php echo $img[ 'image' ]['url'] ?>" class="item" title="<?php echo $img[ 'caption' ] ?>">
					<img src="<?php echo $img[ 'image' ]['sizes']['thumbnail'] ?>" alt="<?php echo $img[ 'image' ]['alt'] ?>" class="image-bordered small" />
					<?php if( !empty($img[ 'caption' ]) ) : ?>
						<div class="caption">
							<div class="inner-wrap"><?php echo $img[ 'caption' ] ?></div>
						</div>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
