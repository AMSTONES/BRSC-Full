jQuery(document).ready(function($) {
	let services = $('.bw-image-box');
  window.addEventListener('touchstart', function onFirstTouch() {
    services.each(function(index){
				$(this).attr('data-aos', 'animate-greyscale');
				$(this).attr('data-aos-offset', '200');
		})
		window.removeEventListener('touchstart', onFirstTouch, false);
		AOS.init();
	},false);
});
