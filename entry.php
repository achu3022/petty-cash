<?php 

include 'header.php'; 
$user_id=$_SESSION["user_id"];
include 'db.php';
$con1=new mysqli($servername,$username,$password,$database);

?>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Petty Cash Claim- Request</header>
                    </div>
                    <div class="card-body" id="bar-parent2">
                        <form action="entry-action.php" method="POST" enctype="multipart/form-data" id="myForm">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Enter ..." name="title"
                                            id="title">
                                    </div>
                                    <?php 
                                        $qry2 = "SELECT * FROM tbl_users ORDER BY short_name ASC ";
                                        $result2= $con1->query($qry2);
                                        if($result2->num_rows>0){
                                                $options= mysqli_fetch_all($result2,MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label>Submit To</label>
                                        <select class="form-control" name="submit_to" id="submit_to">
                                        <option>Select Admin</option>
                                        <?php foreach ($options as $option) {
                                                 echo '<option value="' . htmlspecialchars($option['user_id']) . '">' . htmlspecialchars($option['short_name']) . '</option>';
                                        } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php $qry1 = "SELECT currency FROM currencies ORDER BY currency ASC";

                                $result1= $con1->query($qry1);
                                if($result1->num_rows>0){
                                    $options= mysqli_fetch_all($result1,MYSQLI_ASSOC);
                                }
                                ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <select class="form-control" name="currency" id="currency">
                                            <option>Select Currency</option>
                                            <?php foreach ($options as $option) {
                                                    echo "<option>" . $option['currency'] . "</option>";
                                              } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Supporting docs</label>
                                        <input type="file" multiple class="form-control" placeholder="Enter ..."
                                            name="files[]" id="file_upload">
                                    </div>
                                    <button type="button" class="btn btn-info" id="submitBtn">Submit</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-scrollable">
                                    <table class="table" id="example1"></table>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="panel">
                                        <header class="panel-heading panel-heading-blue">
                                            Total Amount
                                        </header>
                                        <div class="panel-body">
                                            <b><span id="column-sum">0 </span> /-</b></div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$duty_rows = array();
$duty_json = json_encode($duty_rows);
?>
<?php include('data1.php'); ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var jsondata = <?php echo $jsonstring; ?>;
        var jsondatadiv = <?php echo $jsonstring_div; ?>;
        var jsondatasub = <?php echo $jsonstring_sdiv; ?>;
        var $container = $("#example1");
        var hot;

        $container.handsontable({
            height: 450,
            minCols: 12,
            colWidths: [80, 100, 100, 100, 100, 90, 90, 100, 90, 90, 90, 110],
            colHeaders: ["Sheet #", "Date", "Main Cat", "Sub Cat", "Job", "SO", "WO", "Company", "Division", "Sub div",
                "Amount", "Remarks"
            ],
            minSpareRows: 1,
            manualRowMove: true,
            licenseKey: "non-commercial-and-evaluation",
            stretchH: 'all',
            columns: [
                { data: '0' },
                { data: '1', type: 'date' },
                { data: '2' },
                { data: '3' },
                { data: '4' },
                { data: '5' },
                { data: '6' },
                { data: '7', type: 'dropdown', source: jsondata },
                { data: '8', type: 'dropdown', source: jsondatadiv },
                { data: '9', type: 'dropdown', source: jsondatasub },
                { data: '10' },
                { data: '11' },
            ],
            rowHeight: function (row) {
                return 10;
            },
            defaultRowHeight: 10,
            afterChange: function (change, source) {
                updateSum();
                var rc = $("#rc").val();
                if (rc === "" && source != 'loadData') {
                    alert("not saved");
                }
                if (source == 'loadData') {
                    return;
                }
                $.ajax({
                    url: 'entry_hot_action.php',
                    contentType: 'application/json', // Add this line
                    type: "POST",
                    data: JSON.stringify({ changes: change }), // Convert data to JSON
                    success: function (data) {
                        console.log(JSON.stringify({ changes: change }));
                      //  alert("Data transferred successfully!");
					 // alert ('data');
                    },
                    error: function (error) {
                        console.error("Error during data transfer:", error);
                        alert("Error during data transfer. Please check the console for details.");
                    }
                });
            },
        });

        hot = $container.handsontable('getInstance');

        const amountColumnIndex = 10;

        function updateSum() {
            if (hot) {
                let sum = 0;
                hot.getData().forEach(row => {
                    const cellValue = parseFloat(row[amountColumnIndex]);
                    if (!isNaN(cellValue)) {
                        sum += cellValue;
                    }
                });
                document.getElementById('column-sum').textContent = sum;
            }
        }

        $("#submitBtn").on("click", function () {
            var formData = new FormData($("#myForm")[0]);

            $.ajax({
                url: 'entry-action.php',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    //console.log("Data transferred successfully:", data);
					//alert(data);
					
                },
                error: function (error) {
                    console.error("Error during data transfer:", error);
                    alert("Error during data transfer. Please check the console for details.");
                }
            });
        });
    });
</script>

<?php include 'footer.php'; ?>
