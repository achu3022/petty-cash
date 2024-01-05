<?php
session_start();
require_once('db.php');

$submited_to = $_POST["submit_to"];
$currency = $_POST["currency"];
$title = $_POST["title"];
$file_name =  array();    
$date = date("Ymd");
$current_action = 00;
$submited_by = $_SESSION["user_id"];//using session user_id is needed

$imfileName='';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Function to generate a unique file name based on date and a counter
function generateUniqueFileName($uploadDirectory, $fileExtension) {
    $counterFileName = $uploadDirectory . 'counter.txt';

    if (!file_exists($counterFileName)) {
        file_put_contents($counterFileName, '0000');
    }

    $counter = str_pad(file_get_contents($counterFileName), 4, '0', STR_PAD_LEFT);
    $newFileName = 'bill_' . date('Ymd') . '_' . $counter . '.' . $fileExtension;

    file_put_contents($counterFileName, str_pad($counter + 1, 4, '0', STR_PAD_LEFT));

    return $newFileName;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $uploadDirectory = 'bills_uploaded/';
if($submited_to==0 || $currency =='Select Currency')
{
    echo "Enter the values";
}
else{


    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $fileExtension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
        $fileName = generateUniqueFileName($uploadDirectory, $fileExtension);
        $targetFilePath = $uploadDirectory . $fileName;

        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFilePath)) {
            // Insert Bill information into the database
        }

        $imfileName = $imfileName . $fileName . ',';
    }

    try {
        $insertQuery = "INSERT INTO bill_list(bill_id,title,currency,submit_to,submitted_by,submitted_date,file_names,current_action)
                        VALUES ('','$title','$currency','$submited_to','$submited_by','$date','$imfileName','$current_action')";
        if ($con->query($insertQuery) === TRUE) {
            echo "Files have been uploaded and information stored in the database successfully.<br>";
        } else {
            echo "Error inserting information into the database: " . $con->error . "<br>";
        }
    } catch (mysqli_sql_exception $e) { 
        var_dump($e);
        exit; 
    }

    echo $imfileName . "<br>";
}
}

//header("location: entry.php");

$con->close();
?>
