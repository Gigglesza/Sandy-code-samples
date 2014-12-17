	<div class="socialIcons">
		<a href="http://www.facebook.com/fuzzydigitalza" target="_blank"><img src="<?php bloginfo('template_url');?>/img/fb.png" title="<?php bloginfo('title');?> on Facebook"/></a>
		<!--<a href="http://www.twitter.com/fuzzydigital" target="_blank"><img src="<?php bloginfo('template_url');?>/img/tw.png" title="<?php bloginfo('title');?> on Twitter"/></a>
		<a href="http://www.linkedin.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/in.png" title="<?php bloginfo('title');?> on LinkedIn"/></a>
		<a href="http://www.google.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/go.png" title="<?php bloginfo('title');?> on Google+"/></a>-->
	</div>
	<div class="legalStuff">
		<?php echo date("Y") ?> &copy; <a href="<?php echo get_permalink( 14 ); ?>" class="privacy">Privacy policy</a>
	</div>
		</div>
		<script>
			jQuery("#show-nav").click(function () {
				jQuery("#nav-bar").toggle("slow");
				jQuery("#close-nav").toggle("slow");
				jQuery("#show-nav").toggle("slow");
			});
			jQuery("#close-nav").click(function () {
				jQuery("#nav-bar").toggle("slow");
				jQuery("#close-nav").toggle("slow");
				jQuery("#show-nav").toggle("slow");
			});
		</script>
		<?php wp_footer(); ?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-53113338-1', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>
</html>