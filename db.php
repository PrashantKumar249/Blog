<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
    //echo "Database connected successfully!";
}
?>