<?php
require_once(HR_CLASS_PATH.'com/riaextended/php/plugin_base.php');
require_once(HR_CLASS_PATH.'com/riaextended/php/customposts/utils/CPTHelper.php');
require_once(HR_CLASS_PATH.'com/riaextended/php/customposts/RxCPT.php');
require_once(HR_CLASS_PATH.'com/riaextended/php/RxShortcodes.php');
require_once(HR_CLASS_PATH.'com/riaextended/php/script_manager/ScriptManager.php');
require_once(HR_CLASS_PATH.'com/riaextended/php/admin_pages/rx_option_page.php');
require_once(HR_CLASS_PATH.'/com/riaextended/php/rx_plugin_options.php');
/**
 * Wrapper
 */
class RXPluginCore extends RxPluginBase {
	
	//fire up 
	public function start($options=null)
	{	
		parent::start();				
		add_filter('excerpt_more', array($this, 'rx_excerpt_more'));
		if(isset($options['addSinglePage'])){
			add_filter("single_template", array($this, 'rx_plugin_single'));
		}
		register_activation_hook($options['PLUGIN_FILE'], array($this, 'rx_activate_plugin') );		
	}

	//admin bar custom
	public function adminBarCustom(){
		if(function_exists('get_current_screen')){
			$current_screen = get_current_screen();		
			if($current_screen->post_type==$this->rxCPT->getPostSlug()){			
				require_once(HR_CLASS_PATH.'com/riaextended/php/admin_pages/gravity-banner.php');
			}
		}
	}	
	
	
	//plugin activation
	public function rx_activate_plugin(){
		if(version_compare(get_bloginfo('version'), '3.5', '<' )){
			deactivate_plugins(basename( __FILE__ ));
		}else{
			try{		
				$this->addCPT();
				flush_rewrite_rules();
			}catch(Exception $e){}
		}		
	}
	
	//read more link - override
	public function rx_excerpt_more($val) {
	       global $post;		   
		   $p_type = get_post_type($post);
		   if($p_type==RX_PORTFOLIO_SLUG){
		   		$val = '...';
		   }	   
		return $val;
	}
	
	//rx single template
	public function rx_plugin_single($single_template){
		global $post;		
		if($post->post_type==RX_PORTFOLIO_SLUG){
			$single_template = dirname( __FILE__ ) . '/rx_hero-template.php';						
		}
		return $single_template;
	}		
	
	//init handler - override 
	public function initializeHandler(){				
		parent::initializeHandler();	
		$this->addCPT();	
		$this->addTaxonomy();						
	}
	
	//add taxonomy
	private function addTaxonomy(){
		//portfolio taxonomy
		if(isset($this->rxCPT)){
			register_taxonomy('portfolio_categories', $this->rxCPT->getPostSlug(), array('label'=>'Portfolio Categories', 'hierarchical'=>true));
		}				
	}		
	
