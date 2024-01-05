<?php
// Include header and database connection
include 'header.php';
include 'db.php';

// Calculate total pages for pagination
$total_pages = $con->query('SELECT COUNT(*) FROM bill_details')->fetch_row()[0];

// Set the number of results per page
$num_results_on_page = 5;

// Set the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Fetch results for the current page - Pending
$sql_pending =  "SELECT bd.bill_id, bd.title, bd.currency, bd.submitted_by, bd.submitted_date, bd.file_names, bd.current_action AS emp_division
FROM pettycash.bill_list bd
JOIN pettycash.tbl_users us ON bd.submitted_by = us.user_id
WHERE bd.current_action='0'
LIMIT ?, ?";
$stmt_pending = $con->prepare($sql_pending);

// Check for errors in the prepared statement
if (!$stmt_pending) {
    die('Error in preparing statement: ' . $con->error);
}

$calc_page = ($page - 1) * $num_results_on_page;
$stmt_pending->bind_param('ii', $calc_page, $num_results_on_page);

// Execute the statement
$stmt_pending->execute();

// Check for errors in the execution of the statement
if ($stmt_pending->error) {
    die('Error in executing statement: ' . $stmt_pending->error);
}

$result_pending = $stmt_pending->get_result();
$stmt_pending->close();  // Close the result set before executing the next query

// Fetch results for the current page - Approved
$sql_approved =  "SELECT bd.bill_id, bd.title, bd.currency, bd.submitted_by, bd.submitted_date, bd.file_names, bd.current_action AS emp_division
FROM pettycash.bill_list bd
JOIN pettycash.tbl_users us ON bd.submitted_by = us.user_id
WHERE bd.current_action='1'
LIMIT ?, ?";
$stmt_approved = $con->prepare($sql_approved);

// Check for errors in the prepared statement
if (!$stmt_approved) {
    die('Error in preparing statement: ' . $con->error);
}

$stmt_approved->bind_param('ii', $calc_page, $num_results_on_page);

// Execute the statement
$stmt_approved->execute();

// Check for errors in the execution of the statement
if ($stmt_approved->error) {
    die('Error in executing statement: ' . $stmt_approved->error);
}

$result_approved = $stmt_approved->get_result();
$stmt_approved->close();

// Fetch results for the current page - Rejected
$sql_rejected = "SELECT bd.bill_id, bd.title, bd.currency, bd.submitted_by, bd.submitted_date, bd.file_names, bd.current_action AS emp_division
FROM pettycash.bill_list bd
JOIN pettycash.tbl_users us ON bd.submitted_by = us.user_id
WHERE bd.current_action='2'
LIMIT ?, ?";
$stmt_rejected = $con->prepare($sql_rejected);

// Check for errors in the prepared statement
if (!$stmt_rejected) {
    die('Error in preparing statement: ' . $con->error);
}

$stmt_rejected->bind_param('ii', $calc_page, $num_results_on_page);

// Execute the statement
$stmt_rejected->execute();

// Check for errors in the execution of the statement
if ($stmt_rejected->error) {
    die('Error in executing statement: ' . $stmt_rejected->error);
}

$result_rejected = $stmt_rejected->get_result();
$stmt_rejected->close();


$page_pending = isset($_GET['page_pending']) && is_numeric($_GET['page_pending']) ? $_GET['page_pending'] : 1;
$page_approved = isset($_GET['page_approved']) && is_numeric($_GET['page_approved']) ? $_GET['page_approved'] : 1;
$page_rejected = isset($_GET['page_rejected']) && is_numeric($_GET['page_rejected']) ? $_GET['page_rejected'] : 1;

?>


