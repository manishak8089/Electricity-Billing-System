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

// Display user details
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
                        <h1 class="page-header">User Details</h1>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $user['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $user['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <td><?php echo $user['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $user['address']; ?></td>
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
