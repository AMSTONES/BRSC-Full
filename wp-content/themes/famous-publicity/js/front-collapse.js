jQuery(document).ready(function($) {
	let target = $('#collapsible-text-front-page');
	target.hide();
	let trigger = $('.collapse-button');
	trigger.click(function(){
		target.slideUp().fadeIn();
		trigger.hide();
	});
});