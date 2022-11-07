<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, minimal-ui">

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="googlebot" content="index, follow">
  <meta name="author" content="">
  <link rel="shortcut icon" href="favicon.ico" />
  <script src="http://www.youtube.com/player_api"></script>

  <!-- <script src="https://www.youtube.com/iframe_api"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAvdsuZcemlM3T1I7BT2EZ_rsb1gxWm4U" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
  <?php wp_head(); ?>
</head>

<body>
  <!-- <?php get_template_part( 'template-parts/compontent/content', 'ticker-style-one' ); ?> -->

  <!-- <canvas class="webgl"></canvas> -->

  <div id="music-video-details">
    <div class="cont">
      <div id="album-name"><span>album</span> Light Bulbs</div>
      <div id="song-name"><span>track</span> Crazy City</div>
      <div id="progress-bar-width">
        <div id="time">0:00 / 0:00</div>
        <div id="live"></div>
      </div>
    </div>
    <!-- <div id="album-cover"></div> -->
  </div>


  <!--
  <div id="v-cont">
  <div id="v-1"></div>
  <div id="v-2"></div>
  <div id="v-3"></div>
</div> -->

<!--
<div class="wave-divider">
<svg id="wave" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 456.7 39.9" style="enable-background:new 0 0 456.7 39.9;" xml:space="preserve">
<path class="wave-line" d="M4.2,33.2c0.1-0.1,7-6.9,15.9-13.8C27.7,13.7,38.7,6,47.5,6c7.5,0,14,6.6,20.3,12.9l0.4,0.4
c6.8,6.9,14.6,14.6,24.6,14.6c9.9,0,17.7-7.8,24.5-14.6l0.5-0.5C124,12.5,130.5,6,137.9,6c7.5,0,13.9,6.5,20.2,12.9l0.4,0.4
c6.8,6.9,14.6,14.6,24.5,14.6c10,0,17.8-7.8,24.6-14.6l0.5-0.5C214.4,12.5,220.9,6,228.4,6c7.5,0,14,6.5,20.2,12.9l0.4,0.4
c6.8,6.9,14.5,14.6,24.5,14.6c9.9,0,17.7-7.8,24.5-14.6l0.3-0.3c6.3-6.4,12.9-13,20.5-13c7.5,0,14.1,6.6,20.4,13l0.3,0.3
c6.8,6.9,14.6,14.6,24.5,14.6c9.9,0,17.6-7.8,24.5-14.6l0.2-0.2C395.1,12.6,401.6,6,409.2,6c8.7,0,19.8,7.7,27.3,13.4
c8.9,6.8,15.9,13.7,16,13.8"/>
</svg>
</div> -->


<nav id="website-controls-container" class="column">
  <div id="js-tour-btn" class="marquee">
    <div class="marquee__inner">
      <span>View Tour</span>
      <span>•</span>
      <span>View Tour</span>
      <span>•</span>
      <span>View Tour</span>
      <span>•</span>
      <span>View Tour</span>
      <span>•</span>
    </div>
  </div>
</nav>

<div id="current-upcoming-show-detail">
  <div id="show-happening">
    <div id="beacon-container">
      <div id="beacon"></div>
    </div>

    <div id="text">
      <span>Show is Live @ </span>
      <!-- <div id="current-show-location">?</div> -->
    </div>
  </div>

  <div id="show-upcoming">
    <div id="text">
      <span>Next Show start in</span>
      <div id="current-show-location"></div>
      <div id="count-down"></div>
    </div>
  </div>
</div>

<?php get_template_part( 'template-parts/compontent/content', 'map' ); ?>


<div id="app">
  <div id="nav-container">
    <div class="small-12 columns">
      <a id="logo" href="/">7th Heaven</a>
      <!-- <nav id="main-nav">
      <?php $args = array(
      'menu' => 'Main Nav',
      'theme_location' => 'Main Nav',
      'menu_class' => 'menu'
    );
    wp_nav_menu($args); ?>
  </nav> -->
  <div id="second-nav">
    <a href="/Media">Media</a>
    <a href="Store">Store</a>
  </div>
</div>
</div>


<main data-router-wrapper>
