jQuery(document).ready(function($) {
	let targets = $(".service-image-container");
	targets.click(function(){
		if ($(this).hasClass('active')){
			targets.removeClass('active');
		} else {
			targets.removeClass('active');
			targets.children('p').fadeOut();
			$(this).addClass('active');
		}
	});
});


