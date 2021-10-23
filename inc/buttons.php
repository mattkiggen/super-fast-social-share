<?php

class SuperFastSocialShareButtons {
  function __construct()
  {
    add_filter("the_content", [$this, "addShareButtons"]);
  }

  function addShareButtons($content) {
    if(is_single() && is_main_query()) {
      $location = get_option("sfss_location", "0");
      
      if($location == 0) {
        return $this->createHtml() . $content;
      }

      return $content . $this->createHtml();
    }

    return $content;
  }

  function createHtml() {
    $url = get_permalink();
    $title = get_the_title();
    $twitterHandle = get_option("sfss_twitter_handle");

    $html = "<div class='sfss-buttons'>";
    $html .= "<a class='sfss_facebook' href='https://www.facebook.com/sharer/sharer.php?u=$url' target='_blank'><i class='fab fa-facebook-f'></i> Share</a>";
    $html .= "<a class='sfss_twitter' href='https://twitter.com/share?url=$url&text=$title&via=$twitterHandle' target='_blank'><i class='fab fa-twitter'></i> Tweet</a>";
    $html .= "<a class='sfss_reddit' href='https://www.reddit.com/submit?url=$url' target='_blank'><i class='fab fa-reddit-alien'></i> Submit</a>";
    $html .= "</div>";

    return $html;
  }
}