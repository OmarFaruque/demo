<?php
  /*
   Plugin Name: Demo user
   Plugin URI: 
   description: This is a plugin for demo user.
   Version: 0.1
   Author: Mr. Omor
   Author URI: 
   License: 
   */


// custom roll and 
function add_roles_on_plugin_activation() {
    add_role( 'customer', 'Customer', 
      array( 
        'read' => true, 
        'level_0' => true
        ) 
    );
    $role = get_role('customer' );
    $role->add_cap( 'demo_customer', true );
}
add_action('init', 'add_roles_on_plugin_activation');

// add manu page

add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
    if(defined('wp_super_sticky_notesDIR')){
    require_once(wp_super_sticky_notesDIR . 'inc/class.php');
    if( is_user_logged_in() ) {
      $user = wp_get_current_user();
      $roles = ( array ) $user->roles;
      if (in_array('customer', $roles)){
        $class = new wp_super_sticky_notesClass;
        add_menu_page( 'All Sticky Notes', 'All Sticky Notes', 'demo_customer', 'sticky-notes-menu', array(wp_super_sticky_notesClass::get_instance(), 'submenufunction'), 'dashicons-list-view', 50 );
      }
     
    }
  }
}


