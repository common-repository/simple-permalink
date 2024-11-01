<?php

/*
Plugin Name: Simple Permalink
Description: A plugin that let you insert URL or permalink into posts or pages.
Version: 1.0.0
Author: wolfofw
*/




class SimplePermalink {

	public function __construct(){
	
		register_deactivation_hook( __FILE__, array( &$this, 'SimplePermalink_deactivate' ) );
		register_uninstall_hook( __FILE__, array( &$this, 'SimplePermalink_uninstall' ) );
		register_activation_hook( __FILE__, array( &$this, 'SimplePermalink_activate' ) );
	}


	function SimplePermalink_activate(){
	}


	function SimplePermalink_deactivate(){
	
	}


	function SimplePermalink_uninstall(){
	
	}
	
	function SimplePermalink_show_permalink($atts, $content = null){
		$atts = shortcode_atts(array('id' => '0', 'title' => '', 'hyperlink' => 'true'), $atts);
		$id = $atts['id'];
		$title = $atts['title'];
		$showAsHyperlink = $atts['hyperlink'];
		$permalink = $id == 0 ? get_bloginfo( 'home' ) : get_permalink( $id );
		if ($showAsHyperlink && $showAsHyperlink != 'false'){
			if (!$title){
				$title = $id == 0 ? get_bloginfo( 'name' ) : get_the_title ( $id );
			}
			return '<a href="'.$permalink.'">'.esc_html( $title ).'</a>';
		}
		return $permalink;
	}
}

$Simple_permalink = new SimplePermalink();
add_shortcode( 'SimplePermalink', array(&$Simple_permalink, 'SimplePermalink_show_permalink') );