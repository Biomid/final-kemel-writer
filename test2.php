<?php
session_start();
if (!isset($_SESSION['admin'])){
    header("Location: http://localhost/writer/test.php");
}
echo "okkkkk";