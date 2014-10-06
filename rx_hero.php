<?php
/*
Plugin Name: Hero - WP Portfolio
Plugin URI: http://sakuraplugins.com/
Description: Hero is a WordPress Plugin that shows your portfolio in an interactive way.
Author: SakuraPlugins
Version: 1.0
Author URI: http://sakuraplugins.com/
*/
define('RX_TEMPPATH', plugins_url('', __FILE__));
define('HR_JS_ADMIN', RX_TEMPPATH.'/com/riaextended/js');
define('RX_JS', RX_TEMPPATH.'/js');
define('HR_CLASS_PATH', plugin_dir_path(__FILE__));
define('RX_PLUGIN_TEXTDOMAIN', 'rx_portfolio');
define('RX_PORTFOLIO_SLUG', 'rx_hero');
define('RX_POST_CUSTOM_META', 'rx_portfolio_post_options');
define('RX_PORTFOLIO_OPTION_GROUP', 'rx_portfolio_option_group');
define('RX_PORTFOLIO_REWRITE', 'portfolio');
define('HERO_FILE', __FILE__);


require_once(HR_CLASS_PATH.'/com/riaextended/php/plugin_core.php');
$plugin_core = new RXPluginCore();
$plugin_core->start(array('addSinglePage'=>true, 'PLUGIN_FILE'=>__FILE__));

//register de-activation handler
register_deactivation_hook(__FILE__, 'rx_plugin_deactivate' );
function rx_plugin_deactivate() {
	flush_rewrite_rules();
}
?>