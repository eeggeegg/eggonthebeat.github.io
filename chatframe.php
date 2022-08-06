<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT * FROM (
    SELECT * FROM messages ORDER BY msgid DESC LIMIT 100 /*amount of messages to pull up yeyee*/ 
) sub
ORDER BY msgid ASC
";

//$sql = "SELECT * FROM messages";
$res = $conn->query($sql);

function clean($msg) {
    $msg = str_replace(";", "&semi;", $msg);
    $msg = str_replace("<", "&lt;", $msg);
    $msg = str_replace(">", "&gt;", $msg);
    $msg = str_replace("'", "&apos;", $msg);

    return $msg;
}
function georgeEvt() {
    echo "event: george\n";
}
echo "event: update\n";

if ($res->num_rows > 0) 
{
    while($row = $res->fetch_assoc()) {
        
        $msg = $row["message"];
        $msg = clean($msg);
        if(strpos($msg, "https://")!== false) {
            $msg = '<a href="' . $msg . '">'. $msg .'</a>';
        }

        

        $msg = str_replace(":sealer:", "<img src='/img/sealdecal.png' alt=':)' id='sealer'>", $msg);
        $msg = str_replace(":egg:", "<img src='/img/eggdecal.png' alt=':)' id='eggman'>", $msg);
        echo "data: [" . $row["timestring"] . "] " . $row["username"] . " » " . $msg . "<br>\n\n";
    }
    georgeEvt();
    echo "data: <br>\n\n";
    
}

$conn->close();
flush();
?>
