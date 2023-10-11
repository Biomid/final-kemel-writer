<?php
namespace Writer\Kemel;
session_start();
require_once __DIR__."/vendor/autoload.php";
use Write\Kemel\DB\DB;
$username = $_POST["username"];
$password = $_POST["password"];

$data = new DB("localhost", "kemel_writer", "root", "");

$data->getConnection();
$response = $data->authenticateUser($username,$password);

if ($response == true){
    $_SESSION['admin'] = $username;
    header("Location: http://localhost/writer/test2.php");
}
else header("Location: http://localhost/writer/test.php");