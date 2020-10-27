jQuery(document).ready(function($) {
	let testimonialArea = $(".testimonial-body");
		let testimonials = elv_data.testimonials;
    let currentIndex = 0;
    cycle();
    setInterval(cycle, 10000);
		function cycle(){
      let current = currentIndex;
			testimonial = testimonials[currentIndex];
			testimonialArea.find('p').fadeOut(function(){$(this).text(`${testimonial.testimonial}`).fadeIn()});
			testimonialArea.find('h3').fadeOut(function(){$(this).text(`${testimonial.author}`).fadeIn()});
      (currentIndex < testimonials.length - 1) ? currentIndex++ : currentIndex = 0 ;
		}
	});
