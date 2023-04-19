<?php
// ambil URL
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// lakukan routing
if ($url == 'home') {
    require_once('module/home.php');
} else if ($url == 'about') {
    require_once('module/about.php');
} else if ($url == 'contact') {
    require_once('module/contact.php');
} else {
    require_once('module/404.php');
}
