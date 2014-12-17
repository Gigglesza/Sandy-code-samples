<?php get_header(); ?>
<section class="sixteen columns post">
	<div class="contentSection">
		<div class="three columns">
			&nbsp;
		</div>
		<div class="nine columns pageContent clearfix">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				echo "<h3>".get_the_title()."</h3><br/>";
				the_content();
				endwhile; else: ?>
				<p>Sorry, no posts matched your criteria.</p>
			<?php endif; ?>
		</div>
		<div class="four columns">
			&nbsp;
		</div>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>