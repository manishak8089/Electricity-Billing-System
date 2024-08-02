<?php
// Include necessary files and establish database connection
require_once('head_html.php');
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

// Check if user is logged in
if ($logged == false) {
    header("Location:../index.php");
}

// Check if the user ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: user_details.php");
}

// Get the user ID from the URL
$user_id = $_GET['id'];

// Fetch user details from the database
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update user record in the database
    $update_query = "UPDATE user SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $user_id";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        // Redirect to user details page after successful update
        header("Location: view_user.php?id=$user_id");
    } else {
        echo "Error updating user details!";
    }
}
?>

<body>
    <div id="wrapper">
        <?php
        require_once("nav.php");
        require_once("sidebar.php");
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit User</h1>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div><!-- ./col -->
                </div> <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php
    require_once("footer.php");
    require_once("js.php");
    ?>
</body>

</html>
