<?php 
/*
* Plugin Name: GeoCMSx Geo Mashup Add-on
* Plugin URI:  http://andrewgunn.xyz/geocmsx
* Version:     1.0.0
* Description: A fully loaded interactive geo map maker with functionality to allow users to submit geo located trail story and condition posts, require email to download trail itinerary documents, and custom pins and features tailored interactive trail maps.
* Author:      Andrew M. Gunn
* Author URI:  http://andrewgunn.xyz/
* License:     GNU General Public License (Version 2 - GPLv2)
* Text Domain: geocmsx-addon
*/
if ( ! defined( 'ABSPATH' ) ) die( 'No way, jose!' );

require_once( 'geo-mashup-trail-story/geo-mashup-trail-story.php' );
require_once( 'geo-mashup-custom/geo-mashup-custom.php' );

register_activation_hook( __FILE__, 'gsx_require_geomashup') ;

function gsx_require_geomashup() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'geo-mashup/geo-mashup.php' ) ) {
        add_action( 'admin_notices', 'gsx_add_on_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    } else {
    	flush_rewrite_rules();
    }
}
function gsx_add_on_plugin_notice() {
	echo '<div class="error"><p><strong>Geo Mashup</strong> must be installed and activated to use this plugin!</p></div>';
}

