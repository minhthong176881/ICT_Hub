<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/stylesheets/style.css">
    <link rel="stylesheet" href="assets/stylesheets/login.css">
    <link rel="stylesheet" href="assets/stylesheets/post.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/blog.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/contact.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/about.css">
    <link rel="stylesheet" href="assets/stylesheets/components/input.css">
    <link rel="stylesheet" href="assets/stylesheets/components/button.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="assets/js/ckeditor/ckeditor.js"></script>
    <title>ICT Hub</title>
</head>
<body>
<header>
    <nav>
        <a href="/"><img src="assets/img/logo.png" alt=""></a>
        <div class="nav-links" id="navLinks">
            <i class="fas fa-times" id="close-icon"></i>
            <ul>
                <li><a href="/">HOME</a></li>
                <li><a href="?controller=pages&action=course">COURSES</a></li>
                <li><a href="?controller=pages&action=blog">BLOG</a></li>
                <li><a href="?controller=pages&action=about">ABOUT</a></li>
                <li><a href="?controller=pages&action=contact">CONTACT</a></li>
                <li><a href="?controller=users&action=login">LOGIN <span><i class="fas fa-sign-in-alt"></i></span></a></li>
            </ul>
        </div>
        <i class="fas fa-bars" id="menu-icon"></i>
    </nav>