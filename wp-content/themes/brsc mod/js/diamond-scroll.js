jQuery(document).ready(function($) {
  $("a[href^='#']").click(function(e) {
    e.preventDefault();
    var position = $($(this).attr("href")).offset().top;

    $("body, html").animate({
      scrollTop: position
    }, {duration: 750});
  });
  $(".brsc-diamond-trio").delay(2500).queue(function(next){
    $(this).addClass('diamond-point-down');
    next();
    $(this).children().addClass('brsc-wiggle');
  })
})
