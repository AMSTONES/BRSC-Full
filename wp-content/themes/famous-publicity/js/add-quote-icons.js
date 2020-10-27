jQuery(document).ready(function($) {
	let blockquotes = $('blockquote');
	if (blockquotes.length > 0) {
		blockquotes.each(function(){
			let target = $(this).find('p');
			target.prepend('<i class="fas fa-quote-left" style="margin-right: 10px">');
			target.append('<i class="fas fa-quote-right">');
		})
	}
})

