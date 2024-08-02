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
$query = "SELECT  board_name FROM board";
$result = mysqli_query($con, $query);
$board = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg_submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $selected_board_name = $_POST['board']; // Get the selected board name from the form

    // Insert new customer record into the database
    $insert_query = "INSERT INTO user (name, email, phone, address, board_name) VALUES ('$name', '$email', '$phone', '$address', '$selected_board_name')";
    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
        // Redirect to user.php after successful insertion
        header("Location: users.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error adding new customer!";
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
                        <h1 class="page-header">Add New Customer</h1>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="form-group">
                                <label>Choose Board</label>
                                <select class="form-control" name="board" required>
                                    <option value="" selected disabled>Select Board Name</option>
                                    <?php foreach ($board as $boardItem) : ?>
                                        <option value="<?php echo $boardItem['board_name']; ?>"><?php echo $boardItem['board_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="reg_submit">Add Customer</button>
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
