<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/admin.php');

    $aid = $_SESSION['aid'];
    list($result1,$result2,) = retrieve_users_defaulting($_SESSION['aid']);
    $row1 = mysqli_fetch_row($result1);
    $row2 = mysqli_fetch_row($result2); 


    if (isset($_POST['defaulting_user'])) {
        $query  = "DELETE FROM user "; 
        $query .= "USING user , bill ";
        $query .= "WHERE bill.uid=user.id AND bill.status='PENDING' " ;
        $query .= "AND curdate() > adddate(bill.ddate , INTERVAL 1 DAY) " ;
        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
    }

    elseif (isset($_POST['late_user'])) {
        $late_fee = 165.00; // Adjust as needed
    
        $query  = "UPDATE transaction ";
        $query .= "INNER JOIN bill ON transaction.bid = bill.id ";
        $query .= "SET transaction.payable = transaction.payable + $late_fee "; 
        $query .= "WHERE bill.status = 'PENDING' ";
        $query .= "AND bill.ddate = CURDATE() - INTERVAL 1 DAY "; // overdue by one day
        $query .= "AND NOT EXISTS (SELECT * FROM transaction t2 WHERE t2.bid = bill.id)"; // ensure fee is applied only once
        if (!mysqli_query($con, $query)) {
            die('Error: ' . mysqli_error($con));
        }
    }
    
    
    header("Location:index.php");
?>