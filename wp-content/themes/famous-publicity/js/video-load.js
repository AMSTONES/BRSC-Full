jQuery(document).ready(function($) {
	let target = $('.video-image-container');
	let location = `${window.location.protocol}//${window.location.hostname}`
  const videoQuality = videoSize(screen.availWidth);

	if (videoQuality != null) {
		target.prepend(`<video id='banner-video' autoplay muted loop preload='auto'> <source src='${location}/wp-content/themes/famous-publicity/images/fp-tank-${videoQuality}.mov' type='video/mp4'> </video>`);
	}
});

const videoSize = (screenWidth) => {
  switch (true) {
    case(screenWidth >= 1200):
      return '1080';
      break;

    case(screenWidth >= 768):
      if (screen.availHeight <= 600) {
        return null;
      } else {
        return '720';
      }
      break;

    default:
      return null;
  }
}
