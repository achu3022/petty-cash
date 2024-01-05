<?php 
include 'header.php';
$bill_id = $_GET['bill_id'];
require_once('db.php');
//$con = new mysqli($servername,$username,$password,'demo_petty');
if($con->connect_error)
{
		die ("Connection Failed: " .$con->connect_error);
}

 
?>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Lightbox CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }

        .thumbnail-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #ffffff; /* Set your desired background color */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .thumbnail {
            margin: 10px;
        }

        .thumbnail img {
            width: 150px;
            height: 150px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<!-- start page content -->
<div class="page-content-wrapper">
				<div class="page-content">
					<!-- <div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Form Layouts</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="">Forms</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Form Layouts</li>
							</ol>
						</div>
					</div> -->
					<div class="page-bar"></div>
					<!-- <div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="card card-box">
								<div class="card-head">
									<header>Simple Form</header>
									<button id="panel-button"
										class="mdl-button mdl-js-button mdl-button--icon pull-right"
										data-upgraded=",MaterialButton">
										<i class="material-icons">more_vert</i>
									</button>
									<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
										data-mdl-for="panel-button">
										<li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
										</li>
										<li class="mdl-menu__item"><i class="material-icons">print</i>Another action
										</li>
										<li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
											here</li>
									</ul>
								</div>
								<div class="card-body " id="bar-parent">
									<form>
										<div class="form-group">
											<label for="simpleFormEmail">Email address</label>
											<input type="email" class="form-control" id="simpleFormEmail"
												placeholder="Enter email address">
										</div>
										<div class="form-group">
											<label for="simpleFormPassword">Password</label>
											<input type="password" class="form-control" id="simpleFormPassword"
												placeholder="Password">
										</div>
										<div class="form-group">
											<div class="checkbox checkbox-icon-black">
												<input id="rememberChk1" type="checkbox" checked="checked">
												<label for="rememberChk1">
													Remember me
												</label>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
						
					</div> -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Petty Cash Claim- Request</header>
									<button id="panel-button3"
										class="mdl-button mdl-js-button mdl-button--icon pull-right"
										data-upgraded=",MaterialButton">
										<i class="material-icons">more_vert</i>
									</button>
									<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
										data-mdl-for="panel-button3">
										<li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
										</li>
										<li class="mdl-menu__item"><i class="material-icons">print</i>Another action
										</li>
										<li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
											here</li>
									</ul>
								</div>
								<div class="card-body " id="bar-parent2">
								<form>
									<div class="row">
						<div class="col-md-12">
							<div class="white-box">
								<h3><b>Pettycash</b> <span class="pull-right">Invoice Number: <?php echo $bill_id; ?></span></h3>
								<hr><hr>
								<div class="row">
									<div class="col-md-12">
										<!-- <div class="pull-left">
											<address>
												<img src="../assets/img/invoice_logo.png" alt="logo"
													class="logo-default" />
												<p class="text-muted m-l-5">
													Aditya University, <br> Opp. Town Hall, <br>
													Sardar Patel Road, <br> Ahmedabad - 380015
												</p>
											</address>
										</div> -->
										<!-- <div class="pull-right text-right">
											<address>
												<p class="addr-font-h3">To,</p>
												<p class="font-bold addr-font-h4">Jayesh Patel</p>
												<p class="text-muted m-l-30">
													207, Prem Sagar Appt., <br> Near Income Tax Office, <br>
													Ashram Road, <br> Ahmedabad - 380057
												</p>
												<p class="m-t-30">
													<b>Invoice Date :</b> <i class="fa fa-calendar"></i> 14th
													July 2017
												</p>
												<p>
													<b>Course :</b> Engineering
												</p>
											</address>
										</div> -->
									</div>
									<div class="col-md-12">
										<div class="table-responsive m-t-40">
											<table class="table table-hover">
												<thead>
													<tr>
														<th class="text-center">Sl no.</th>
														<th class="text-center">Fees Type</th>
														<th class="text-center">Freequency</th>
														<th class="text-center">Date</th>
														<th class="text-center">Invoice number</th>
														<th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
														<th class="text-center">Actions</th>
													</tr>
												</thead>
												<tbody>
												<?php
                            $i=1;
                            $total=0;
                            $sql = "SELECT bill_list.bill_id, bill_list.title, bill_list.currency, bill_list.submit_to, bill_list.submitted_by, bill_list.submitted_date, bill_list.file_names,
                            bill_details.bill_date, bill_details.main_cat, bill_details.sub_cat, bill_details.job, bill_details.so, bill_details.wo, bill_details.company, bill_details.division, bill_details.sub_div,
                            bill_details.amount, bill_details.remarks, bill_details.bill_status, bill_details.user_id, bill_details.bill_dt_id
                            FROM bill_list
                            JOIN bill_details ON bill_list.bill_id = bill_details.bill_id WHERE bill_details.bill_id=$bill_id && bill_list.bill_id=$bill_id";

                            $result =$con->query($sql);

															while($row=$result->fetch_assoc())
															{
                                $status=$row['bill_status'];
                                if($status==0){
                                    $st='<span class="label label-sm label-warning">Pending</span>';
                                }
                                elseif($status==1){
                                    $st='<span class="label label-sm label-success">Approved</span>';
                                } 
                                elseif($status==2){
                                    $st='<span class="label label-sm label-danger">Rejected</span>';
                                }
																 echo "<tr><td class='text-center'>"
                                .$i."</td><td class='text-center'>"
																.$row['title']."</td><td class='text-center'>"
																.$row['company']."</td><td class='text-center'>"
																.$row['bill_date']."</td><td class='text-center'>"
																.$row['bill_id']."</td><td class='text-center'>"
																.$row['amount']."</td><td class='text-center'>"
                                .$st."</td><td class='text-center'>
																<button type=button class='btn btn-circle btn-info btn-xs m-b-10'
																data-bs-toggle='modal' data-bs-target='#exampleModal' id = 'edit_amount' data-amount='".$row['amount']."'>Edit</button>
																
																<button type=button class='btn purple btn-circle  btn-xs m-b-10'
																data-bs-toggle='modal' data-bs-target='#exampleModal2' id= 'split_button' data-amount='".$row['amount']."'  data-type='".$i."'>Slpit</button>
																
																<button type=button class='btn btn-circle btn-danger mdl-button--raised mdl-js-ripple-effect btn-xs m-b-10'
        														data-bs-toggle='modal' data-type='dialog7'
        														onclick='showDialog7(\"".$row['amount']."\", \"".$row['bill_id']."\")'
        														data-amount='".$row['amount']."' data-bill-id='".$row['bill_id']."'>Delete
																</button>

																														
																";
																
																$total=$total+$row['amount'];

																$i++;

															}
															?>												

													</tr>
											
												</tbody>
											</table>
										</div>
									</div>

                  <!-- ##### Thumbnails and popup section start ##### -->
<h3 >Uploaded Bills</h3>
							<?php
                function getFileExtension($fileName) 
                {
                      return pathinfo($fileName, PATHINFO_EXTENSION);
                }
            
                $file_query = "SELECT * FROM bill_list WHERE bill_id=$bill_id";
                $file_list = $con->query($file_query);
                echo '<div class="thumbnail-container">';
                while ($row = $file_list->fetch_assoc()) 
                {
                    $fileNames = explode(',', $row['file_names']);
                        foreach ($fileNames as $fileName) 
                        {
                              $extension = getFileExtension($fileName);
                              $fileUrl = 'bills_uploaded/' . $fileName;
                              if ($extension === 'pdf') 
                              {
                                // Display PDF thumbnail and open in a viewer on click
                                    echo '<div class="thumbnail">';
                                    echo '<a href="' . $fileUrl . '" data-lightbox="pdf" data-title="' . $row['title'] . '">';
                                    echo '<img src="assets/img/pdficon.png" alt="PDF Thumbnail">';
                                    echo '</a>';
                                    echo '</div>';
                              } elseif (in_array($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
                                // Display image thumbnail and open in a lightbox on click
                                    echo '<div class="thumbnail">';
                                    echo '<a href="' . $fileUrl . '" data-lightbox="images" data-title="' . $row['title'] . '">';
                                    echo '<img src="' . $fileUrl . '" alt="Image Thumbnail">';
                                    echo '</a>';
                                    echo '</div>';
                              }
                        }
                }
                    echo '</div>';
              ?>

<!-- ##### Thumbnails and popup section end ##### -->

									<div class="col-md-9">
										<div class="pull-right m-t-10 text-right">
											<
											<!-- <hr>
											<hr> -->
											<h3><b>Total :</b> <?php echo $total; ?> /-</h3>
											<button type="button" class="btn btn-circle btn-success m-b-10" onclick='billApprove()' >Approve</button>
											<button type="button" class="btn btn-circle btn-danger btn-primary m-b-10" onclick="billReject()" >Reject</button>
										</div>
										<div class="clearfix"></div>
										<hr>
										
									</div>
									<hr>
								</div>
							</div>
						</div>
					</div>
</form>
								</div>

							</div>
						</div>
					</div>
					
			
					
				</div>


			</div>
				

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Bill Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<div class="modal-body">
<form >

<label>Item</label>
<div class="form-group">
<input type="text" name="modal1Type" id="" class="form-control" placeholder="Full Name" value="Travel">
</div>

<label>Rate</label>
<div class="form-group">
<input type="text" name="modal1Amount" id="modal1Amount" class="form-control" placeholder="" value="">
</div>
</form>
 </div>
<div class="modal-footer">
<button type="button" class="btn btn-success" data-bs-dismiss="modal" onClick="updateBill()">Submit

</button> 
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
 </div>
    </div>
  </div>
</div>





<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Head">Split Amount | Petty Cash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card card-topline-purple">
          <div class="card-head">
            <div class="tools">
              <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
              <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
              <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div>
          </div>
          <div class="card-body ">
		  <button type="button" class="btn btn-success" id="addRowBtn">+</button>
		 <!-- <button type="button" class="btn btn-danger" id="addRowBtn">-</button>-->

            <div class="table-responsive">
              <table class="table" id="dynamicTable">
                <thead>
                  <tr>
                    <th> Sheet #</th>
                    <th>Date</th>
                    <th>Main Cat</th>
                    <th>Sub Cat</th>
                    <th>Job</th>
                    <th>SO</th>
                    <th>WO</th>
                    <th>Company</th>
                    <th>Division</th>
                    <th>Sub div</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
                <tbody id="splitModalTableBody">
                  <!-- Table body content will be dynamically populated here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="conditionalFooter">
	  <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onClick="splitSave()">Save</button>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var splitButton = document.getElementById('split_button');
    var addRowBtn = document.getElementById('addRowBtn');
    var removeRowBtn = document.getElementById('removeRowBtn');
    var dynamicTable = document.getElementById('dynamicTable');

    var rowCounter = 0; // Initial number of rows

    // Add a header row
    var headerRow = dynamicTable.createTHead().insertRow();
    var headers = ['Sheet #', 'Date', 'Main Cat', 'Sub Cat', 'Job', 'SO', 'WO', 'Company', 'Division', 'Sub Div', 'Amount', 'Remarks'];

    headers.forEach(function (headerText) {
        var th = document.createElement('th');
        th.innerHTML = headerText;
        headerRow.appendChild(th);
    });

    splitButton.addEventListener('click', function () {
        var amount = this.getAttribute('data-amount');
        var type = this.getAttribute('data-type');
        fetchAndDisplayDetails(amount, type);
    });

    function fetchAndDisplayDetails(amount, type) {
        var bill_id = <?php echo json_encode($_GET['bill_id']); ?>;
        var url = 'fetch-details.php?amount=' + amount + '&bill_id=' + bill_id;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Populate the table in the modal with the retrieved data
                populateTable(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function populateTable(data) {
        // Clear existing rows
        dynamicTable.innerHTML = '';

        data.forEach(function (row, index) {
            var newRow = dynamicTable.insertRow();

            // Add cells to the new row
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);
            var cell7 = newRow.insertCell(6);
            var cell8 = newRow.insertCell(7);
            var cell9 = newRow.insertCell(8);
            var cell10 = newRow.insertCell(9);
            var cell11 = newRow.insertCell(10);
            var cell12 = newRow.insertCell(11);

            // Make cells content-editable
            cell1.innerHTML = (index + 1).toString(); // Row number
            cell2.innerHTML = row.bill_date;
            cell3.innerHTML = row.main_cat;
            cell4.innerHTML = row.sub_cat;
            cell5.innerHTML = row.job;
            cell6.innerHTML = row.so;
            cell7.innerHTML = row.wo;
            cell8.innerHTML = row.company;
            cell9.innerHTML = row.division;
            cell10.innerHTML = row.sub_div;
            cell11.innerHTML = row.amount;
            cell12.innerHTML = row.remarks;

            rowCounter++;
      

    addRowBtn.addEventListener('click', function () {
        // Add a new row to the table
        var newRow = dynamicTable.insertRow();

        // Add cells to the new row
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        var cell9 = newRow.insertCell(8);
        var cell10 = newRow.insertCell(9);
        var cell11 = newRow.insertCell(10);
        var cell12 = newRow.insertCell(11);

        // Make cells content-editable
        cell1.innerHTML = (rowCounter + 1).toString(); // Row number
        cell2.innerHTML = row.bill_date; // Assuming this is for 'bill_date'
        cell3.innerHTML = row.main_cat;
        cell4.innerHTML = row.sub_cat;
        cell5.innerHTML = row.job;
        cell6.innerHTML = row.so;
        cell7.innerHTML = row.wo;
        cell8.innerHTML = row.company;
        cell9.innerHTML = row.division;
        cell10.innerHTML = row.sub_div;
        cell11.contentEditable  = true;
        cell12.innerHTML  = row.remarks;
		cell12.contentEditable=true;
        rowCounter++;
    });
  });
    }
    removeRowBtn.addEventListener('click', function () {
        // Remove the last row from the table
        if (rowCounter > 0) {
            dynamicTable.deleteRow(-1);
            rowCounter--;
        }
    });
});

function splitSave(newRowData) {
    // Get bill_id and emp_id from the page URL
    var bill_id = <?php echo json_encode($_GET['bill_id'] ?? ''); ?>;
    var emp_id = <?php echo json_encode($_GET['emp_id'] ?? ''); ?>;

    // Check if bill_id and emp_id are not empty before sending the request
    if (bill_id && emp_id) {
        $.ajax({
            type: "POST",
            url: "split_data.php",
            data: { 
                newRowData: JSON.stringify(newRowData),
                bill_id: bill_id,
                emp_id: emp_id 
            },           
            dataType: "json",
            contentType: 'application/json',
            success: function (response) {
                // Handle the success response
                console.log('New row inserted successfully:', response);
            },
            error: function (error) {
                // Handle the error response
                console.error('Error inserting new row:', error);
            }
        });
    } else {
        console.error('Error: bill_id or emp_id is empty');
    }
}
</script>


<!-- end page container -->

		<?php include 'footer.php';
		$duty_rows=array();
	$duty_json = json_encode($duty_rows);	
		?>
	<script src="assets/plugins/material/material.min.js"></script>
	<script src="assets/plugins/sweet-alert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweet-alert/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
             
		var $container = $("#example1");
      $container.handsontable({
		height: 450,
		minCols: 12,
  colWidths: [80, 100, 100, 100, 100, 90, 90, 100, 90,90, 90, 110],
  colHeaders: [
    "Sheet #",
    "Date",
    "Main Cat",
    "Sub Cat",
    "Job",
    "SO",
    "WO",
    "Company",
    "Division",
	"Sub div",
	"Amount",
	"Remarks"
  ],
  minSpareRows: 1,
  manualRowMove: true,
		licenseKey: "non-commercial-and-evaluation",
		rowHeight: function (row) {
  return 10;
},
defaultRowHeight: 10,
	  });
	  function showDialog7(billId,amount) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
		$.ajax({
        type: "POST",
        url: "delete.php",
        data: { bill_id: amount, amount: billId },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
          } else {
            Swal.fire("Error", "Failed to delete: " + response.error, "error");
          }
        },
        error: function () {
          //Swal.fire("Error", "Failed to communicate with the server.", "error");
		  console.error("AJAX Error: " + textStatus, errorThrown);
		  location.reload();
        },
      });
      Swal.fire("Deleted!", "Your file has been deleted.", "success");
	  location.reload();

    }
  });
}		

		</script>
        <!--********       Script For Amount Displaying In Modal       ********-->
	<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.btn-info');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var amount = this.getAttribute('data-amount');
				//alert(amount);
                document.getElementById('modal1Amount').value = amount;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('#split_button');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var amount = this.getAttribute('data-amount');
				var type = this.getAttribute('data-type');
				//alert(type);        
				//alert(amount);
                document.getElementById('modal2Head').innerHTML = type +" | "+ amount;
            });
        });
    });
