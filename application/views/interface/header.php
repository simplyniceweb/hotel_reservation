<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=$title?></title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&amp;subset=latin,cyrillic,greek" rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?=base_url()?>assets/icons/fav.ico" type="image/x-icon">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php if($active==1): ?>
<link href="<?=base_url()?>assets/3rd-party/nivo-slider/nivo-slider.css" rel="stylesheet">
<link href="<?=base_url()?>assets/3rd-party/nivo-slider/themes/default/default.css" rel="stylesheet">
<?php endif; ?>
<?php if($active==2): ?>
<link href="<?=base_url()?>assets/3rd-party/datepicker/datepicker.css" rel="stylesheet">
<?php endif; ?>
<link href="<?=base_url()?>assets/styles/interface.css" rel="stylesheet">
</head>
<body>