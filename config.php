<?php
define('DB_SERVER', 'sql2.7m.pl');
define('DB_USERNAME', 'eggland_eggchat');
define('DB_PASSWORD', 'qgj9j02v16');
define('DB_NAME', 'eggland_eggchat');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($conn === false){
    die("ERROR: Could not connect. " . $conn->connect_error);
}
?>