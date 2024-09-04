<!-- Utvecklad av Maja Afzelius 2023 -->
<?php 


$admin = new Admin();
if (isset($_SESSION['user']) &  isset($_SESSION['password'])) {
    $id = $admin->get_user_id($_SESSION['user']);
    $link = '<a href="admin.php?id='. $id.'">Mina sidor</a>';
}
else {
    $admin = new Admin();
    $link = '<a href="login.php">Mina sidor</a>';
}
?>
    <nav id='sidebar'>
        <h2>Meny</h2>
        <a href="index.php">Startsida</a>
        <a href="news.php">Nyheter</a>
        <?php echo $link?>
        <a href='user_list.php'>Alla Användare</a>
    </nav>