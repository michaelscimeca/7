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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAvdsuZcemlM3T1I7BT2EZ_rsb1gxWm4U" defer></script>
  <?php wp_head(); ?>
</head>
<body>
  <canvas class="webgl"></canvas>

    <div id="app">
    <div class="countdown"></div>
    <div class="time"></div>

      <div id="nav-container">
        <div class="row">
          <div class="small-12 columns">
          <div id="logo"></div>
         <nav id="main-nav">
          <?php $args = array(
            'menu' => 'Main Nav',
            'theme_location' => 'Main Nav',
            'menu_class' => 'menu'
            );
            wp_nav_menu($args); ?>
          </nav>
        <div id="second-nav"></div>
          </div>
        </div>
      
    
      </div>
      <?php get_template_part( 'template-parts/compontent/content', 'map' ); ?>

      <section id="tour">
        <ul>
        </ul>
       </section>

      
      <main data-router-wrapper>

