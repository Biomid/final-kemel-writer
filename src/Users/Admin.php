<?php
namespace Write\Kemel\Users;
use Write\Kemel\DB\DB;
class Admin
{
    private $username;
    private $password;
    private $db;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->db = new DB("localhost", "kemel_writer", "root", "");
    }

    public function authenticate():bool {
        //$conn = $this->db->getConnection();
        return $this->db->authenticateUser($this->username,$this->password);

    }

    public function info(){
        echo $this->username." test ".$this->password;
    }
}