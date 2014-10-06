<?php
/**
 * rx single page template
 */
get_header(); ?>
<?php
require_once(HR_CLASS_PATH.'/com/riaextended/php/rx_plugin_options.php');
require_once(HR_CLASS_PATH.'/com/riaextended/php/rx_post_options.php');
$post_options = new RxPostOptions($post->ID);
$post_settings = $post_options->getPostSettings();
$isFeaturedVideo = $post_settings['isFeaturedVideo'];
$featuredImages = $post_options->getFeaturedImages(1250, $post_settings['post_images_height']);

$related_proj_settings = PluginOptions::getInstance()->getRelatedSettings();
$showRelated = $related_proj_settings['showRelated'];
$relatedProjectsMaxNo = $related_proj_settings['relatedProjectsMaxNo'];

$labels = PluginOptions::getInstance()->getLabels();

?>

<div id="rx_content" class="container">
	<div class="rx_nav">
	 	<p class="alignright nextPost"><?php next_post_link('%link', $labels['nextLB'].' »');?></p>
	 	<p class="alignright previousPost"><?php previous_post_link('%link', '« '.$labels['prevLB']);?></p>	 	
	</div>
	<div class="rx_clear"></div>
	
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	
	<?php if($featuredImages || $isFeaturedVideo):?>
		<div class="single_top_space"></div>		
		<!--featured-->
		<div class="row">
			<div class="col-md-12">				
					<div class="rx_featured_ui">
						<?php if(($featuredImages)&&!$isFeaturedVideo):?>
						<?php
							echo $post_options->getBootstrapCarouselNew($featuredImages, 800);												
						?>										
						<?php endif; ?>
						<?php if($isFeaturedVideo):?>
						<?php												
							echo $post_options->getVideoCode();																		
						?>										
						<?php endif; ?>											
					</div>				
			</div>
		</div>
		<!--/featured-->
	<?php endif;?>
		
		<!--the title-->
		<div class="row">
			<div class="col-md-12">
				<h2 class="rx_single_page_title"><?php echo get_the_title($post->ID);?></h2>			
			</div>
		</div>
		<!--/the title-->		
		
		<!--the content-->
		<div class="row">
			<div class="col-md-12">
				<div class="rx_post_content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content();?>
				</div>

				<!--related projects-->
				<div class="rx_related_projects">
				<?php
				$showRelatedPosts = false;
				if($showRelated){
					
				 	$terms = get_the_terms($post->ID , 'portfolio_categories', 'string');
				 	if(is_array($terms)){
				 		
						$term_ids = wp_list_pluck($terms,'term_id');
						if(is_array($term_ids)){
							$comma_separated_ids = implode(",", $term_ids);
							$ids = explode(',', $comma_separated_ids);						
						}
																			
						
						if(isset($ids)){
								$posts_array = get_posts(array('numberposts'=>$relatedProjectsMaxNo, 'post_type'=>RX_PORTFOLIO_SLUG, 'post_status'=>'publish',
								'exclude'=>get_the_ID(), 'tax_query'=>array(
										'relation'=>'AND',
										array('taxonomy'=>'portfolio_categories',
										'field'=>'id',
										'terms'=>$ids									
										)
									)
								));													
						}										
						if(is_array($posts_array)){								
							if(sizeof($posts_array)>0){
								$showRelatedPosts = true;
							}
						}
				 		
				 	}
				}								
				?>
				<?php if($showRelatedPosts):?>
					<h2 class="rx_related_projects_title"><?php echo $labels['relatedLB'];?></h2>
					<div class="rx_related_underline"></div>	
								<?php
								require_once(HR_CLASS_PATH.'/com/riaextended/php/libs/rx__resizer.php');
								global $post;
								$out = '';
								$groupCount = -1;				
								foreach($posts_array as $post ) :	setup_postdata($post); ?>																									
								<?php
									$groupCount++;
									if($groupCount==0){
										$out .= '<div class="row">';						
										//echo $groupCount." -open row <br />";
									}																	
																		
									$p_thumb = $post_options->getFeaturedImage($post->ID, 800, 500);									
									$permalink = get_permalink($post->ID);
									$r_title = get_the_title($post->ID);
									$out .= '
									<div class="col-md-4">
										<div class="rx_related_project">
											<a href="'.$permalink.'" class="hero_thumb_image_link"><img src="'.$p_thumb.'" alt="" /></a>
											<div class="rx_related_overlay" data-url="'.$permalink.'">
												<div class="rx_related_cross"><img src="'.RX_TEMPPATH.'/images/cross.png'.'" alt="" /></div>
												<h3 class="rx_related_title">'.$r_title.'</h3>												
											</div>											
										</div>
									</div>
									';
									if($groupCount==2){						
										//echo $groupCount." -close row <br />";
										$out .= '</div>';
										$groupCount = -1;
									}																	
								?>																
								<?php endforeach; ?>			
								<?php
								if($groupCount==0 || $groupCount==1){
									//echo $groupCount." -close row final <br />";
									$out .= '</div>';
								}
								echo $out;								
								?>			
				<?php endif;?>				
				</div>				
				<!--related projects-->
				
				<!--comments template-->
				<div>
					<?php comments_template( '', true ); ?>
				</div>
				<!--/comments template-->				
							
			</div>
		</div>
		<!--/the content-->

	<?php endwhile; else: ?>
	<p><?php _e('No posts were found. Sorry!', 'default_textdomain'); ?></p>
	<?php endif; wp_reset_query();?>	
	
</div>



<?php get_footer(); ?>