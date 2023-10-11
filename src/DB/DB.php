<?php
namespace Write\Kemel\DB;
use PDO;
class DB
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct($host, $db_name, $username, $password) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function authenticateUser($username, $password):bool {
        $query = "SELECT * FROM `admin` WHERE `user` = :username AND `password` = :password";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}