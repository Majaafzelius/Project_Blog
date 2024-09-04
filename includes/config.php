<!-- Utvecklad av Maja Afzelius 2023 -->

<?php

session_start();
$site_title = 'Projektet';
$divider = ' | ';

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; //sökväg till mappen för dina klasser
});

// error_reporting(-1);
// ini_set("display_errors", 1);
