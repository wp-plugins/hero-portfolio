<?php


/**
 * base class
 */
class RxPluginBase {

	//init handler
	public function initializeHandler(){
		$this->registerShortcodes();
	}
	
	//register shortcodes
	public function registerShortcodes(){}	
	
	//admin init handler
	public function adminInitHandler(){}	

	//save post handler - to be overridden
	public function savePostHandler(){}
	
	//admin enqueue scripts handler
	public function adminEnqueueScriptsHandler(){
		//default styles			
		//default JS
		wp_enqueue_script('jquery');
									
	}	

	//admin menu handler
	public function adminMenuHandler(){}
	
	
	//WP Enqueue scripts handler
	public function WPEnqueueScriptsHandler(){	
		wp_enqueue_script('jquery');
	}	

	public function adminBarCustom(){
		
	}		
	
	//init listeners
	public function start(){
		add_action('init', array($this, 'initializeHandler'));
		add_action('admin_init', array($this, 'adminInitHandler'));
		add_action('save_post', array($this, 'savePostHandler'));		
		add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScriptsHandler'));				
		add_action('admin_menu', array($this, 'adminMenuHandler'));		
		add_action("wp_enqueue_scripts", array($this, 'WPEnqueueScriptsHandler'), 999);	
		add_action("wp_before_admin_bar_render", array($this, 'adminBarCustom')); 					
	}
	
	//add notice
	public function addNotice($notice){
		add_action('admin_notices', $notice);
	}	
	
	
	//remove support
	public function removeSupport($postTypeSlug, $val){
		remove_post_type_support($postTypeSlug, $val);
	}
	
	//add thumb size/support
	public function addThumbSize($w, $h, $postTypes=NULL){
		if(function_exists('add_theme_support')){
			(isset($postTypes))?add_theme_support('post-thumbnails', $postTypes):add_theme_support('post-thumbnails');
	        set_post_thumbnail_size($w, $h, true );			
		}
	}		
}


?>