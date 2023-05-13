<?php 
error_reporting(~E_NOTICE); //ปิด  error (Notice: Undefined index:)

$servername = "localhost";
$username = "root";
$password = "";
$db = "br_kbank";

// $servername = "localhost";
// $username = "cloudwor_kb";
// $password = "Nxg*z5Q5Gu3O:6";
// $db = "cloudwor_kb";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
        date_default_timezone_set("Asia/Bangkok");
// Check connection
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
 ?>