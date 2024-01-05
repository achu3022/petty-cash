<?php
require_once('db.php');
//$con = new mysqli($servername, $username, $password, 'demo_petty');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required parameters are set
    if (isset($_POST["bill_id"]) && isset($_POST["amount"])) {
        $billId = $_POST["bill_id"];
        $amount = $_POST["amount"];
        
        $deleteSql = "DELETE FROM bill_details WHERE bill_id = $billId AND amount = $amount";
        $con->query($deleteSql);
    }
}

//UPDATION


?>                