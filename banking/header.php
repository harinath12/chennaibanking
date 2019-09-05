<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">    
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,700,900">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/fonts.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/style.css" id="main-styles-link"> 
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,900"> 
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/widget.css">
    
  </head>
 <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <div class="page">
      <!-- Page Header-->
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand" href="#"><img class="brand-logo-dark" src="images/logo-150x25.png" alt="" width="150" height="25"/><img class="brand-logo-light" src="images/logo-inverse-150x25.png" alt="" width="150" height="25"/></a>
                  </div>
                </div>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Nav-->
                    <?php wp_nav_menu(array('menu' => 'Header menu'));?>
                  </div>
                  <!-- RD Navbar Search-->
                  <!-- <div class="rd-navbar-search">
                    <button class="rd-navbar-search-toggle rd-navbar-fixed-element-2" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                    <form class="rd-search" action="" >
                      <div class="form-wrap">
                        <label class="form-label" for="rd-navbar-search-form-input">Search</label>
                        <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                        <div class="rd-search-results-live" id="rd-search-results-live"></div>
                      </div>
                      <button class="rd-search-form-submit mdi mdi-magnify" type="submit"></button>
                    </form>
                  </div> -->
                </div>
                <!-- <div class="rd-navbar-aside-element">
                  <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
                  <div class="rd-navbar-collapse rd-navbar-info">
                    <div class="icon mdi mdi-cellphone-iphone"></div><a href="tel:#">960-000-0011</a>
                  </div>
                </div> -->
              </div>
            </div>
          </nav>
        </div>
      </header>