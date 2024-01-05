<?php
require_once('db.php');

// Get the JSON data sent from the client
$newRowData = json_decode($_POST['newRowData'], true);

// Extract data from the JSON object
$date = $newRowData['date'];
$mainCat = $newRowData['mainCat'];
$sub_cat = $newRowData['sub_cat'];
$job = $newRowData['job'];
$so = $newRowData['so'];
$wo = $newRowData['wo'];
$company = $newRowData['company'];
$division = $newRowData['division'];
$sub_div = $newRowData['sub_div'];
$amount = $newRowData['amount'];
$remarks = $newRowData['remarks'];

// Assuming you have sanitized and validated your data (use your own functions for this)
$date = mysqli_real_escape_string($con, $date);
$mainCat = mysqli_real_escape_string($con, $mainCat);
$sub_cat = mysqli_real_escape_string($con, $sub_cat);
$job = mysqli_real_escape_string($con, $job);
$so = mysqli_real_escape_string($con, $so);
$wo = mysqli_real_escape_string($con, $wo);
$company = mysqli_real_escape_string($con, $company);
$division = mysqli_real_escape_string($con, $division);
$sub_div = mysqli_real_escape_string($con, $sub_div);
$amount = mysqli_real_escape_string($con, $amount);
$remarks = mysqli_real_escape_string($con, $remarks);

// Get emp_id and bill_id from the POST data
$emp_id = $_POST['emp_id'];
$bill_id = $_POST['bill_id'];

// Insert the new row into the "bill_details" table
$sql = "INSERT INTO bill_details (bill_id, bill_date, main_cat, sub_cat, job, so, wo, company, division, sub_div, amount, remarks, bill_status, emp_id)
        VALUES ('$bill_id', '$date', '$mainCat', '$sub_cat', '$job', '$so', '$wo', '$company', '$division', '$sub_div', '$amount', '$remarks', '0', '$emp_id')";

if ($con->query($sql) === TRUE) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'error' => $con->error);
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
$con->close();
?>
