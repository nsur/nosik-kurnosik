jQuery(document).ready(function() {
	var subMenuToggle = jQuery('.sub-menu-toggle').next('a'),
		gallery = jQuery('.lightbox'),
		entryGallery = jQuery('.archive.tax-news #main article');

	subMenuToggle.on('click', function () {
		jQuery(this).prev('.sub-menu-toggle').toggleClass('active');
		jQuery(this).parent().toggleClass('sub-menu-open');
	});

	if(gallery.length) {
		gallery.each(function() {
			jQuery(this).lightGallery();
		});
	}
	if(entryGallery.length) {
		entryGallery.each(function() {
			jQuery(this).lightGallery({
				selector: '.lightbox-item'
			});
		});
	}
});