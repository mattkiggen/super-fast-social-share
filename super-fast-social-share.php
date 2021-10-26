<?php

/*
  Plugin Name: Super Fast Social Share
  Description: Add simple social buttons to your site
  Version: 1.0.0
  Author: Matt Kiggen
  Author URI: https://github.com/mattkiggen/
*/

if (!defined("ABSPATH")) exit;

require(dirname(__FILE__) . "/inc/settings.php");
require(dirname(__FILE__) . "/inc/buttons.php");

class SuperFastSocialShare {
  function __construct()
  {
    $settings = new SuperFastSocialShareSettings();
    $buttons = new SuperFastSocialShareButtons();

    if(get_option("sfss_css") == "1") {
      wp_enqueue_style("sfssStyles", plugin_dir_url(__FILE__) . "assets/plugin.css", null, "1.0");
    }

    if(get_option("sfss_icons") == "1") {
      wp_enqueue_style("sfssFontAwesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");
    }
  }
}

$superFastSocialShare = new SuperFastSocialShare();