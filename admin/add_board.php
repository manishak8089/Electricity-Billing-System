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
$query = "SELECT  board_name,board_id FROM board";
$result = mysqli_query($con, $query);
$board = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg_submit'])) {
    // Retrieve form data
    $board_id = $_POST['board_id'];
    $board_name = $_POST['board_name']; // Get the selected board name from the form

    // Insert new customer record into the database
    $insert_query = "INSERT INTO board (board_id,board_name) VALUES ('$board_id', '$board_name')";
    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
        // Redirect to user.php after successful insertion
        header("Location: board.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error adding new board!";
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
                        <h1 class="page-header">Add New Board</h1>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Board ID</label>
                                <input type="text" class="form-control" name="board_id" required>
                            </div>
                            <div class="form-group">
                                <label>Board Name</label>
                                <input type="text" class="form-control" name="board_name" required>
                            
                            <button type="submit" class="btn btn-primary" name="reg_submit">Add Board</button>
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
