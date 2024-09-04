
<!-- Utvecklad av Maja Afzelius 2023 -->
<!-- kod för att logga ut användare -->
<?php
// starta ny session
session_start();
// ta bort alla uppgifter för inloggad användare
unset($_SESSION['user']);
unset($_SESSION['password']);
unset($_SESSION['logged_in']);
unset($_SESSION['fullname']);

// avsluta sessionen
session_destroy();
// omdirigera till index.php
header('Location: index.php');
exit;
