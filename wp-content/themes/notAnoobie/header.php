<!DOCTYPE html><!--[if lt IE 9]>
<html class='lt-ie9 no-js' lang='en'>
<![endif]-->
<!--[if gte IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
    
    <!-- favicons -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png"/>

    <META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
    <link rel="manifest" href="/wp-content/themes/notAnoobie/manifest.json">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="notAnoobie">
    <link rel="apple-touch-icon" href="/wp-content/themes/notAnoobie/assets/notAnoobie/images/icons/ios-app-icon-144x144.png" sizes="144x144">
    <meta name="msapplication-TileImage" content="/wp-content/themes/notAnoobie/assets/notAnoobie/images/icons/nAn-icon-144x144.png">
    <meta name="msapplication-TileColor" content="#ef2926">
    <meta name="theme-color" content="#333333">

    <?php wp_head(); ?>
</head>

<body <?php body_class('--focusRingDisabled'); ?>>
    <a href="#main" id="top" class="visuallyhidden">Skip Navigation</a>

    <?php
        $header_data = NaNThemeComponents\Shared\Header::get_data();
        nan_theme_render( 'templates/content', 'header', $header_data );
