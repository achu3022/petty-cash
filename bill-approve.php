<?php
require_once('db.php');
//$con = new mysqli($servername, $username, $password, 'demo_petty');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required parameters are set
    if (isset($_POST["bill_id"])&& isset($_POST['status'])) {
        $billId = $_POST["bill_id"];
        $status = $_POST["status"];
        $selsql="SELECT  bill_status FROM bill_details WHERE bill_id ='$billId'";
        $result = $con->query($selsql);
        while ($row = $result->fetch_assoc()) {
            $data = $row['bill_status'];
        }
        echo "billstatus $data";
        echo "form status $status";
if ($data==0 && $status==1)
       { $updateSql = "UPDATE bill_details SET bill_status = '1' WHERE bill_id = '$billId'";

        // Execute the update query
        if ($con->query($updateSql)) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => $con->error));
        }
    }
        elseif($data==0 && $status==2)
    {
        
echo $billId;
echo $status;
echo $data;
        // Update query
        $updateSql = "UPDATE bill_details SET bill_status = '2' WHERE bill_id = '$billId'";

        // Execute the update query
        if ($con->query($updateSql)) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => $con->error));
        }
    }
}
    }
