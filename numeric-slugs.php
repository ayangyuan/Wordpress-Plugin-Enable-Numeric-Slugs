<?php

/*
Plugin Name: Enable Numeric Slugs
Plugin URI: http://wordpress.org/plugins/enable-numeric-slugs/
Description: Fix postname(slug) can not be a 4 digit number issue on wordpress 4.9.1. As a matter of fact, its not a bug, wordpress reserve 4 digit number in url for yearly archive. I just simply remove the rewrite rules stored in MySql. If you want to reset to orignal rewrite rules, go to Permalink Settings and Save Changes. That's it..
Version: 1.0.0
Author: Yuan Yang
Author URI: https://84361749.com/
Github: https://github.com/ayangyuan/Wordpress-Plugin-Enable-Numeric-Slugs
License: GPL2
*/

/*  Copyright 2017  aYangYuan  (email : ayangyuan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
