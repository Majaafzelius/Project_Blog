<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php 
$page_title = 'Logga in';
include ('includes/header.php');?>

<main>
  <?php include ('includes/sidebar.php')?>
  <!-- form för att skriva in inloggningsupgifter -->
<form method="post" action="login.php">
  <label for="username">Användarnamn:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="password">Lösenord:</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" value="Login">
</form>
<!-- länk till create.php för att skapa nya användare -->
<a href="create.php">Skapa Konto</a><br>

<?php 
$_SESSION['user'] = isset($_POST['username']) ? $_POST['username'] : '';
$_SESSION['password'] = isset($_POST['password']) ? $_POST['password'] : ''; 

$admin = new Admin();
// logga in användare om uppgifterna är korrekt
$admin->login_user($_SESSION['user'],$_SESSION['password']);
include ("includes/footer.php");

