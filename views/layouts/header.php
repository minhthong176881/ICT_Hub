<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/stylesheets/style.css">
    <link rel="stylesheet" href="assets/stylesheets/login.css">
    <link rel="stylesheet" href="assets/stylesheets/post.css">
    <link rel="stylesheet" href="assets/stylesheets/common.css">
    <link rel="stylesheet" href="assets/stylesheets/profile.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/blog.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/contact.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/about.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/semester.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/subject.css">
    <link rel="stylesheet" href="assets/stylesheets/pages/search.css">
    <link rel="stylesheet" href="assets/stylesheets/components/input.css">
    <link rel="stylesheet" href="assets/stylesheets/components/button.css">
    <link rel="stylesheet" href="assets/stylesheets/components/popup.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="assets/js/ckeditor/ckeditor.js"></script>
    <script src="assets/js/common.js"></script>
    <title>ICT Hub</title>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
</head>

<body>
    <header>
        <nav>
            <a href="/"><img src="assets/img/logo.png" alt=""></a>
            <div class="nav-links" id="navLinks">
                <i class="fas fa-times" id="close-icon"></i>
                <ul>
                    <li>
                        <!-- <input type="search" id="search" name="search" style="height: 30px; width: 200px; margin-right: 12px; border: none; outline: none" placeholder="Search anything"> -->
                    </li>
                    <li><a href="/">HOME</a></li>
                    <li><a href="?controller=pages&action=course">COURSES</a></li>
                    <li><a href="?controller=pages&action=blog">BLOG</a></li>
                    <li><a href="?controller=pages&action=about">ABOUT</a></li>
                    <li><a href="?controller=pages&action=contact">CONTACT</a></li>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        if (!empty($_SESSION['given_name'])) {
                            print '<div class="dropdown">';
                            print '<li><a href="#">HI, ' . $_SESSION['given_name'] . '  <span><i class="fal fa-user"></i></span></a></li>';
                            print '<div class="dropdown-content">';
                            print '<li><a href="?controller=users&action=profile&id=' . $_SESSION['userId'] . '">Profile</a></li><br>';
                            print '<li><a href="?controller=users&action=logout">Logout</a></li>';
                            print '</div>';
                            print '</div>';
                        } else {
                            unset($_SESSION['logged_in']);
                            header('Refresh: 0');
                        }
                    } else {
                        print '<li><a href="?controller=users&action=login">LOGIN <span style="color:white"><i class="far fa-sign-in-alt"></i></span></a></li>';
                    }
                    ?>
                    <li class="search-icon" onclick="searchOnClick()"><span style="color: white"><i class="far fa-search"></i></span></li>
                </ul>
            </div>
            <i class="fas fa-bars" id="menu-icon"></i>
        </nav>
        <div id="livesearch" class="hide-search">
            <div id="search-input"></div>
            <div id="search-results" style="max-height: 500px; overflow: auto; padding: 5px"></div>
        </div>
        <script>
            function liveSearch() {
                var search = document.getElementById('search');
                var results = document.getElementById("search-results");
                if (search != null) {
                    search.addEventListener('keyup', (e) => {
                        if (e.keyCode == 13) {
                            event.preventDefault();
                            if (search.value.trim() != "")
                                window.location.href = "?controller=pages&action=search&search=" + search.value;
                        } else if (e.keyCode == 27) {
                            results.innerHTML = "";
                            if (!results.classList.contains('hide-search')) results.classList.add('hide-search');
                            if (!document.querySelector('#livesearch').classList.contains('hide-search')) document.querySelector('#livesearch').classList.add('hide-search')

                        } else {
                            if (search.value.trim() == "") {
                                results.innerHTML = "";
                                if (!results.classList.contains('hide-search')) results.classList.add('hide-search');
                                if (!document.querySelector('#livesearch').classList.contains('hide-search')) document.querySelector('#livesearch').classList.add('hide-search')
                                return;
                            }
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    results.innerHTML = this.responseText;
                                    if (results.classList.contains('hide-search')) results.classList.remove('hide-search');
                                }
                            }
                            xmlhttp.open("GET", "?controller=pages&action=liveSearch&search=" + search.value, true);
                            xmlhttp.send();
                        }
                    });
                }
            }

            function searchOnClick() {
                if (document.querySelector('.search-div') == null && document.querySelector('#livesearch').classList.contains('hide-search')) {
                    var searchDiv = document.createElement('div');
                    searchDiv.setAttribute('class', 'search-div');
                    var searchInput = document.createElement('input');
                    searchInput.setAttribute('type', 'search');
                    searchInput.style.width = '100%';
                    searchInput.setAttribute('placeholder', 'Search anything...')
                    searchInput.setAttribute('id', 'search');
                    searchInput.setAttribute('onkeyup', 'liveSearch()');
                    searchDiv.insertBefore(searchInput, searchDiv.firstChild);
                    var search = document.querySelector('#search-input');
                    if (search.classList.contains('hide-search')) search.classList.remove('hide-search');
                    search.appendChild(searchDiv);
                } else if (document.querySelector('.search-div') != null && document.querySelector('#livesearch').classList.contains('hide-search')) {
                    var search = document.querySelector('#livesearch');
                    search.classList.remove('hide-search');
                } else {
                    var search = document.querySelector('#livesearch');
                    if (!search.classList.contains('hide-search')) search.classList.add('hide-search');
                }
            }
        </script>