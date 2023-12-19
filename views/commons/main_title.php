<?php $lang = "es"; ?>
<?php $starttime = microtime(true); // Top of page ?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editor Odds</title>

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="<?= FONT_ICONS ?>icons/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?= FONT_ICONS ?>icons/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?= FONT_ICONS ?>icons/fontawesome/css/solid.css" rel="stylesheet">

    <link href="<?= FONT_ICONS ?>icons/fontawesome/css/v4-font-face.css" rel="stylesheet" />

    <link rel="shortcut icon" href="https://es.besoccer.com/favicon.ico" type="image/png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="<?=MEDIA_ROOT?>favicon/apple-icon-57x57.png?v=2">
	<link rel="apple-touch-icon" sizes="60x60" href="<?=MEDIA_ROOT?>favicon/apple-icon-60x60.png?v=2">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=MEDIA_ROOT?>favicon/apple-icon-72x72.png?v=2">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=MEDIA_ROOT?>favicon/apple-icon-76x76.png?v=2">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=MEDIA_ROOT?>favicon/apple-icon-114x114.png?v=2">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=MEDIA_ROOT?>favicon/apple-icon-120x120.png?v=2">
	<link rel="apple-touch-icon" sizes="144x144" href="<?=MEDIA_ROOT?>favicon/apple-icon-144x144.png?v=2">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=MEDIA_ROOT?>favicon/apple-icon-152x152.png?v=2">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=MEDIA_ROOT?>favicon/apple-icon-180x180.png?v=2">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?=MEDIA_ROOT?>favicon/logo_basic.png?v=2">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=MEDIA_ROOT?>favicon/logo_basic.png?v=2">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=MEDIA_ROOT?>favicon/logo_basic.png?v=2">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=MEDIA_ROOT?>favicon/flogo_basic.png?v=2">

    <link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>icons/icomoon/styles.css"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>bootstrap.min.css?ch=<?=rand(1,999)?>"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>bootstrap_limitless.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>layout.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>components.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>colors.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>custom.min.css?ch=<?=rand(1,999)?>"/>
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_CSS?>styles.css"/>
    
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Oswald:300,400,500" rel="stylesheet">

    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">     -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
    
    
    <script src="<?=MEDIA_JS?>main/jquery.min.js"></script>
    <script src="<?=MEDIA_JS?>main/bootstrap.bundle.min.js"></script>
    <script src="<?=MEDIA_JS?>plugins/loaders/blockui.min.js"></script>
    <script src="<?=MEDIA_JS?>app.js"></script>
    <script src="<?=MEDIA_JS?>common.js"></script>
    <script src="<?=MEDIA_JS?>plugins/forms/styling/switchery.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    
    <!-- Aquí se cargarían los CSS/JS desde el controlados, luego se carga la vista del menú lateral izquierdo -->
