<?php get_header(); ?>
<section class="sixteen columns post">
	<div class="contentSection">
		
		<?php
			$categories = get_the_category(19);
			$separator = ' ';
			$output = '';
			$image = '';
			if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url();
			if($categories){
				foreach($categories as $category) {
					$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all projects in %s" ), $category->name ) ) . '" class="categoryLink">';
					$output .=  '<div class="categoryFullBox">';
					if (function_exists('z_taxonomy_image_url')) 
						$image = z_taxonomy_image_url( $category->term_id, TRUE );
					$output .= '<img src="'.$image.'" class="categoryImg" />';
					$output .= '<span class="categoryName">'.$category->name.'</span>';
					$output .= '<div class="categoryOverText">'.$category->description.'</div>';
						
					/* $output .= $image; */
					$output .= '</div></a>'.$separator;
				}
			echo trim($output, $separator);
			}
		?>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>