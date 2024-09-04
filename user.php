<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php
$page_title = 'Startsida';
include ('includes/header.php');
$admin = new Admin();
// hämta idt från länken
$ids = $_GET['id'];

echo '<main>';
echo '<div id="cont">';
include ('includes/sidebar.php');
echo '<div>';
// hämta användares uppgifter 
$user = $admin->user_page($ids);
// loopa och skriv ut uppgifter för den valda användaren
foreach ($user as $user) {
    echo '<h2>'. $user['name'].'</h2>';
    echo '<h3>'.$user['username']. '</h3>';
}
echo '</div>';
echo '</div>';

$postobj = new Post();
// hämta valda användares inlägg från databasen
$posts = $postobj->user_posts($ids);
// loopa och skriv ut inlägg
foreach ($posts as $post) {
    ?>
        <article class="post" id="<?php echo $post['id']; ?>">
            <h2><?php echo $post['title']; ?></h2>
            <i>Av: <?php echo $post['name']?> </i>
            <i><?php echo $post['date']; ?></i>
            <p class="content"><?php echo $post['content']; ?></p>
            <a href="fulltext.php?id=<?php echo $post['id']?>">Läs mer</a>
        </article>
    <?php
    }
include ("includes/footer.php");