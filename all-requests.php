<?php
// Include header and database connection
include 'header.php';
include 'db.php';
$user_id=$_SESSION["user_id"];

// Database connection for demo_petty
//$mysqli = mysqli_connect('localhost', 'root', '', 'demo_petty');

// Calculate total pages for pagination
$total_pages = $con->query("SELECT COUNT(*) FROM bill_details WHERE user_id=$user_id")->fetch_row()[0];

// Set the number of results per page
$num_results_on_page = 5;

// Set the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Fetch results for the current page
$sql = "SELECT bd.bill_id, bd.bill_date, bd.main_cat, bd.sub_cat, bd.job, bd.wo, bd.so, bd.company, bd.division, bd.sub_div, bd.amount, bd.remarks, bd.bill_status, bd.user_id, us.short_name, us.user_id, us.emp_division_id AS emp_division
FROM pettycash.bill_details bd
JOIN pettycash.tbl_users us ON bd.user_id = us.user_id
WHERE bd.user_id = $user_id
ORDER BY bd.bill_date DESC
LIMIT ?, ?";

$stmt = $con->prepare($sql);

// Check for errors in the prepared statement
if (!$stmt) {
    die('Error in preparing statement: ' . $con->error);
}

$calc_page = ($page - 1) * $num_results_on_page;

$stmt->bind_param('ii', $calc_page, $num_results_on_page);

$stmt->execute();

// Check for errors in the execution of the statement
if ($stmt->error) {
    die('Error in executing statement: ' . $stmt->error);
}

$result = $stmt->get_result();
$stmt->close();

?>

<!-- Your HTML and other code here -->

<style>
    .pagination {
        list-style-type: none;
        padding: 10px 0;
        display: inline-flex;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .pagination li {
        box-sizing: border-box;
        padding-right: 10px;
    }

    .pagination li a {
        box-sizing: border-box;
        background-color: #e2e6e6;
        padding: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        color: #616872;
        border-radius: 4px;
    }

    .pagination li a:hover {
        background-color: #d4dada;
    }

    .pagination .next a,
    .pagination .prev a {
        text-transform: uppercase;
        font-size: 12px;
    }

    .pagination .currentpage a {
        background-color: #518acb;
        color: #fff;
    }

    .pagination .currentpage a:hover {
        background-color: #518acb;
    }
</style>

<div class="page-content-wrapper">
    <!-- ... (Your existing HTML) ... -->
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
            <thead>
                <tr>
                    <th class="center">Bill Id</th>
                    <th class="center"> Employee Name </th>
                    <th class="center"> Employee Id </th>
                    <th class="center"> Division </th>
                    <th class="center"> SubDivision </th>
                    <th class="center"> Type </th>
                    <th class="center"> Status </th>
                    <th class="center"> Amount</th>
                    <th class="center"> Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output results
                while ($row = $result->fetch_assoc()) {
                    $status=$row['bill_status'];
                    if($status==0){
                        $st='<span
                        class="label label-sm label-warning">Pending</span>';
                    }
                    elseif($status==1){
                        $st='<span
                        class="label label-sm label-success">Paid</span>';
                    }
                    elseif($status==2){
                        $st='<span
                        class="label label-sm label-danger">Rejected</span>';
                    }
                    echo "<tr class='odd gradeX'>
                          <td class='center'>" . $row['bill_id'] . "</td>
                          <td class='center'>" . $row['short_name'] . "</td>
                          <td class='center'>" . $row['user_id'] . "</td>
                          <td class='center'>" . $row['division'] . "</td>
                          <td class='center'>" . $row['sub_div'] . "</td>
                          <td class='center'>" . $row['bill_date'] . "</td>
                          <td class='center'>" . $st . "</td>
                          <td class='center'><a href='viewpettycash.php?bill_id=" . $row["bill_id"] . "&emp_id=" . $row["user_id"] . "'>" . $row['amount'] . "</a></td>
                          <td class='center'>" . $row['remarks'] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Display pagination links
        if (ceil($total_pages / $num_results_on_page) > 0) :
        ?>
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="prev"><a href="all-requests.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                <?php endif; ?>

                <?php if ($page > 3) : ?>
                    <li class="start"><a href="all-requests.php?page=1">1</a></li>
                    <li class="dots">...</li>
                <?php endif; ?>

                <?php for ($i = max(1, $page - 2); $i <= min(ceil($total_pages / $num_results_on_page), $page + 2); $i++) : ?>
                    <li class="page <?php echo ($i === $page) ? 'currentpage' : ''; ?>">
                        <a href="all-requests.php?page=<?php echo $i ?>" class="<?php echo ($i === $page) ? 'currentpage' : ''; ?>"><?php echo $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                    <li class="dots">...</li>
                    <li class="end"><a href="all-requests.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                <?php endif; ?>

                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                    <li class="next"><a href="all-requests.php?page=<?php echo $page + 1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
    <!-- ... (Your existing HTML) ... -->
</div>
<!-- Your existing code continues... -->

<?php include 'footer.php'; ?>
