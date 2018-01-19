<?php
/**
 * Enable Numeric Slugs 
 *
 * Enable Numeric Slugs plugin fixes postname(slug) can not be a 4 digit number issue on wordpress 4.9.1. As a matter of fact, its not a bug, wordpress reserve 4 digit number in url for yearly archive. I just simply remove the rewrite rules stored in MySql. If you want to reset to orignal rewrite rules, go to Permalink Settings and Save Changes. That's it..

 * @package   Enable Numeric Slugs
 * @author    Mr.ING <ayangyuan@gmail.com>
 * @license   GPL-2.0+
 * @link      https://squaredaway.studio/wordpress-plugin-enable-numeric-slugs/
 * @copyright 1999-2018 
 *
 * @wordpress-plugin
 * Plugin Name: Enable Numeric Slugs
 * Plugin URI:  https://wordpress.org/plugins/enable-numeric-slugs/
 * GitHub URI:  https://github.com/ayangyuan/Wordpress-Plugin-Enable-Numeric-Slugs
 * Author URI:  https://squaredaway.studio/wordpress-plugin-enable-numeric-slugs/
 * Author:      Mr.ING 
 * Version:     1.0.1
 * Text Domain: enable-numeric-slugs
 * Domain Path: /res/lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Description: Display the current memory usage bar on admin header.
 */

// Force a flush of the rewrite rules when this plugin is activated
function allow_numeric_slugs_activate() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

register_activation_hook(__FILE__, 'allow_numeric_slugs_activate');
function Enable_Numberic_Slug($rules){
    foreach ($rules as $rule => $rewrite) {
        if ( preg_match('/\{4\}/',$rule) ) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}
add_filter('rewrite_rules_array', 'Enable_Numberic_Slug');


/** Add links to the plugin action row. */
//if ( ! defined( 'MR_ING_ENS_PLUGIN_FILE' ) ) {define( 'MR_ING_ENS_PLUGIN_FILE', __FILE__ );}
if (!function_exists('mr_ing_plugin_row_meta')) {
function mr_ing_plugin_row_meta( $links, $file ) {
  //if ( plugin_basename( MR_ING_ENS_PLUGIN_FILE ) === $file ) {
  if ( plugin_basename( __FILE__ ) === $file ) {
    $new_links = array(
    'support'    => '<a href = "http://wordpress.org/support/plugin/enable_numeric_slugs">' . __( 'Support' ) . '</a>',
    'donate'     => '<a href = "https://squaredaway.studio/donate/">' . __( 'Donate') . '</a>',
    'contribute' => '<a href = "https://github.com/ayangyuan/Wordpress-Plugin-Enable-Numeric-Slugs">' . __( 'Contribute' ) . '</a>',
     );
     $links = array_merge( $links, $new_links );
   }
   return $links;
}
}
add_filter( 'plugin_row_meta', 'mr_ing_plugin_row_meta', 10, 2 );

