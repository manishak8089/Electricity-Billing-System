<?php
// Include necessary files and establish database connection
require_once('head_html.php');
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

// Check if user is logged in
if ($logged == false) {
    header("Location:../index.php");
    exit(); // Ensure script termination after redirect
}

// Check if the board ID is provided in the URL
if (!isset($_GET['board_id'])) {
    header("Location: user_details.php");
    exit(); // Ensure script termination after redirect
}

// Get the board ID from the URL
$board_id = $_GET['board_id'];



// Fetch board details from the database
$query = "SELECT * FROM board WHERE board_id = $board_id";
$result = mysqli_query($con, $query);

// Check if board exists
if (mysqli_num_rows($result) == 0) {
    echo "Board not found.";
    exit(); // Ensure script termination
}

// Fetch board details
$board = mysqli_fetch_assoc($result);
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
                        <h1 class="page-header">Electricity Board Details</h1>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Board ID</th>
                                        <td><?php echo $board['board_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Board Name</th>
                                        <td><?php echo $board['board_name']; ?></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                        <!-- ./table-responsive -->
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
