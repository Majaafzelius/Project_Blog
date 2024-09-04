<!-- Utvecklad av Maja Afzelius 2023 -->

<?php
class Admin {
    public $username;
    private $password;
    public $id;
    private $conn;

    public function __construct() {
        // $this->conn = new mysqli('localhost', 'root', 'lpslps01', 'webb');
        $this->conn = new mysqli('studentmysql.miun.se', 'maaf2200', 'm3WM!VLkq7', 'maaf2200');
    }

    public function save_user($username, $password, $fullname) {
        if ($username != null && $password != null) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO Admin_user (username, user_password, fullname) values (?,?,?)");
            $stmt->bind_param('sss', $username, $hashed_password, $fullname);
            $stmt->execute();
            $stmt->close();
            echo '<p>Ditt inlogg har skapats</p>';
        }
        else {
            echo '<p> vänligen fyll i fälten ovan</p>';
        }
    }
    public function get_user_id($username) {
        $stmt = $this->conn->prepare('SELECT * from Admin_user where username = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if( $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        return $row['id'];
        }
        else {
            return null;
        }        
    }

    public function login_user($username, $password) {
        $stmt = $this->conn->prepare('SELECT * from Admin_user where username = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            if ($username == $row['username'] &&  password_verify($password, $row['user_password'])) {
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['logged_in'] = true;
                $stmt->close();
                echo "<script>window.location.href = 'admin.php?id=" .$row['id'] . "';</script>"; 
                // header('Location: admin.php?id='.$row['id'] );
                exit;
            }
            else {
                echo '<br>Användaren eller lösenordet stämmer ej, Kontrollera inmatningen eller skapa ett konto hos oss';
            }
        }
        
    }
    public function list_users() {
        $sql = 'SELECT * from Admin_user';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="user.php?id='.$row['id'].'">' . $row['fullname'].' ('. $row['username'].')</a></li>';
        }
    }

    public function user_page($id) {
        $stmt = $this->conn->prepare('SELECT * from Admin_user where id=?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $admin = array();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $admin[] = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'name' => $row['fullname']
            );;
            // echo '<h3>'.$row['fullname']. '</h3>';
            // echo $row['username'];

        }
        return $admin;
    }
}