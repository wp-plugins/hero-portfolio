<?php
/**
 * Shortcode
 */
require_once(HR_CLASS_PATH.'/com/riaextended/php/rx_plugin_options.php');
require_once(HR_CLASS_PATH.'/com/riaextended/php/rx_post_options.php');
class HRShortcodes{
	
	public function registerShortcodes(){						
		add_shortcode('rx_hero_three_cols', array($this, 'rx_hero_three_cols'));	
		add_shortcode('rx_hero_two_cols', array($this, 'rx_hero_two_cols'));
		add_shortcode('rx_hero_one_col', array($this, 'rx_hero_one_col'));																				
	}
	
	/* three cols shortcode
	================================================== */	
	public function rx_hero_three_cols($atts, $content = null){
		extract(shortcode_atts(array('category_slug' => ''), $atts));
		$rx_query = array('post_type' => RX_PORTFOLIO_SLUG, 'posts_per_page' =>'-1');		
		if($category_slug!=''){									 
			 $term = term_exists($category_slug);
			 if ($term == 0 || $term == null) {
			 	echo "The ".$category_slug." does not exist!";
			 	return;
			 }
			 $term_id = $term;
			 if(is_array($term)){
			 	$term_id = $term['term_id'];
			 }
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $term_id
					)
				)
			);
			$rx_query = array_merge($rx_query, $args);			 		
		}				
				
		$labels = PluginOptions::getInstance()->getLabels();		
		
		$out = '<div class="rx_hero_portfolio container-fluid">';			
			$query = new WP_Query($rx_query);
			if($query->have_posts()) {
				$groupCount = -1;
				
				while($query->have_posts()){
					$groupCount++;
					if($groupCount==0){
						$out .= '<div class="row">';						
						//echo $groupCount." -open row <br />";
					}
														
					$query->the_post();
					$id = get_the_ID();
					$post_options = new RxPostOptions($id);
					$thumbnail_url = $post_options->getFeaturedImage($id, 800, 650);					
					$title = get_the_title($id);					
					
					$out .= '
					<div class="col-md-4 hero_thumb_ui">
						<div class="hero_thumb_container"><a href="'.get_permalink($id).'" class="hero_thumb_image_link"><img src="'.$thumbnail_url.'" alt="" /></a></div>
						<div class="rx_hero_hoverui">
							<h3 class="rx_hero_thumb_title">'.$title.'</h3>							
							<p class="rx_hero_excerpt">'.$post_options->get_the_excerpt_max_charlength($post_options->getExcerptThreeCols()).'</p>
							<div class="read_more_ui_bottom">
								<a class="rx_hero_read_more" href="'.get_permalink($id).'">'.$labels['readMoreLB'].'</a>
							</div>														
						</div>						
					</div>
					';					
					
					
					if($groupCount==2){						
						//echo $groupCount." -close row <br />";
						$out .= '</div>';
						$groupCount = -1;
					}					 
				}
				if($groupCount==0 || $groupCount==1){
					//echo $groupCount." -close row final <br />";
					$out .= '</div>';
				}				
			} else {
				// no posts found
				//echo "no posts found";
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		$out .= '</div>';
		return $out;		
	}




	/* two cols shortcode
	================================================== */	
	public function rx_hero_two_cols($atts, $content = null){
		extract(shortcode_atts(array('category_slug' => ''), $atts));
		$rx_query = array('post_type' => RX_PORTFOLIO_SLUG, 'posts_per_page' =>'-1');		
		if($category_slug!=''){									 
			 $term = term_exists($category_slug);
			 if ($term == 0 || $term == null) {
			 	echo "The ".$category_slug." does not exist!";
			 	return;
			 }
			 $term_id = $term;
			 if(is_array($term)){
			 	$term_id = $term['term_id'];
			 }
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $term_id
					)
				)
			);
			$rx_query = array_merge($rx_query, $args);			 		
		}	
		
		$labels = PluginOptions::getInstance()->getLabels();
		$out = '<div class="rx_hero_portfolio container-fluid">';			
			$query = new WP_Query($rx_query);
			if($query->have_posts()) {
				$groupCount = -1;
				
				while($query->have_posts()){
					$groupCount++;
					if($groupCount==0){
						$out .= '<div class="row">';						
						//echo $groupCount." -open row <br />";
					}
														
					$query->the_post();
					$id = get_the_ID();
					$post_options = new RxPostOptions($id);
					$thumbnail_url = $post_options->getFeaturedImage($id, 800, 650);					
					$title = get_the_title($id);					
					
					$out .= '
					<div class="col-md-6 hero_thumb_ui hero_thumb_ui_two_cols">
						<div class="hero_thumb_container"><a href="'.get_permalink($id).'" class="hero_thumb_image_link"><img src="'.$thumbnail_url.'" alt="" /></a></div>
						<div class="rx_hero_hoverui">
							<h3 class="rx_hero_thumb_title">'.$title.'</h3>
							<div class="rx_hero_thumb_underline"></div>
							<p class="rx_hero_excerpt">'.$post_options->get_the_excerpt_max_charlength($post_options->getExcerptTwoCols()).'</p>
							<div class="read_more_ui_bottom">
								<a class="rx_hero_read_more" href="'.get_permalink($id).'">'.$labels['readMoreLB'].'</a>
							</div>							
						</div>						
					</div>
					';					
					
					
					if($groupCount==1){						
						//echo $groupCount." -close row <br />";
						$out .= '</div>';
						$groupCount = -1;
					}					 
				}
				if($groupCount==0){
					//echo $groupCount." -close row final <br />";
					$out .= '</div>';
				}				
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		$out .= '</div>';
		return $out;		
	}


	/* one col shortcode
	================================================== */	
	public function rx_hero_one_col($atts, $content = null){
		extract(shortcode_atts(array('category_slug' => ''), $atts));
		$rx_query = array('post_type' => RX_PORTFOLIO_SLUG, 'posts_per_page' =>'-1');		
		if($category_slug!=''){									 
			 $term = term_exists($category_slug);
			 if ($term == 0 || $term == null) {
			 	echo "The ".$category_slug." does not exist!";
			 	return;
			 }
			 $term_id = $term;
			 if(is_array($term)){
			 	$term_id = $term['term_id'];
			 }
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $term_id
					)
				)
			);
			$rx_query = array_merge($rx_query, $args);			 		
		}
		$labels = PluginOptions::getInstance()->getLabels();
		$out = '<div class="rx_hero_portfolio container-fluid">';			
			$query = new WP_Query($rx_query);
			if($query->have_posts()) {				
				
				while($query->have_posts()){

					$out .= '<div class="row">';
														
					$query->the_post();					
					$id = get_the_ID();
					$post_options = new RxPostOptions($id);
					$thumbnail_url = $post_options->getFeaturedImage($id, 1100, 600, true);					
					$title = get_the_title($id);					
					$out .= '
					<div class="col-md-12 hero_thumb_ui hero_thumb_ui_one_col">
						<div class="hero_thumb_container"><a href="'.get_permalink($id).'" class="hero_thumb_image_link"><img src="'.$thumbnail_url.'" alt="" /></a></div>
						<div class="rx_hero_hoverui_one_col">
							<h2 class="rx_hero_thumb_title_one_col">'.$title.'</h2>
							<div class="rx_hero_thumb_underline"></div>
							<p class="rx_hero_excerpt">'.$post_options->get_the_excerpt_max_charlength($post_options->getExcerptOneCol()).'</p>
							<div class="read_more_ui">
								<a class="rx_hero_read_more" href="'.get_permalink($id).'">'.$labels['readMoreLB'].'</a>
								<div class="rx_clear"></div>
							</div>							
						</div>						
					</div>
					';					
					
					
					$out .= '</div>';					 
				}			
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		$out .= '</div>';
		return $out;		
	}
	
							
		
}

?>