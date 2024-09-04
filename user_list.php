<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php
$page_title = 'Användare';
include ('includes/header.php');

echo '<main>';
echo '<div id="cont">';
include ('includes/sidebar.php');
echo '</div>';
echo '<h2>Alla Användare</h2>';

$admin = new Admin();
echo '<ul>';
// Skriv ut alla användare i en lista
$admin->list_users();
echo '</ul>';
include ("includes/footer.php");