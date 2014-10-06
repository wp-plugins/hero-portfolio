					    <!--==============================================================================-->
					    <!--GENERAL STYLE TAB-->
					    <!--==============================================================================-->
					    <div id="general_opts">
					    	<h3>General options</h3>				    				    						    	
					    	<div class="hline"></div>					    	
					    	<div class="spacer20"></div>
	    	
					    	<!--related projects-->				    					    				    					    						    
					    	<div class="optionBox">
						    	<h4>Related projects</h4>
						    	<p>Show related projects within single pages.</p>
						    	<div class="hline"></div>
						    	<div class="spacer10"></div>
						    	<p class="sk_notice"><strong>NOTE!</strong> In order Related Projects to work you need to assign tags to projects.</p>					    						    							    	
						    	<div>
						    		<?php
									$showRelated = (isset($options['showRelated']))?$options['showRelated']:'';
									$showRelatedChecked = ($showRelated=="ON")?'checked':'';
									$relatedProjectsMaxNo = (isset($options['relatedProjectsMaxNo']))?$options['relatedProjectsMaxNo']:'3';						    		
						    		?>
									<label class="checkbox">
									  <input type="checkbox" name="<?php echo $this->getOptionGroup();?>[showRelated]" value="ON" <?php echo $showRelatedChecked;?>>Show related projects (On/Off)
									</label>
									<div class="spacer20"></div>
									<p>Max number of related projects</p>
									<input style="height: 30px;" class="smallInputText" type="text" name="<?php echo $this->getOptionGroup()?>[relatedProjectsMaxNo]" value="<?php echo $relatedProjectsMaxNo;?>" />						    						    		
						    	</div>
					    	</div>
					    	<!--/related projects-->					    						    	
					    	
					    	<div class="spacer20"></div>
					    	
					    	
					    	<!--labels-->				    					    				    					    						    
					    	<div class="optionBox">
						    	<h4>Labels</h4>
						    	<p>Labels used within plugin's front-end.</p>
						    	<div class="hline"></div>
						    	<div class="spacer10"></div>						    						    						    							    	
						    	<div>
						    		<?php
										$readMoreLB = (isset($options['readMoreLB']))?$options['readMoreLB']:'Read more';
										$nextLB = (isset($options['nextLB']))?$options['nextLB']:'Next';
										$prevLB = (isset($options['prevLB']))?$options['prevLB']:'Previous';
										$relatedLB = (isset($options['relatedLB']))?$options['relatedLB']:'Related projects';																										    		
						    		?>
									<p>Read more</p>
									<input style="height: 30px;" class="smallInputText" type="text" name="<?php echo $this->getOptionGroup()?>[readMoreLB]" value="<?php echo $readMoreLB;?>" />
									<p>Next</p>
									<input style="height: 30px;" class="smallInputText" type="text" name="<?php echo $this->getOptionGroup()?>[nextLB]" value="<?php echo $nextLB;?>" />
									<p>Previous</p>
									<input style="height: 30px;" class="smallInputText" type="text" name="<?php echo $this->getOptionGroup()?>[prevLB]" value="<?php echo $prevLB;?>" />
									<p>Related projects</p>
									<input style="height: 30px;" class="smallInputText" type="text" name="<?php echo $this->getOptionGroup()?>[relatedLB]" value="<?php echo $relatedLB;?>" />																																	    						    		
									<div class="sk_clear_fx" style="clear: both;"></div>
						    	</div>
					    	</div>
					    	<!--/labels-->


					    	
					    	<div class="spacer20"></div>
					    	
					    	<!--styles-->				    					    				    					    						    
					    	<div class="optionBox">
						    	<h4>Look and feel</h4>
						    	<p>Choose colors.</p>
						    	<div class="hline"></div>
						    	<div class="spacer10"></div>
						    	<p class="sk_notice"><strong>NOTE!</strong> You can style this plugin further by editing it's CSS located at "css/rx_portfolio.css".</p>						    						    						    							    	
						    	<div>
						    		<?php		
						    			$overlayBackCol = (isset($options['overlayBackCol']))?$options['overlayBackCol']:'283d53';						
										$overlayTitleCol = (isset($options['overlayTitleCol']))?$options['overlayTitleCol']:'F2F2F2';
										$overlayExcerptCol = (isset($options['overlayExcerptCol']))?$options['overlayExcerptCol']:'d43f5d';
										$overlayButtonCol = (isset($options['overlayButtonCol']))?$options['overlayButtonCol']:'F2F2F2';
										$overlayButtonBackground = (isset($options['overlayButtonBackground']))?$options['overlayButtonBackground']:'df4564';																											    		
						    		?>	
									<p>Overlay background color</p>
									<input id="overlayBackCol" style="height: 30px; width: 100px;" type="text" name="<?php echo $this->getOptionGroup()?>[overlayBackCol]" value="<?php echo $overlayBackCol;?>" />
									<p>Overlay title color</p>
									<input id="overlayTitleCol" style="height: 30px; width: 100px;" type="text" name="<?php echo $this->getOptionGroup()?>[overlayTitleCol]" value="<?php echo $overlayTitleCol;?>" />
									<p>Overlay excerpt color</p>
									<input id="overlayExcerptCol" style="height: 30px; width: 100px;" type="text" name="<?php echo $this->getOptionGroup()?>[overlayExcerptCol]" value="<?php echo $overlayExcerptCol;?>" />
									<p>Overlay button color</p>
									<input id="overlayButtonCol" style="height: 30px; width: 100px;" type="text" name="<?php echo $this->getOptionGroup()?>[overlayButtonCol]" value="<?php echo $overlayButtonCol;?>" />
									<p>Overlay button background color</p>
									<input id="overlayButtonBackground" style="height: 30px; width: 100px;" type="text" name="<?php echo $this->getOptionGroup()?>[overlayButtonBackground]" value="<?php echo $overlayButtonBackground;?>" />									
							    		<p>
							    			<button id="resetRxColorsBTN" class="btn" type="button">Reset to default</button>
							    		</p>																																										    																																		    						    		
						    	</div>
					    	</div>
					    	<!--/styles-->					    						    	
					    	
					    	<div class="spacer20"></div>
					    	
					    	<!--shortcodes-->				    					    				    					    						    
					    	<div class="optionBox">
						    	<h4>Shortcodes</h4>
						    	<p>Available shortcodes.</p>
						    	<div class="hline"></div>
						    	<div class="spacer10"></div>						    							    						    						    							    	
						    	<div>
						    		<p><span class="shortcode_showcase">[rx_hero_three_cols]</span>-Displays all portfolio as three columns.</p>
						    		<p><span class="shortcode_showcase">[rx_hero_two_cols]</span>-Displays all portfolio as two columns.</p>
						    		<p><span class="shortcode_showcase">[rx_hero_one_col]</span>-Displays all portfolio as one column.</p>
						    		<p class="sk_notice"><strong>NOTE!</strong> For each of the abobe shortcodes you can also display only one category by adding the category slug.</p>
						    		<p><span class="shortcode_showcase">[rx_hero_three_cols category_slug="web-design"]</span>Replace "web-design" with your own category slug.</p>
						    		<p><span class="shortcode_showcase">[rx_hero_two_cols category_slug="web-design"]</span>Replace "web-design" with your own category slug.</p>
						    		<p><span class="shortcode_showcase">[rx_hero_one_col category_slug="web-design"]</span>Replace "web-design" with your own category slug.</p>
						    		<p class="sk_notice"><strong>NOTE!</strong> In order to be able to display portfolio by category, first create categories, assign projects to at least one category. You can get the category slug by going to 
						    			Admin > Hero Portfolio > Categories > right panel > slug column</p>																																    																																		    						    		
						    	</div>
					    	</div>
					    	<!--/shortcodes-->					    						    	
					    	
					    	<div class="spacer20"></div>					    						    						    						    	
					    	
					    						    						    						    
					    </div>
					    <!--/GENERAL STYLE TAB-->