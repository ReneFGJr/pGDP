<!DOCTYPE html>
<?php
if (!isset($page_title)) {
    $page_title = 'Brapci - Homepage';
}
?>

<head>
    <title><?= $page_title; ?> </title>

    <meta name="google-site-verification" content="VZpzNVBfl5kOEtr9Upjmed96smfsO9p4N79DZT38toA" />

    <link rel="icon" href="/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= $URL; ?>/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= $URL; ?>/favicon.png" />

    <!---- JS -->
    <script src="<?= $URL; ?>/js/jquery.min.js?v3.6" crossorigin="anonymous"></script>
    <script src="<?= $URL; ?>/js/popper.min.js" crossorigin="anonymous"></script>
    <script src="<?= $URL; ?>/js/bootstrap.js" crossorigin="anonymous"></script>
    <!--    <script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="<?= $URL; ?>/js/brapci.js?v0.1" crossorigin="anonymous"></script>
    <script src="<?= $URL; ?>/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= $URL; ?>/js/brapci.js?v0.1" crossorigin="anonymous"></script>


    <!---- CSS -->
    <link rel="stylesheet" href="<?= $URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $URL; ?>/css/brapci.css?v0.0.4">
    <link rel="stylesheet" href="<?= $URL; ?>/css/bootstrap-datepicker.min.css">
</head>

<body style="min-height: 500px;">