<!-- Utvecklad av Maja Afzelius 2023 -->
<?php include("includes/config.php"); ?>
<?php
$page_title = 'Nyheter';
include ('includes/header.php');

echo '<main>';
echo '<div id="cont">';
include ('includes/sidebar.php');

echo '</div>';
echo '<h2>Alla Nyheter</h2>';
$postobj = new Post();
// hämta alla inlägg från databasen 
$posts= $postobj->get_data_all();
// loopa och skriv ut inlägget
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

