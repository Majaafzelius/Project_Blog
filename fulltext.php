<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php
$page_title = 'Inlägg';
include ('includes/header.php');

echo '<main>';
include ('includes/sidebar.php');
echo '<section id="post">';
// hämtarc id från länken
$i = $_GET['id'];
$post = new Post();
// hämta inlägget med idt
$post->fulltext($i);

echo '</section>';
include ("includes/footer.php");