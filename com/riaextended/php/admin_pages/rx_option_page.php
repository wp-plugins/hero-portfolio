<?php

/**
 *  generic settings
 */
class RX_GenericSettingsPage{
	
	private $optionsGroup;
	function __construct($optsGroup) {
		$this->optionsGroup = $optsGroup;
		add_action('admin_init', array($this, 'registerSettingsGroups'));
	}
	
	//register settings group
	public function registerSettingsGroups(){
		register_setting($this->optionsGroup, $this->optionsGroup);
	}	
	
	//get option group
	protected function getOptionGroup(){
		return $this->optionsGroup;
	}	
}


/**
 * RXOptionPage
 */
class RXOptionPage extends RX_GenericSettingsPage {
	
	public function settings_page(){
		$options = get_option($this->getOptionGroup());							
		?>
		<div class="spacer10"></div>
		<form method="post" action="options.php">
			<?php settings_fields($this->getOptionGroup()); ?>				
		  
		  <!--options wrapper-->
		  <div id="optionsWrapper">	
		        <div>
		            <h1>Hero Settings</h1>
		        </div>
        		  									
				<p class="submit">
					<input type="submit" class="button-primary pull-right" value="<?php _e('Save Changes', RX_PLUGIN_TEXTDOMAIN) ?>" />
		        </p>
		        <div class="clearfix spacer10"></div>		        
		        
			    <div class="">
					    					    
					    <?php
					    	//general style tab
					    	require_once(HR_CLASS_PATH.'/com/riaextended/php/admin_pages/settings_pages/general_options.php');					    																																																																
					    ?>
				    </div>
				    <!--/tabs content-->
			    
    
	        
		        
				<p class="submit">
					<input type="submit" class="button-primary pull-right" value="<?php _e('Save Changes', RX_PLUGIN_TEXTDOMAIN) ?>" />
		        </p>		        
		        
	      </div>
	      <!--options wrapper-->
		</form>		
		
		<?php
	}

}


?>