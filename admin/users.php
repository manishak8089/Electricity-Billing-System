<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php');
    if ($logged==false) {
         header("Location:../index.php");
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
                            Customer
                            <small>Details</small>
                            <!-- Like bills processed by the admin ; bills generated , unprocessed complaint
                            maybe a stats infograph -->
                        </h1>
                        <div class="row">
    <div class="col-lg-12">
        <a href="add_customer.php" class="btn btn-success">Add New Customer</a>
    </div>
</div>
                        <div class="table-responsive" style="padding-top: 0">
                                <table class="table table-hover table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Customer ID</th>
                                           
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Board</th>
                                            <th>Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                            $id=$_SESSION['aid'];
                                            $query1 = "SELECT COUNT(*) FROM user";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging1.php");
                                            // include('../Includes/admin.php');
                                            $result = retrieve_users_detail($_SESSION['aid'],$offset, $rowsperpage);

                                            $cnt=1;
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td height="50"><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['address'] ?></td> 
                                                    <td><?php echo $row['board_name'] ?></td> 
                                                    <td>
    <a href="view_user.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
    <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
</td>

                                                </tr>
                                            <?php $cnt++; } ?>
                                    </tbody>
                                </table>
                                <?php include("paging2.php");  ?>
                        </div>
                        <!-- ./table -rsponsive -->
                        
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
<style>
    .btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
}
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 12px;
}
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

</style>
