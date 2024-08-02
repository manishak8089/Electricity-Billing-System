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
                <div class="row justify-content-center"> <!-- Centering main block -->
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small> Overview</small>
                            <!-- Like bills processed by the admin ; bills generated , unprocessed complaint
                            maybe a stats infograph -->
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                    list($result1,$result2,) = retrieve_users_defaulting($_SESSION['aid']);
                    $row1 = mysqli_fetch_row($result1);
                    $row2 = mysqli_fetch_row($result2);
                ?>
               
                <div class="row justify-content-center"> <!-- Centering main blocks -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-spinner fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php include('pendingcount.php'); ?></div>
                                        <span class="pull-left"><b>Total Pending Bills</b></span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>PENDING BILLS</b></span>
                                    <span class="pull-right"><i class="fa fa-spinner fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- ./panel-closes -->


                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dollar fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php include('billamtcount.php'); ?></div>
                                        <div>Total Transaction Amount</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>BILLS AMOUNT</b></span>
                                    <span class="pull-right"><i class="fa fa-dollar fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- ./panel-closes -->
                </div><!-- ./row -->


                <div class="row justify-content-center">
                    <?php 
                        list($result1,$result2,$result3) = retrieve_admin_stats($_SESSION['aid']);
                        $row1 = mysqli_fetch_row($result1);
                        $row2 = mysqli_fetch_row($result2);
                        $row3 = mysqli_fetch_row($result3);
                     ?>
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php echo $row2[0]; ?></div>
                                        <div>Generated Bills</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- ./panel-closes -->

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bullhorn fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php echo $row3[0]; ?></div>
                                        <div>Unprocessed Complaints</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- ./panel-closes -->
                </div>

                

                
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