	private $rxCPT;
	/*
	 * create youtube CPT
	 */
	public function addCPT(){
		$settings = array('post_custom_meta_data'=>RX_POST_CUSTOM_META, 'post_type' => RX_PORTFOLIO_SLUG, 'name' => __('Hero Portfolio', RX_PLUGIN_TEXTDOMAIN), 'menu_icon' => RX_TEMPPATH.'/com/riaextended/images/icons/camera-black.png',
		'singular_name' => __('Hero Portfolio', RX_PLUGIN_TEXTDOMAIN), 'rewrite' => RX_PORTFOLIO_REWRITE, 'add_new' => __('Add new', RX_PLUGIN_TEXTDOMAIN),
		'edit_item' => __('Edit', RX_PLUGIN_TEXTDOMAIN), 'new_item' => __('New', RX_PLUGIN_TEXTDOMAIN), 'view_item' => __('View item', RX_PLUGIN_TEXTDOMAIN), 'search_items' => __('Search items', RX_PLUGIN_TEXTDOMAIN),
		'not_found' => __('No item found', RX_PLUGIN_TEXTDOMAIN), 'not_found_in_trash' => __('Item not found in trash', RX_PLUGIN_TEXTDOMAIN), 
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'));
		
		$cptHelper = new HRCPTHelper($settings);
		$this->rxCPT = new RxCPT();
		$this->rxCPT->create($cptHelper, $settings);		
	}
	
	//admin init handler - override 
	public function adminInitHandler(){
		//add meta boxes pages
		$this->rxCPT->addMetaBox(__('Excerpt options', RX_PLUGIN_TEXTDOMAIN), 'meta_box_subtitle_id_023648', 'meta_box_subtitle');
		$this->rxCPT->addMetaBox(__('Featured images', RX_PLUGIN_TEXTDOMAIN), 'meta_box_images_id_21783', 'meta_box_images');
		$this->rxCPT->addMetaBox(__('Featured video', RX_PLUGIN_TEXTDOMAIN), 'meta_box_video_id_8249', 'meta_box_video');							
	}

	//add submenu page
	public function adminMenuHandler(){
		$rx_options_page = new RXOptionPage(RX_PORTFOLIO_OPTION_GROUP);
		add_submenu_page( 'edit.php?post_type='.RX_PORTFOLIO_SLUG, 'Hero settings', 'Hero settings', 'manage_options', 'rx_portfolio_sett', array($rx_options_page, 'settings_page'));		 
	}

	
	
	//admin enqueue scripts handler - override 
	public function adminEnqueueScriptsHandler(){
		parent::adminEnqueueScriptsHandler();
		$screenID = get_current_screen()->id;		
		wp_register_style('sk-banner', RX_TEMPPATH.'/com/riaextended/css/banner.css');
		wp_enqueue_style('sk-banner');	

		if($screenID==RX_PORTFOLIO_SLUG){
			HRScriptManager::enqueColorPicker();
			HRScriptManager::enqueJqueryUI();
			HRScriptManager::enqueTweenmax();
			wp_register_script( 'portfolio_options_script', HR_JS_ADMIN.'/rx_portfolio_admin.js', array('jquery'));			 
			wp_enqueue_script('portfolio_options_script');			
			wp_enqueue_media();	
			wp_register_style('sk_admin-style', RX_TEMPPATH.'/com/riaextended/css/rx_admin.css');
			wp_enqueue_style('sk_admin-style');									
		}
		if($screenID==RX_PORTFOLIO_SLUG.'_page_rx_portfolio_sett'){
			wp_register_style('rx_admin_bootstrap', RX_TEMPPATH.'/com/riaextended/bootstrap/css/bootstrap.min.css');				 
			wp_enqueue_style('rx_admin_bootstrap');				
			wp_register_script('rx_admin_bootstrap_js', RX_TEMPPATH.'/com/riaextended/bootstrap/js/bootstrap.min.js', array('jquery'));
			wp_enqueue_script('rx_admin_bootstrap_js');			
			
			wp_register_script('rx_options_page_script', RX_TEMPPATH.'/com/riaextended/js'.'/admin_pages/rx_options.js');
			wp_enqueue_script('rx_options_page_script');
			HRScriptManager::enqueColorPicker();
			wp_register_style('rx_admin-options', RX_TEMPPATH.'/com/riaextended/css/admin_options.css');
			wp_enqueue_style('rx_admin-options');
		wp_register_style('sk_admin-style', RX_TEMPPATH.'/com/riaextended/css/rx_admin.css');
		wp_enqueue_style('sk_admin-style');							
			//$this->enqueueThickbox();			
		}		
	}
	
		

	//WP Enqueue scripts handler
	public function WPEnqueueScriptsHandler(){
		parent::WPEnqueueScriptsHandler();
		HRScriptManager::enqueTweenmax();
		wp_register_style('rx-bootstrap-light', RX_TEMPPATH.'/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('rx-bootstrap-light');	
		wp_register_script('rx-bootstrap-js', RX_TEMPPATH.'/bootstrap/js/bootstrap.min.js', array('jquery'));			 
		wp_enqueue_script('rx-bootstrap-js');

		wp_register_style('rx-hero-portfolio', RX_TEMPPATH.'/css/rx_portfolio.css');
		wp_enqueue_style('rx-hero-portfolio');					
		wp_register_script('rx-hero-js', RX_TEMPPATH.'/js/rx_hero.js', array('jquery'));			 
		wp_enqueue_script('rx-hero-js');
		
		$custom_css = PluginOptions::getInstance()->getCustomCSS();
		wp_add_inline_style('rx-hero-portfolio', $custom_css);
		
		if(is_singular($this->rxCPT->getPostSlug())){
			wp_register_script('rx_fluidvids', RX_TEMPPATH.'/js/external/fluidvids.min.js', array('jquery'), null, TRUE);
			wp_enqueue_script('rx_fluidvids');			
			wp_register_script('rx-hero-page', RX_TEMPPATH.'/js/rx_hero_page.js', array('jquery'));			 
			wp_enqueue_script('rx-hero-page');
		}																									
	}
	/**
	 * SAVE POST EXTRA DATA
	 */
	 public function savePostHandler(){
		global $post;						
		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
			return $post_id;
		}
		if(!current_user_can('edit_posts') || !current_user_can('publish_posts')){
			return;
		}
			//save portfolio data
		if(isset($this->rxCPT) && isset($_POST['post_type'])){
			if($this->rxCPT->getPostSlug() == $_POST['post_type']){									
				if(current_user_can( 'edit_posts', $post->ID ) && isset($_POST[$this->rxCPT->getPostCustomMeta()])){							
					update_post_meta($post->ID, $this->rxCPT->getPostCustomMeta(), $_POST[$this->rxCPT->getPostCustomMeta()]);
				}		 
			}						
		}				
												
	 }


	/*
	 * register shortcodes 
	 */ 
	public function registerShortcodes(){			
		$shorcodesHelper = new HRShortcodes();
		$shorcodesHelper->registerShortcodes();	
	}
			
	
		
}


?>