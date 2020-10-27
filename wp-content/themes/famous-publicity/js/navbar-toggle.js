jQuery(document).ready(function($) {
	let target = $('#nav-fullscreen');
	let open = $('.navbar-open');
	let close = $('.navbar-close');
	open.click(function(){
		target.fadeIn(200);
		open.fadeOut(200);
	});
	close.click(function(){
		target.fadeOut(200);
		//close.fadeOut(100);
		open.fadeIn(200);
	})
})
