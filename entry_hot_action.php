<?php
include 'db.php';
session_start();
echo $user_id = $_SESSION["user_id"];
echo $currentDate =date('y-m-d');

$query = "SELECT bill_id FROM bill_list WHERE submitted_by = '$user_id' AND submitted_date = '$currentDate' ORDER BY bill_id DESC LIMIT 1";
$result = $con->query($query);

if ($result) {
    $row = $result->fetch_assoc();

    if ($row !== null) {
        $bill_id= $row['bill_id'];
    } else {
        return false;
    }
}
echo "lastInsertedBillId:=".$bill_id;
 // Assuming user_id is set to 2
$tableNameBillDetails = 'bill_details'; // Replace with your actual table name
$changes = json_decode(file_get_contents("php://input"), true);

if (isset($changes['changes']) && is_array($changes['changes'])) {
    // Define arrays to store data
    $rowIndices = [];
    $columnIndices = [];
    $dataValues = [];

    foreach ($changes['changes'] as $change) {
        // Skip changes without data
        if (!isset($change[3])) {
            continue;
        }

        $rowIndex = $change[0];
        $columnIndex = $change[1];
        $dataValue = $change[3];

        // Store data in arrays
        $rowIndices[] = $rowIndex;
        $columnIndices[] = $columnIndex;
        $dataValues[] = $dataValue;
    }

    // Database connection
    // $con = new mysqli("your_db_host", "your_db_username", "your_db_password", "your_db_name");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Insert data into the database
    for ($i = 0; $i < count($rowIndices); $i++) {
        $rowIndex = $rowIndices[$i];
        $columnIndex = $columnIndices[$i];
        $dataValue = $dataValues[$i];

        $columnName = ''; // Replace with the actual column name based on your table structure
        switch ($columnIndex) {
            case 1:
                // Assuming you want to insert the current date for 'bill_date'
                $columnName = 'bill_date';
                $dataValue = date('Y-m-d', strtotime($dataValue));
                
                break;
            case 2:
                // Assuming 'main_cat' should be the value of 'job'
                $columnName = 'main_cat';
                break;
            case 3:
                $columnName = 'sub_cat';
                break;
            case 4:
                $columnName = 'job';
                break;
            case 5:
                $columnName = 'so';
                break;
            case 6:
                $columnName = 'wo';
                break;
            case 7:
                $columnName = 'company';
                break;
            case 8:
                $columnName = 'division';
                break;
            case 9:
                $columnName = 'sub_div';
                break;
            case 10:
                $columnName = 'amount';
                break;
            case 11:
                $columnName = 'remarks';
                break;
            // Add cases for other column indices...
        }
        
        if (!empty($columnName)) {
            $insertQuery = "INSERT INTO $tableNameBillDetails (bill_id,user_id, $columnName) VALUES (?, ?,?)";
            $stmt = $con->prepare($insertQuery);

            if ($stmt) {
                $stmt->bind_param('iss',$bill_id, $user_id, $dataValue);
                $stmt->execute();

                if ($stmt->error) {
                    echo json_encode(['success' => false, 'message' => 'Error inserting into database: ' . $stmt->error]);
                    // Handle the error appropriately
                } else {
                    // After successful insertion, get the corresponding bill_id from bill_list
                    
                }

                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $con->error]);
                // Handle the error appropriately
            }
        }
    }

    $con->close();
}

?>
