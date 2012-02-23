<?php

/*
* Plugin Name: Enhanced Image Gallery
* Author: Atlanta WordPress DEV meetup guys (and lady)
description: An enhanced WordPress gallery that is responsive 
* Version: 0.0.1
*/

/*set up our constants*/
define('EIG_VER', '001');
define('EIG_TRANS_VER', '001');
define('EIG_DIR', WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
define('EIG_URL', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
define('EIG_LIB_DIR', EIG_DIR.'/lib');
define('EIG_JS_URL', EIG_URL.'/lib/js');
define('EIG_CSS_URL', EIG_URL.'/lib/css');

class EIG_Start {

	function EIG_Start()
	{
		$this->__construct();
	} // end EIG_Start
	
	function __construct()
	{
		// new EID_Helper_Start // the helper class? 
		add_action( 'admin_init', array( &$this, '_admin_init' ) );
		add_action( 'init', array( &$this, '_init' ) );
		add_action( 'init', array( &$this, '_register_js' ) );
		add_action( 'init', array( &$this, '_register_css' ) );
                add_action('wp_print_styles', array( &$this, '_print_css' ) );
                add_action('wp_print_scripts', array( &$this, '_print_js' ) ); 
                add_action('wp_ajax_nopriv_eig', array( &$this, '_setup_ajax')); // drew
                add_action('wp_ajax_eig', array( &$this, '_setup_ajax')); // drew
                add_action('template_redirect', array (&$this, '_template_redirect'));

	} // end __construct
	
	function _init()
	{	
		require_once (EIG_LIB_DIR . '/post-type-loader.php');/*get our custom post types by mike s*/ 
		require_once (EIG_LIB_DIR . '/widgets.php');/*get our custom widgets*/ 
		require_once (EIG_LIB_DIR . '/shortcodes.php');/*get our short-codes functions*/ 
		
	} // end EIG_init

	function _admin_init()
	{
		require_once(EIG_LIB_DIR . '/metaboxes.php');/*get our meta boxes functions*/ 
	} // end EIG_admin_init
	
	function _register_js()
	{
		wp_register_script( 'eig-js', EIG_JS_URL . '/eig.js', array('jquery'), EIG_VER , true );
	} // end js_setup
	
        function _register_css()
	{
		wp_register_style('eig-css', EIG_CSS_URL.'/eig.css', '', EIG_VER, 'all');
        } // end css_setup
        
        function _print_js()
	{
                if ( !is_admin() ) :
                   wp_enqueue_script('eig-js');
                endif;    
	} // end js_setup
	
        function _print_css()
	{
		if ( !is_admin() ) :
                  wp_enqueue_style('eig-css');
                endif;
	} // end css_setup
                function _setup_ajax()
	{
		die;
	} // end css_setup
        function _template_redirect() {
          return;
        } // end template_redirect
		
} // end EIG_Start

new EIG_Start();
