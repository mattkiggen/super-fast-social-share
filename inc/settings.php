<?php

if (!defined("ABSPATH")) exit;

class SuperFastSocialShareSettings {
  function __construct()
  {
    add_action("admin_menu", [$this, "adminPage"]);
    add_action("admin_init",[$this, "settings"]);
  }

  function adminPage() {
    add_options_page("Super Fast Social Share Settings", "Social Share", "manage_options", "sfss-settings-page", [$this, "settingsHtml"]);
  }

  function settings() {
    add_settings_section("sfss_first_section", null, null, "sfss-settings-page");

    // Location
    add_settings_field("sfss_location", "Display Location", [$this, "locationHtml"], "sfss-settings-page", "sfss_first_section");
    register_setting("sfssplugin", "sfss_location", [
      "sanitize_callback" => "sanitize_text_field",
      "default" => "0"
    ]);

    // Twitter handle
    add_settings_field("sfss_twitter_handle", "Your Twitter Handle", [$this, "twitterHandleHtml"], "sfss-settings-page", "sfss_first_section");
    register_setting("sfssplugin", "sfss_twitter_handle", [
      "sanitize_callback" => "sanitize_text_field",
      "default" => ""
    ]);

    // FontAwesome
    add_settings_field("sfss_icons", "Load Font Awesome CSS", [$this, "iconsHtml"], "sfss-settings-page", "sfss_first_section");
    register_setting("sfssplugin", "sfss_icons", [
      "sanitize_callback" => "sanitize_text_field",
      "default" => "1"
    ]);
    add_option("sfss_icons", "1");

    // Load CSS
    add_settings_field("sfss_css", "Load CSS", [$this, "loadCssHtml"], "sfss-settings-page", "sfss_first_section");
    register_setting("sfssplugin", "sfss_css", [
      "sanitize_callback" => "sanitize_text_field",
      "default" => "1"
    ]);
    add_option("sfss_css", "1");
  }

  function locationHtml() {
    ?>
    <select name="sfss_location">
      <option value="0" <?php selected(get_option("sfss_location"), "0") ?>>Beginning of post</option>
      <option value="1" <?php selected(get_option("sfss_location"), "1") ?>>End of post</option>
    </select>
    <?php
  }

  function twitterHandleHtml() {
    ?>
    <input type="text" name="sfss_twitter_handle" value="<?php echo esc_attr(get_option("sfss_twitter_handle")) ?>">
    <?php
  }

  function iconsHtml() {
    ?>
    <input type="checkbox" name="sfss_icons" value="1" <?php checked(get_option("sfss_icons"), "1") ?>>
    <?php
  }

  function loadCssHtml() {
    ?>
    <input type="checkbox" name="sfss_css" value="1" <?php checked(get_option("sfss_css"), "1") ?>>
    <?php
  }

  function settingsHtml() {
    ?>
    <div class="wrap">
      <h1>Super Fast Social Share Settings</h1>
      <form action="options.php" method="POST">
      <?php
        settings_fields("sfssplugin");
        do_settings_sections("sfss-settings-page");
        submit_button();
      ?>
      </form>
    </div>
    <?php
  }
}