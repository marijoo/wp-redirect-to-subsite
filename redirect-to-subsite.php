<?php
/*
Plugin Name:  Redirect to Subsite
Plugin URI:   https://kolossal.io
Description:  Redirects multisite main site to first subsite available
Version:      1.0.0
Author:       kolossal.io
Author URI:   https://kolossal.io/
License:      MIT License
*/

add_action('init', function () {
    // do not redirect non-mainsite or admin area
    if (!is_main_site() || is_admin())
        return;

    // do not redirect login screen or WP CLI requests
    if ('wp-login.php' == $GLOBALS['pagenow'] || defined('WP_CLI'))
        return;

    // get all network sites
    $sites = get_sites();

    // only proceed if there is another site available
    if (count($sites) > 1) {
        wp_redirect(get_site_url($sites[1]->blog_id));
        exit();
    }
});
