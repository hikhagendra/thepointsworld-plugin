<?php
/*
 * Plugin Name:       Custom LMS
 * Plugin URI:        https://khagendralama.com.np
 * Description:       Custom LMS for The Points World
 * Version:           1.0.0
 * Author:            Khagendra Lama
 * Author URI:        https://khagendralama.com.np
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       thepointsworld
 */

defined( 'ABSPATH' ) || exit;

include_once WP_PLUGIN_DIR . '/custom-lms/inc/cpt.php';
include_once WP_PLUGIN_DIR . '/custom-lms/inc/woo-integrate.php';

// Constants
define('TEXTDOMAIN', 'thepointsworld');
define('LMS_VERSION', '1.0.0');

// Enqueue styles and scripts
function lms_admin_style_script() {
    wp_enqueue_style('lms-css', plugin_dir_url(__FILE__) . '/assets/css/custom-style.css', array(), LMS_VERSION, 'all');
}
add_action('admin_enqueue_scripts', 'lms_admin_style_script');
