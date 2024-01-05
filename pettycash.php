<?php
include('db.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['currency'])) {
    // Set the session variable with the selected user_id
    $_SESSION['user_id'] = $_POST['currency'];

    // Check the emp_category for the selected user
    $user_select = "SELECT emp_category FROM tbl_users WHERE user_id = " . $_SESSION['user_id'];
    $result = $con->query($user_select);

    if ($result) {
        $row = $result->fetch_assoc();
        $selectedCategory = $row['emp_category'];

        // Redirect to the appropriate page based on category
        if ($selectedCategory == 22) {
            header('Location: allnewtabs.php');
            exit();
        } else {
            header('Location: entry.php');
            exit();
        }
    } else {
        // Handle database query error
        echo "Error querying the database.";
        exit();
    }
}

$user_select = "SELECT * FROM tbl_users";
$user = $con->query($user_select);

if ($user->num_rows > 0) {
    $options = mysqli_fetch_all($user, MYSQLI_ASSOC);
}
?>

<div class="col-md-6 col-sm-6">
    <form method="post" action="">
        <div class="form-group">
            <label>User</label>
            <select class="form-control" name="currency" id="currency">
                <option>Select user</option>
                <?php foreach ($options as $option) {
                    echo '<option value="' . htmlspecialchars($option['user_id']) . '">' . htmlspecialchars($option['short_name']) . '</option>';
                } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="col-md-6 col-sm-6">
    <div class="form-group">
        <label>Selected User ID</label>
        <p id="selectedUserId"></p>
    </div>
</div>

<script>
    document.getElementById('currency').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('selectedUserId').textContent = 'User ID: ' + selectedOption.value;
    });
</script>
