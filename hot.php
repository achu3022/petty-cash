<?php
include 'db.php';
$nullValue = 0;
$zeroValue = 0;
$user_id = 2; // Assuming user_id is set to 2
$tableNameBillList = 'bill_list';
$tableNameBillDetails = 'bill_details';
$current_date=date('y-m-d');
// Get the changes sent from Handsontable
$changes = json_decode(file_get_contents("php://input"), true);

if (isset($changes['changes']) && is_array($changes['changes'])) {

    foreach ($changes['changes'] as $change) {
        // Check if the date and id keys are defined in $change
        if (isset($change[3]) && isset($change[0])) {
            // Handle the case where the value is an integer
            if (is_int($change[3])) {
                echo json_encode(['success' => false, 'message' => 'Error: Invalid data format for value ' . $change[3]]);
                continue; // Skip processing this row if the data format is invalid
            }

            // Assume $formattedDate is the first element of the array
            $formattedDate = is_array($change[3]) ? $change[3][0] : $change[3];

            // Check the date format and convert if necessary
            if (strpos($formattedDate, '/') !== false) {
                // Convert the date format to 'Y-m-d'
                $date = DateTime::createFromFormat('d/m/Y', $formattedDate);

                if ($date !== false) {
                    // Date conversion successful
                    $formattedDate = $date->format('Y-m-d');
                } else {
                    // Handle the case where date conversion fails
                    echo json_encode(['success' => false, 'message' => 'Error converting date format for value ' . $change[3]]);
                    // Log or handle the error appropriately
                    continue; // Skip processing this row if date conversion fails
                }
            }

            // Step 1: Select bill_id from bill_list based on submitted_by and current date
            $selectBillIdQuery = "SELECT bill_id FROM $tableNameBillList WHERE submitted_by = '$user_id' AND date(submitted_date) = '$current_date'";
            $selectBillIdResult = $con->query($selectBillIdQuery);

            if ($selectBillIdResult === false) {
                // Handle the case where the select query fails
                echo json_encode(['success' => false, 'message' => 'Error selecting bill_id: ' . $con->error]);
            } else {
                // Fetch the result
                $row = $selectBillIdResult->fetch_assoc();
                if ($row) {
                    // Step 2: Insert the obtained bill_id into bill_details for the same user
                    $bill_id = $row['bill_id'];

                    // Insert query
                    $insertBillDetailsQuery = "INSERT INTO $tableNameBillDetails (bill_id, user_id) VALUES ('$bill_id', '$user_id')";
                    $insertBillDetailsResult = $con->query($insertBillDetailsQuery);

                    if ($insertBillDetailsResult === false) {
                        // Handle the case where the insert query fails
                        echo json_encode(['success' => false, 'message' => 'Error inserting into bill_details: ' . $con->error]);
                    } else {
                        // Step 3: Use the inserted bill_id to perform updates in bill_details based on bill_dt_id
                        $bill_dt_id = $con->insert_id; // Assuming auto-incremented column

                        // Prepare values for SQL update
                        $main_cat = isset($change[4]) ? $change[4] : null;
                        $sub_cat = isset($change[5]) ? $change[5] : null;
                        $job = isset($change[6]) ? $change[6] : null;
                        $so = isset($change[7]) ? $change[7] : null;
                        $wo = isset($change[8]) ? $change[8] : null;
                        $company = isset($change[9]) ? $change[9] : null;
                        $division = isset($change[10]) ? $change[10] : null;
                        $sub_div = isset($change[11]) ? $change[11] : null;
                        $amount = isset($change[12]) ? $change[12] : null;
                        $remarks = isset($change[13]) ? $change[13] : null;

                        // Build the SET part of the SQL update statement
                        $setClause = "";
                        if ($main_cat !== null) $setClause .= "main_cat = '$main_cat', ";
                        if ($sub_cat !== null) $setClause .= "sub_cat = '$sub_cat', ";
                        if ($job !== null) $setClause .= "job = '$job', ";
                        if ($so !== null) $setClause .= "so = '$so', ";
                        if ($wo !== null) $setClause .= "wo = '$wo', ";
                        if ($company !== null) $setClause .= "company = '$company', ";
                        if ($division !== null) $setClause .= "division = '$division', ";
                        if ($sub_div !== null) $setClause .= "sub_div = '$sub_div', ";
                        if ($amount !== null) $setClause .= "amount = '$amount', ";
                        if ($remarks !== null) $setClause .= "remarks = '$remarks', ";

                        // Remove the trailing comma
                        $setClause = rtrim($setClause, ', ');

                        // Execute the SQL UPDATE statement
                        $updateQuery = "UPDATE $tableNameBillDetails SET $setClause WHERE bill_dt_id = '$bill_dt_id' AND user_id = '$user_id'";

                        $updateResult = $con->query($updateQuery);

                        if ($updateResult === false) {
                            // Handle the case where the update query fails
                            echo json_encode(['success' => false, 'message' => 'Error updating bill_details: ' . $con->error]);
                        }
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'No matching record found in bill_list for the current date and submitted_by']);
                }
            }
        }
    }

    echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
} else {
    // No changes to save
    echo json_encode(['success' => false, 'message' => 'No changes to save']);
}
?>
