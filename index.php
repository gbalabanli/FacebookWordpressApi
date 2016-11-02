<?php /* 
    Plugin Name: Etkinix FB Panel
    Plugin URI: http://etkinix.com
    Description: Provides multiple example posts & pages to assist with styling and developing new and current themes.
    Version: 1.3 
    Author: Bora Balabanli.
    Author URI: http://etkinix.com/

        Copyright 2011 Hivemind Labs, Inc.  (email : destek@etkinix.com)

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

    // Start up the engine 
    add_action('admin_menu', 'etkinix_post_menu');
    add_action( 'fb_event_download_schedule', 'fb_event_download' );
    add_action( 'fb_event_download_schedule2', 'fb_event_download_2' );
    add_action( 'fb_event_download_schedule3', 'fb_event_download_3' );
    add_action( 'fb_event_download_schedule4', 'fb_event_download_4' );
    add_action( 'fb_event_download_schedule5', 'fb_event_download_5' );
    add_action( 'fb_event_download_schedule6', 'fb_event_download_6' );
    add_action( 'fb_event_download_schedule7', 'fb_event_download_7' );
    add_action( 'fb_event_download_schedule8', 'fb_event_download_8' );

    // Define new menu page parameters
    function etkinix_post_menu() {
        add_menu_page( 'Etkinix FB Panel', 'Etkinix FB', 'activate_plugins', 'etkinix-fb', 'etkinix_fb_event_init', '');
    }

    function etkinix_fb_event_init() {
        if (!current_user_can('manage_options'))  {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        } else {
            include_once 'global.php';
            // schedule the check_expired_listings event only once
            require_once( ETKINIX_PLUGIN_PATH . 'fb_event_pages.php' );  
            my_fb_cron_activation();
        }
    }

    function fb_event_download(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job.php' );
    }
    function fb_event_download_2(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_2.php' );
    }
    function fb_event_download_3(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_3.php' );
    }
    function fb_event_download_4(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_4.php' );
    }
    function fb_event_download_5(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_5.php' );
    }
    function fb_event_download_6(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_6.php' );
    }
    function fb_event_download_7(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_7.php' );
    }
  function fb_event_download_8(){
        include_once 'global.php';
        require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_8.php' );
    }

    function my_fb_cron_activation(){
        if( !wp_next_scheduled( 'fb_event_download_schedule' ) ) {
                 wp_schedule_event( time(), 'daily', 'fb_event_download_schedule' );
        }
        echo "fb event download scheduled for hour!";
    }



