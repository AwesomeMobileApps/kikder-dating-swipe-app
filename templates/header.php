<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kik or not! &mdash; <?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no"/>
    <meta name="description" content="Find Kik users with a Tinder way!">
    <meta name="keywords" content="men, girl, dating, flirt,tinder, kik, usernames, kik users, users">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php include 'analytics.inc.php' ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php if (isset($page) == 'go') { ?>class="kik"<?Php } ?>>