<style>
   
    /* Add styles for tabs */
    .tabs {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .tabs-nav {
        list-style-type: none;
        display: flex;
    }

    .tabs-nav li {
        margin-right: 10px;
    }

    .tabs-nav a {
        text-decoration: none;
        padding: 10px;
        background-color: #e2e6e6;
        border-radius: 4px;
        color: #616872;
        font-weight: bold;
        font-size: 12px;
    }

    .tabs-nav a:hover {
        background-color: #3081D0;
        color:white;
    }
    
    .tabs-nav a:active{
        background-color: #3081D0;
        color:white;
    }
    .tabs-nav a.currentpage {
        background-color: #518acb;
        color: #fff;
    }

    .tabs-stage {
        margin-top: 20px;
    }

     /* Add a class to the file names cell for styling */
     .file-names-cell {
        max-width: 200px; /* Adjust the width as needed */
        overflow: auto;
    }
</style>

<script>
$(document).ready(function() {
    // Initially hide all tabs except the first one
    $(".tabs-stage > div:not(:first)").hide();

    // Handle tab click event
    $(".tabs-nav a").click(function() {
        // Hide all tabs
        $(".tabs-stage > div").hide();

        // Show the clicked tab
        var tabId = $(this).attr("href");
        $(tabId).show();

        // Remove "current" class from all tabs
        $(".tabs-nav a").removeClass("currentpage");

        // Add "current" class to the clicked tab
        $(this).addClass("currentpage");

        return false; // Prevent default behavior of the link
    });
});
</script>

<div class="tabs">
    <ul class="tabs-nav">
        <li><a href="#tab-1">Pending</a></li>
        <li><a href="#tab-2">Approved</a></li>
        <li><a href="#tab-3">Rejected</a></li>
    </ul>
    <div class="tabs-stage">
        <div id="tab-1">
            <!-- Your existing HTML for the first tab -->
            <div class="page-content-wrapper">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                        <thead>
                        <tr>
                    <th class="center">Bill Id</th>
                    <th class="center"> Bill Title </th>
                    <th class="center"> Currency </th>
                    <th class="center"> Submitted By </th>
                    <th class="center"> Submitted Date </th>
                    <th class="center"> Uploaded Bills </th>
                    <th class="center"> Status </th>
                    <th class="center"> View Details </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $st='';
                // Output results
                while ($row = $result_pending->fetch_assoc()) {
                    
                        $st='<span
                        class="label label-sm label-warning">Pending</span>';
                   
                    
                        echo "<tr class='odd gradeX'>
                        <td class='center'>" . $row['bill_id'] . "</td>
                        <td class='center'>" . $row['title'] . "</td>
                        <td class='center'>" . $row['currency'] . "</td>
                       
                        <td class='center'>" . $row['submitted_by'] . "</td>
                        <td class='center'>" . $row['submitted_date'] . "</td>
                        <td class='center file-names-cell'>" . $row['file_names'] . "</td>
                        <td class='center'>" . $st . "</td>
                        
                        <td class='center'><a href='viewpettycash.php?bill_id=" . $row["bill_id"] . "'> <i class='fa fa-file' aria-hidden='true'fa-3x></i>
                        </a></td>
                       
                        </tr>";
                }
                ?>
                        </tbody>
                    </table>

                    <?php
        
        if (ceil($total_pages / $num_results_on_page) > 0) :
            ?>
                <ul class="pagination">
                    <?php if ($page_pending > 1) : ?>
                        <li class="prev"><a href="allnewtabs.php?page_pending=<?php echo $page_pending - 1 ?>&tab=pending">Prev</a></li>
                    <?php endif; ?>
            
                    <?php if ($page_pending > 3) : ?>
                        <li class="start"><a href="allnewtabs.php?page_pending=1&tab=pending">1</a></li>
                        <li class="dots">...</li>
                    <?php endif; ?>
            
                    <?php for ($i = max(1, $page_pending - 2); $i <= min(ceil($total_pages / $num_results_on_page), $page_pending + 2); $i++) : ?>
                        <li class="page <?php echo ($i === $page_pending && $active_tab === 'pending') ? 'currentpage' : ''; ?>">
                            <a href="allnewtabs.php?page_pending=<?php echo $i ?>&tab=pending" class="<?php echo ($i === $page_pending && $active_tab === 'pending') ? 'currentpage' : ''; ?>"><?php echo $i ?></a>
                        </li>
                    <?php endfor; ?>
            
                    <?php if ($page_pending < ceil($total_pages / $num_results_on_page) - 2) : ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="allnewtabs.php?page_pending=<?php echo ceil($total_pages / $num_results_on_page) ?>&tab=pending"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                    <?php endif; ?>
            
                    <?php if ($page_pending < ceil($total_pages / $num_results_on_page)) : ?>
                        <li class="next"><a href="allnewtabs.php?page_pending=<?php echo $page_pending + 1 ?>&tab=pending">Next</a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
                </div>
            </div>
        </div>
        <div id="tab-2">
            <!-- Content for the second tab (customize as needed) -->
                       <div class="page-content-wrapper">
                <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                        <thead>
                        <tr>
                    <th class="center">Bill Id</th>
                    <th class="center"> Bill Title </th>
                    <th class="center"> Currency </th>
                    <th class="center"> Submitted By </th>
                    <th class="center"> Submitted Date </th>
                    <th class="center"> Uploaded Bills </th>
                    <th class="center"> Status </th>
                    <th class="center"> View Details </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $st='';
                // Output results
                while ($row = $result_pending->fetch_assoc()) {
                    
                        $st='<span
                        class="label label-sm label-warning">Pending</span>';
                   
                    
                        echo "<tr class='odd gradeX'>
                        <td class='center'>" . htmlspecialchars($row['bill_id']) . "</td>
                        <td class='center'>" . htmlspecialchars($row['title']) . "</td>
                        <td class='center'>" . htmlspecialchars($row['currency']) . "</td>
                        <td class='center'>" . htmlspecialchars($row['submitted_by']) . "</td>
                        <td class='center'>" . htmlspecialchars($row['submitted_date']) . "</td>
                        <td class='center'>" . htmlspecialchars($row['file_names']) . "</td>
                        <td class='center'>" . $st . "</td>
                        <td class='center'><a href='viewpettycash.php?bill_id=" . htmlspecialchars($row['bill_id']) . "'><i class='fa fa-file' aria-hidden='true'fa-3x></a></td>
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
            <?php if ($page_approved > 1) : ?>
                <li class="prev"><a href="allnewtabs.php?page_approved=<?php echo $page_approved - 1 ?>&tab=pending">Prev</a></li>
            <?php endif; ?>
    
            <?php if ($page_approved > 3) : ?>
                <li class="start"><a href="allnewtabs.php?page_approved=1&tab=approved">1</a></li>
                <li class="dots">...</li>
            <?php endif; ?>
    
            <?php for ($i = max(1, $page_approved - 2); $i <= min(ceil($total_pages / $num_results_on_page), $page_approved + 2); $i++) : ?>
                <li class="page <?php echo ($i === $page_approved && $active_tab === 'approved') ? 'currentpage' : ''; ?>">
                    <a href="allnewtabs.php?page_approved=<?php echo $i ?>&tab=approved" class="<?php echo ($i === $page_approved && $active_tab === 'approved') ? 'currentpage' : ''; ?>"><?php echo $i ?></a>
                </li>
            <?php endfor; ?>
    
            <?php if ($page_approved < ceil($total_pages / $num_results_on_page) - 2) : ?>
                <li class="dots">...</li>
                <li class="end"><a href="allnewtabs.php?page_approved=<?php echo ceil($total_pages / $num_results_on_page) ?>&tab=approved"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
            <?php endif; ?>
    
            <?php if ($page_approved < ceil($total_pages / $num_results_on_page)) : ?>
                <li class="next"><a href="allnewtabs.php?page_approved=<?php echo $page_approved + 1 ?>&tab=approved">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
                </div>
            </div>
        </div>
        <div id="tab-3">
            <!-- Content for the Rejected tab  -->
            <div class="page-content-wrapper">
            <div class="page-content-wrapper">
                <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                        <thead>
                        <tr>
                    <th class="center">Bill Id</th>
                    <th class="center"> Bill Title </th>
                    <th class="center"> Currency </th>
                    <th class="center"> Submitted By </th>
                    <th class="center"> Submitted Date </th>
                    <th class="center"> Uploaded Bills </th>
                    <th class="center"> Status </th>
                    <th class="center"> View Details </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $st='';
                // Output results
                while ($row = $result_pending->fetch_assoc()) {
                    
                        $st='<span
                        class="label label-sm label-warning">Pending</span>';
                   
                    
                    echo "<tr class='odd gradeX'>
                          <td class='center'>" . $row['bill_id'] . "</td>
                          <td class='center'>" . $row['title'] . "</td>
                          <td class='center'>" . $row['currency'] . "</td>
                          
                          <td class='center'>" . $row['submitted_by'] . "</td>
                          <td class='center'>" . $row['submitted_date'] . "</td>
                          <td class='center'>" . $row['file_names'] . "</td>
                          <td class='center'>" . $st . "</td>
                          <td class='center'><a href='viewpettycash.php?bill_id=" . htmlspecialchars($row['bill_id']) . "'><i class='fa fa-file' aria-hidden='true'fa-3x></a></td>
                          
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
            <?php if ($page_rejected > 1) : ?>
                <li class="prev"><a href="allnewtabs.php?page_rejected=<?php echo $page_rejected - 1 ?>&tab=rejected">Prev</a></li>
            <?php endif; ?>
    
            <?php if ($page_rejected > 3) : ?>
                <li class="start"><a href="allnewtabs.php?page_rejected=1&tab=rejected">1</a></li>
                <li class="dots">...</li>
            <?php endif; ?>
    
            <?php for ($i = max(1, $page_rejected - 2); $i <= min(ceil($total_pages / $num_results_on_page), $page_rejected + 2); $i++) : ?>
                <li class="page <?php echo ($i === $page_rejected && $active_tab === 'rejected') ? 'currentpage' : ''; ?>">
                    <a href="allnewtabs.php?page_rejected=<?php echo $i ?>&tab=rejected" class="<?php echo ($i === $page_rejected && $active_tab === 'rejected') ? 'currentpage' : ''; ?>"><?php echo $i ?></a>
                </li>
            <?php endfor; ?>
    
            <?php if ($page_rejected < ceil($total_pages / $num_results_on_page) - 2) : ?>
                <li class="dots">...</li>
                <li class="end"><a href="allnewtabs.php?page_rejected=<?php echo ceil($total_pages / $num_results_on_page) ?>&tab=rejected"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
            <?php endif; ?>
    
            <?php if ($page_rejected < ceil($total_pages / $num_results_on_page)) : ?>
                <li class="next"><a href="allnewtabs.php?page_rejected=<?php echo $page_rejected + 1 ?>&tab=rejected">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
                </div>
        </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
