<?php
$dBServername = "localhost:3306";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "datasikkerhet";



// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