// Modal Update Script //
	function updateBill()
	{
		var bill_id = <?php echo json_encode($_GET['bill_id']); ?>;
		var amount= document.getElementById('modal1Amount').value;
		//alert (amount);
		//Ajax portion
		$.ajax({
        type: "POST",
        url: "update.php",
        data: { bill_id:bill_id,amount:amount },
        dataType: "json",
        success: function (data) {
                    //console.log("Data transferred successfully:", data);
					//alert(data);
					location.reload();

                },
                error: function (error) {
                    //console.error("Error during data transfer:", error);
                    //alert("Error during data transfer. Please check the console for details.");
					location.reload();
				}
        
      });
	}

	//Approve all bills
  function billApprove()
  {
    var bill_id = <?php echo json_encode($_GET['bill_id']); ?>;
    var status='1';
    //alert("hello"+status);
    Swal.fire({
    title: "Are you sure?",
    text: "Appove this bill !",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Approved it!",
  }).then((result) => {
    if (result.value) {
		$.ajax({
        type: "POST",
        url: "bill-approve.php",
        data: { bill_id: bill_id,status:status },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Swal.fire("Approved!", "This bill has been Approved.", "success");
          
          } else {
            Swal.fire("Error", "Failed to delete: " + response.error, "error");
          }
        },
        error: function () {
          //Swal.fire("Error", "Failed to communicate with the server.", "error");
		  console.error("AJAX Error: " + textStatus, errorThrown);
      location.reload();  
    },
      });
      Swal.fire("Error!", "This bill is already submitted.", "error");

    }
  });
}		

//Bill rejection

function billReject()
  {
    var bill_id = <?php echo json_encode($_GET['bill_id']); ?>;
    var status ='2';
    //alert("hello"+status);
    Swal.fire({
    title: "Are you sure?",
    text: "Reject this bill !",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
		$.ajax({
        type: "POST",
        url: "bill-approve.php",
        data: { bill_id: bill_id,status:status },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Swal.fire("Deleted!", "This file has been deleted.", "success");
          } else {
            Swal.fire("Error", "Failed to delete: " + response.error, "error");
          }
        },
        error: function () {
          //Swal.fire("Error", "Failed to communicate with the server.", "error");
		  console.error("AJAX Error: " + textStatus, errorThrown);
		  location.reload();
        },
      });
      Swal.fire("Error!", "This bill already rejeted.", "error");

    }
  });
}		
 </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>