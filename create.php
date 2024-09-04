<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php 
$page_title = 'Skapa Användare';
include ('includes/header.php');
?>
<main>
    <?php include ('includes/sidebar.php');?>
    <!-- form för att skapa nya användare -->
<form method="post" action="create.php">
  <label for="username">Användarnamn:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="password">Lösenord:</label>
  <input type="password" id="password" name="password">
  <br>
  <label for="name">För- och Efternamn</label>
  <input type="text" id="name" name="name">
  <br>
  <input type="submit" value="Skapa Konto">
</form>

<?php
// se till att saker ej är null
$username = isset($_POST['username']) ? $_POST['username']: '';
$password = isset($_POST['password']) ? $_POST['password']: '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$admin = new Admin();
// spara användare till databasen
$admin->save_user(strip_tags($username), strip_tags($password), strip_tags($name));
include ("includes/footer.php");