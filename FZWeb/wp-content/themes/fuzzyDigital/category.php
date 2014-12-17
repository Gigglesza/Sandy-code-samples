<?php get_header(); ?>
<section class="sixteen columns post">
	<div class="contentSection">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				
					<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
						$thumb_url = $thumb_url_array[0];
					/* <a class="lbp-inline-link-1 cboxElement" href="#">Click here to open popup #1</a>

					<div style="display: none;">
						<div id="lbp-inline-href-1" style="padding:10px; background: #fff;">
							<p>This content will be in a popup.</p>
						</div>
					</div> */
					?>
					<?php
						$custom = MultiPostThumbnails::get_post_thumbnail_id('post', 'secondary-image', $post->ID); 
						$custom=wp_get_attachment_image_src($custom,'post-secondary-image-thumbnail'); 
						
					?>
					<a href="<?php echo $custom[0]; ?>" class="foobox categoryLink" rel="lightbox[secondary-demo]">
						<div class="categoryFullBox">
							<img src="<?php echo $thumb_url; ?>" class="categoryImg" />
							<span class="categoryName"><?php the_title(); ?></span>
							<div class="categoryOverText">
								<?php the_excerpt(); ?> 
							</div>
						</div>
					</a>
					
					<!--<a href="" class="categoryLink" rel="shadowbox">
						<div class="categoryFullBox">
							<img src="" class="categoryImg" />
							<span class="categoryName"></span>
							<div class="categoryOverText">
								 
							</div>
						</div>
					</a>-->
				
			<?php endwhile; ?>
			<div class="navigation">
				<div class="alignleft">
					<?php posts_nav_link('','','&laquo; Previous Entries') ?>
				</div>
				<div class="alignright">
					<?php posts_nav_link('','Next Entries &raquo;','') ?>
				</div>
			</div>
		<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center"><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>