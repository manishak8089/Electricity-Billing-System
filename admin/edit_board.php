<?php
require_once('head_html.php');
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

if ($logged == false) {
    header("Location:../index.php");
    exit; // Always add exit after header redirect to prevent further execution
}

// Check if board_id is provided via GET method
if(isset($_GET['board_id'])) {
    $board_id = $_GET['board_id'];
} else {
    // Redirect or show an error message if board_id is not provided
    header("Location: board.php");
    exit;
}

// Fetch board details from the database
$query = "SELECT * FROM board WHERE board_id = $board_id";
$result = mysqli_query($con, $query);

if(!$result || mysqli_num_rows($result) == 0) {
    // Redirect or show an error message if board is not found
    header("Location: board.php");
    exit;
}

// Fetch board data
$board = mysqli_fetch_assoc($result);

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated values from the form
    $board_id = $_POST['board_id'];
    $board_name = $_POST['board_name'];

    // Update the board in the database
    $update_query = "UPDATE board SET board_name = '$board_name' WHERE board_id = $board_id";
    $update_result = mysqli_query($con, $update_query);
    $update_result = mysqli_query($con, $update_query);
    if (!$update_result) {
        echo "Error: " . mysqli_error($con);
    }
    
    if($update_result) {
        // Redirect to the view board page after successful update
        header("Location: board.php?board_id=$board_id");
        exit;
    } else {
        // Handle error, maybe display an error message
        echo "Failed to update board.";
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit Board
                           
                        </h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" action="">
                                <div class="form-group">
                                        <label for="board_id">Board ID:</label>
                                        <input type="text" class="form-control" id="board_id" name="board_id" value="<?php echo $board['board_id']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="board_name">Board Name:</label>
                                        <input type="text" class="form-control" id="board_name" name="board_name" value="<?php echo $board['board_name']; ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Board</button>
                                </form>
                            </div>
                        </div>
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
