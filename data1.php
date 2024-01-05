<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "table_dimensions";
$D="";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// company name picker
$sql = "SELECT short_name FROM tbl_dimensions WHERE dimension_type='1'";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [$row['short_name']];
}

// Division Picker
$sql_div = "SELECT short_name FROM tbl_dimensions WHERE dimension_type='2'";
$result_div = $conn->query($sql_div);

$data_div = [];
while ($row = $result_div->fetch_assoc()) {
    $data_div[] = [$row['short_name']];
}

//Subdivision Picker
$sql_sdiv = "SELECT short_name FROM tbl_dimensions WHERE dimension_type='3'";
$result_sdiv = $conn->query($sql_sdiv);

$data_sdiv = [];
while ($row_sdiv = $result_sdiv->fetch_assoc()) {
    $data_sdiv[] = [$row_sdiv['short_name']];
}
$conn->close();
  
$jsonstring= json_encode($data);
$jsonstring_div= json_encode($data_div);
$jsonstring_sdiv= json_encode($data_sdiv);
echo json_encode($D);
?>
