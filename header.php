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
  <?php wp_head(); ?>

</head>
<body>
  <canvas class="webgl"></canvas>
    <div id="app">
    <section id="left-side">
      <nav id="main-nav">
        <?php $args = array(
          'menu' => 'Main Nav',
          'theme_location' => 'Main Nav',
          'menu_class' => 'menu'
          );
          wp_nav_menu($args); ?>
        </nav>
     </section>

    <section id="right-side">
      <main data-router-wrapper>


