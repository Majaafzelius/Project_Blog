<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php");
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('location: login.php');
}

$page_title = 'Admin';
include ('includes/header.php');
$id = $_GET['id'];

// kollar om en användare är inloggad, omdirigerar annars till sidan för login

// Skapa nytt admin-objekt
$admin = new Admin();
// html formatering
echo '<main>';
// länk för at logga ut användare
echo '<a href="logout.php">Logga ut</a>';
echo '<div id="cont">';
include ('includes/sidebar.php');
// sätter titel och content till nånting annat än null
$title = isset($_POST['title']) ? $_POST['title'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
?>
<div>
    <h2>Mina Sidor</h2>

    <?php     
    // Skriver ut använders information
    $users = $admin->user_page($id);
    foreach ($users as $user) {
        echo '<h3>'.$user['name'].'</h3>';
        echo '<h4>'.$user['username']. '</h4>';
    }
    // Skapar nytt post-objekt
$postobj = new Post();
    ?>
</div>
</div>
<!-- Form för att lägga till nya inlägg -->
<form method="post">
    <label for="title">Titel</label><br>
    <input type="text" id="title" name="title"><br>
    <br>
    <label for="content">Innehåll:</label><br>
    <textarea name="content" id="content" rows="10"></textarea>
    <input type="submit" value="Lägg upp">
</form><br>

<?php
// Extra koll så titel och innehåll ej är null
if ($title!=null & $content!=null) {
    // Spara inlägget till databasen
    $titel = strip_tags($_POST['title']);
    $innehall = strip_tags($_POST['content']);
    $postobj->save_data($titel, $innehall, date("Y-m-d H:i:s"),$id, $_SESSION['fullname']);
    
}
else {
    echo '<p>Vänligen fyll i en titel och innehåll på ditt inlägg. </p>';
}
// hämta inlägg från databasen
$posts = $postobj->get_data_admin($id);
// kollar om knappen för att ändra inlägg har triggats
if (isset($_POST['change'])) {
    $postobj->change_post($_POST['post_id']); 
}   
// loppar igenom inläggen från databasen och skriver ut
foreach ($posts as $post) {
    ?>
        <article class="post" id="<?php echo $post['id']; ?>">
            <h2><?php echo $post['title']; ?></h2>
            <i>Av: <?php echo $post['name']?> </i>
            <i><?php echo $post['date']; ?></i>
            <p class="content"><?php echo $post['content']; ?></p>
            
            <form method="post">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <input type="submit" name="submit" value="Ta bort">
                <input type="submit" name="change" value="Ändra">
            </form>
        </article>
    <?php
    
    }
 

include ('includes/footer.php');