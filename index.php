<?php
ob_start();
/**
 * Plugin Name: Inline Text Popup
 * Plugin URI: http://webplanetsoft.com/wordpress-plugins/wps-inline-text-popup.zip
 * Description: Inline Text Popup (Add popup in post and page)
 * Version: 1.0.0
 * Author: Web Planet Soft
 * Author URI:  http://webplanetsoft.com
 */

 
if ( ! defined( 'ABSPATH' ) ) {
	die("You can't access this file directly"); // disable direct access
} 

class WPS_INLINE_TEXT_POPUP
{		
	public function __construct()
	{
		global $wpdb;
		$this->aParams = $this->aPopups = array();
		
		add_filter('mce_external_plugins', array($this, 'wps_add_external_mce_plugins'));
		add_filter('mce_buttons', array($this, 'wps_add_external_mce_buttons'));
		add_action('wp_footer',array($this, 'wps_inline_text_popup_scripts'));		
		add_action('get_footer',array($this, 'wps_inline_text_popup_footer'));		
		add_shortcode('wpsInlinePopup',array($this, 'wps_inline_text_popup_shortcode'));

	}
	
	public function wps_inline_text_popup_scripts()
	{ 
		wp_enqueue_script('wps-footer-inline-popup-script', plugins_url( 'src/function.js', __FILE__) );
		wp_enqueue_style('wps-footer-inline-popup-style', plugins_url( 'src/style.css', __FILE__ ));
	}
	
	public function wps_inline_text_popup_shortcode($aParams = array(),$aContent = '')
	{	
		$aParams['shortcode_content'] = $aContent;
		$this->aPopups[] = $aParams;		
		$aBtn = '<a href="javascript:void(0);" onclick="wpsOpenModalPopup('.$aParams['popup_id'].');">'.$aParams['shortcode_content'].'</a>';	
		return $aBtn;		
	}
	
	public function wps_inline_text_popup_footer()
	{	
		ob_start();			
		include "popup.php";
		return ob_get_contents();
		ob_get_clean();
	}

	public function wps_add_external_mce_plugins($aExternalPlugins)
	{  
		if ((current_user_can('edit_posts') || current_user_can('edit_pages')) && get_user_option('rich_editing'))
		{
			$aExternalPlugins['wpsInlineTextPopupTinyMcePlugin'] = plugins_url('src/function.js', __FILE__);
			return $aExternalPlugins;	  
		}	
	} 
	
	public function wps_add_external_mce_buttons($aButtons) 
	{
		if ((current_user_can('edit_posts') || current_user_can('edit_pages')) && get_user_option('rich_editing'))
		{
			$nButtons = array('wpsInlineTextPopupButton');
			array_splice($aButtons, 16, 0, $nButtons);
			return $aButtons;
		}	
	}
}

$wpsObj = new WPS_INLINE_TEXT_POPUP;

