<?php
/**
 * Maranatha Child Theme (Example)
 *
 * Code customizations are best made using a child theme so they are not lost during parent theme updates.
 *
 * See the guides for more information on using a child theme (changing styles, overriding templates, etc.).
 *
 * http://churchthemes.com/guides/developer/child-theming/
 * http://codex.wordpress.org/Child_Themes
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue stylesheets
 */
function maranatha_child_enqueue_styles() {

	// Enqueue parent theme stylesheet
	// It is no longer best practice to use @import in style.css so this is how we do it instead
	wp_enqueue_style( 'maranatha-style', CTFW_THEME_URL . '/style.css', false, CTFW_THEME_VERSION );

	// Enqueue child theme stylesheet
	// The 'maranatha-style' dependency ensures child theme stylesheet loads after parent
	wp_enqueue_style( 'maranatha-child-style', CTFW_THEME_CHILD_URL . '/style.css', array( 'maranatha-style' ), CTFW_THEME_VERSION );

	// You can enqueue more from your child theme here

}

add_action( 'wp_enqueue_scripts', 'maranatha_child_enqueue_styles' ); // front-end only

/**
 * Enqueue JavaScript files
 */
function maranatha_child_enqueue_scripts() {

	// Enqueue child theme JavaScript
	//wp_enqueue_script( 'maranatha-child-script', CTFW_THEME_CHILD_URL . '/new-script.js', false, CTFW_THEME_VERSION );

	// You can enqueue more from your child theme here

}

//add_action( 'wp_enqueue_scripts', 'maranatha_child_enqueue_scripts' ); // front-end only

/**
 * Change theme features, actions, filters, etc.
 *
 * Perform setup on after_setup_theme hook.
 * Default priority is 10 so 11 ensures this to run after the parent theme's setup
 */
function maranatha_child_setup() {

	// Load child theme language file
	// This will cause $locale.mo (e.g. en_US.mo) in the child theme's directory to load.
	// Optionally, it can go in wp-content/languages/themes/maranatha-child-$locale.mo.
	//load_child_theme_textdomain( 'maranatha-child' ); // use your own textdomain

	// Example of removing a function that is hooked
	// remove_action() works similarly
	// add_filter() and add_action() can subsequently be used to replace the hooked function
	//remove_filter( 'body_class', 'maranatha_add_body_classes' ); // extra classes no longer added to <body>
	remove_filter( 'ctfw_sidebar_widget_restrictions', 'maranatha_sidebar_widget_restrictions' );
	remove_filter( 'ctfw_widget_sidebar_restrictions', 'maranatha_widget_sidebar_restrictions' );
	add_filter( 'ctfw_sidebar_widget_restrictions', 'maranatha_child_sidebar_widget_restrictions' );
	add_filter( 'ctfw_widget_sidebar_restrictions', 'maranatha_child_widget_sidebar_restrictions' );

	// Remove support for Events (Church Theme Content plugin)
	// Similarly, you can use add_theme_support to enable features
	//remove_theme_support( 'ctc-events' ); // removes post type, widgets, etc.

	// Remove a widget (Church Theme Framework)
	//remove_theme_support( 'ctfw-widget-events' );

	// Remove a WordPress feature
	//remove_theme_support( 'automatic-feed-links' );

}

add_action( 'after_setup_theme', 'maranatha_child_setup', 11 );
