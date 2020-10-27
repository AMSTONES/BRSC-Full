<?php wp_footer(); ?>
<?php if (!is_page('contact-us')) {
	get_template_part('content', 'contactbar');
}?>


<div class="footer">

	<div class="footer-address-area">
		<div class="footer-address-text">
			<span class="footer-telephone">Office: 0333 344 2341</span>
			<br>
			<span>Redhill Aerodrome</span>
			<br>
			<span>Aero 16</span>
			<br>
			<span>Kings Mill Lane</span>
			<br>
			<span>South Nutfield</span>
			<br>
			<span>Surrey</span>
			<br>
			<span>RH1 5JY</span>
		</div>
	</div>
	<div class="footer-links">
		<a href="https://twitter.com/TinaFotherby" target="_blank"><i class="fab fa-twitter"></i></a>
		<a href="https://www.linkedin.com/in/tina-fotherby-0466b54/" target="_blank"><i class="fab fa-linkedin"></i></a>
	</div>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>

