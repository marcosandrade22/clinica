<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <base href="<?php echo base_url(); ?>">
  <link rel="canonical" href="<?php echo base_url(); ?>" />
  
  <meta name="description" content="Um blog que fala de assuntos diversos" />
  <meta name="keywords" content="blog, assunto1, assunto 2, " />
  <meta name="author" content="Marcos Andrade - marcos@presencadigitall.com.br" />
  <link rel="index" title="<?php echo $title; ?>" href="<?php echo base_url(); ?>">
  
  
  <meta property="fb:admins" content="100003566854664,100000423466452"/>
  <meta property="og:url" content="<?php echo (isset($controller) ? $controller : base_url());?>" />
  <meta property="og:title" content="<?php echo (isset($title) ? $title : 'Título Facebook');?>">
  <meta property="og:description" content="<?php echo (isset($descricao) ? $descricao : 'Descrição Facebook');?>">
  <meta property="og:image" content="<?php echo (isset($imagem) ? $imagem : base_url().'assets/img/capa-home.jpg'); ?>" >
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:type" content="website">
  <meta name="url" content="<?php echo base_url(); ?>">
  
  
  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/overlay.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v2.0.0
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
