<!-- Utvecklad av Maja Afzelius 2023 -->

<?php
class Post {
    private $id;
    public $title;
    public $content;
    public $timestamp;
    public $user_id;
    private $conn;

    public function __construct() {
        // $this->conn = new mysqli('localhost', 'root', 'lpslps01', 'webb');
        $this->conn = new mysqli('studentmysql.miun.se', 'maaf2200', 'm3WM!VLkq7', 'maaf2200');

    }

    public function save_data($title, $content, $timestamp, $user_id, $name) {
        $stmt = $this->conn->prepare("INSERT INTO Posts (title, content, time_date, user_id, user_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $content, $timestamp, $user_id, $name);
        $stmt->execute();
        $stmt->close();
    }

    public function delete() {
        $post_id = $_POST['post_id'];
        $stmt = $this->conn->prepare("DELETE FROM Posts WHERE Id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    public function change_post($post_id) {
        $query = "SELECT title, content FROM Posts WHERE Id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $post_id);
        $stmt->execute();
        $stmt->store_result();
        // if ($stmt->num_rows > 0) {
            $stmt->bind_result($this->title, $this->content);
            $stmt->fetch();
            
            // display a new form with the current title and content pre-populated
            echo '<form method="post">';
            echo '<input type="text" name="title" value="' . $this->title . '"><br>';
            echo '<textarea name="content">' . $this->content . '</textarea>';
            echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
            echo '<input type="submit" name="update" value="Uppdatera">';
            echo '</form>';
        // }
    
        if (isset($_POST['update'])) {
            // get the updated title and content from the form
            $post_id = $_POST['post_id'];
            $title = strip_tags($_POST['title']);
            $content = strip_tags($_POST['content']);

            // update the post in the database
            $query = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param($title, $content, $post_id);
            $stmt->execute();
            
        }
        $this->delete();
    // }
    }

    public function get_data_admin($id) {
        if (isset($_POST['submit'])) {
            $this->delete();
        }
        $sql = 'SELECT * FROM Posts Where user_id=? ORDER BY time_date DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $posts = array();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = array(
                    'id' => $row['Id'],
                    'title' => $row['title'],
                    'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                    'date' => $row['time_date'],
                    'name' => $row['user_name']
                );
            }
        }
        return $posts;
    }
    public function get_data_all() {
        $output = $this->conn->query('SELECT * from Posts ORDER by time_date DESC');
        $posts = array();
        while ($row = $output->fetch_assoc()) {
            $posts[] = array(
                'id' => $row['Id'],
                'title' => $row['title'],
                'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                'date' => $row['time_date'],
                'name' => $row['user_name']
            );
        }
        return $posts;
    }
    public function get_data_index() {
        $output = $this->conn->query('SELECT * from Posts ORDER by time_date DESC');
        $posts = array();
        if ($output->num_rows > 4) {
            for ($i=0; $i<5; $i++) {
                $row = $output->fetch_assoc();
                $posts[] = array(
                    'id' => $row['Id'],
                    'title' => $row['title'],
                    'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                    'date' => $row['time_date'],
                    'name' => $row['user_name']
                );
            }
        }
        else {
            while ($row = $output->fetch_assoc()) {
                $posts[] = array(
                    'id' => $row['Id'],
                    'title' => $row['title'],
                    'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                    'date' => $row['time_date'],
                    'name' => $row['user_name']
                );
        }}
        return $posts;
    }

    public function user_posts($id) {
        $stmt = $this->conn->prepare('SELECT * FROM Posts WHERE user_id = ? ORDER BY time_date DESC');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $posts = array();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $posts[] = array(
                'id' => $row['Id'],
                'title' => $row['title'],
                'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                'date' => $row['time_date'],
                'name' => $row['user_name']
            );
        }
        return $posts;
    }
    public function fulltext($i) {
        // funktion för att visa hela inlägg
        $sql = "SELECT * FROM Posts WHERE Id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $i);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<h2>'.$row['title'].'</h2>';
                echo '<i>' . $row['time_date'] . '</i>';
                echo '<p>' . $row['content'].'</p>';
        } 
        else {
            echo "Ingen text hittades.";
        }
    }
   
}