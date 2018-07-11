<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      <?php wp_title('|','true','right');//args:seprator,dsiplay,seprator location ?>
      <?php bloginfo('name') ?>
    </title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--
     Pingback allows you to notify other bloggers that
      you have linked to their article on your website-->
      <?php
       wp_head();
       /*must put at the of head tag because he put in the
        website all meta tags and script and links*/
       ?>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <?php elhero_bootstrap_menu() ?>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
