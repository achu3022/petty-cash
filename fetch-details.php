<?php
// Replace the following with your database connection logic
require_once('db.php');

$amount = $_GET['amount'];
$bill_id = $_GET['bill_id'];

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bill_details WHERE amount = $amount and bill_id = '$bill_id'";
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');

echo json_encode($rows);
?>
