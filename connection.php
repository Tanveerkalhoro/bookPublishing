<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vidhya";

$conn = mysqli_connect("localhost","root","","vidhya");

if(!$conn) {
    die("connection fialed:".mysqli_connect_error());
} 

?>