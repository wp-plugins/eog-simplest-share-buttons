<?php
/*
Plugin Name: EOG Simplest Share Buttons
Description: Shows simple share buttons on blog posts
Author: El Ojo Grafico
Version: 1.2
Author URI: http://elojografico.net
Text Domain: eog-simplestsharebuttons
Domain Path: /lang/
*/

define( 'EOG_SIMPLESTSHAREBUTTONS_FILE', __FILE__ );
define( 'EOG_SIMPLESTSHAREBUTTONS_DIR', plugin_dir_path( __FILE__ ) );
define( 'EOG_SIMPLESTSHAREBUTTONS_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook( EOG_SIMPLESTSHAREBUTTONS_FILE, 'eog_simplestsharebuttons_activate' );
register_deactivation_hook( EOG_SIMPLESTSHAREBUTTONS_FILE, 'eog_simplestsharebuttons_deactivate' );

//////////////////////////
// Include plugin parts //
//////////////////////////
function eog_simplestsharebuttons_load() {
    if ( is_admin() ) { //load admin files only in admin
        require_once( EOG_SIMPLESTSHAREBUTTONS_DIR . 'includes/admin.php' );
    }
    require_once( EOG_SIMPLESTSHAREBUTTONS_DIR . 'includes/core.php' );
}
eog_simplestsharebuttons_load();

///////////////////////
// Load translations //
///////////////////////
function eog_simplestsharebuttons_trans_load() {
    load_plugin_textdomain( 'eog-simplestsharebuttons', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'init', 'eog_simplestsharebuttons_trans_load', 1 );

/////////////////////////////
// De/Activation functions //
/////////////////////////////
function eog_simplestsharebuttons_activate() {
    $opciones = array(
        'show_fb' => '1',
        'show_tw' => '1',
        'show_gp' => '1',
        'show_wa' => '1',
        'position' => '1',
        'size' => '1',
        'alignment' => 'left',
        'shape' => 'circle',
        'animation' => '',
        'atenuation' => '1',
        'filling' => 'color',
        'shownames' => '1',
    );
    update_option( 'eog_ssb_settings', $opciones );
}

function eog_simplestsharebuttons_deactivate() {
    delete_option( 'eog_ssb_settings' );
}
