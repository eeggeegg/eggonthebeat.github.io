<?php header("location: index.php");

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$msg = $_POST["msg"];

require_once "config.php";

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$date = date('H:i m/d');
$ip = $_SERVER['REMOTE_ADDR'];
$date_str = "$date";
$name = $_SESSION["username"];
$timestamp = strtotime($date_str);
$sql = "INSERT INTO messages (msgid, message, username, timestring) VALUES (0, '$msg', '$name', '$date_str')";
if ($_POST['msg'] != "") {
    if($conn->query($sql)==TRUE) {
        $last_id = $conn->insert_id;
        //echo "ok man";
    } 
    else {
        //echo "fail army: " . $sql . "<br>" . $conn->error; 
    }
} else {
    //echo "Empty message";
}


$conn->close();
exit;
?>