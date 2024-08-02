<?php 
require_once('../Includes/config.php'); 
require_once('../Includes/session.php');
require_once('../Includes/user.php');

$uid = $_SESSION['uid'];
$bdate = $_POST['bdate'];
$ddate = $_POST['ddate'];
$units = $_POST['units'];
$amount = $_POST['amount'];
$payable = $_POST['payable'];

if (isset($_POST['pay_bill'])) {
    // Update bill status to PROCESSED
    $queryBill = "UPDATE bill SET status='PROCESSED' WHERE uid={$uid} AND bdate='{$bdate}' AND units={$units} AND amount={$amount}";
    if (!mysqli_query($con, $queryBill)) {
        die('Error updating bill status: ' . mysqli_error($con));
    }

    // Update transaction status and pdate
    $queryTransaction = "UPDATE transaction SET status='PROCESSED', pdate=CURDATE() WHERE bid=(SELECT id FROM bill WHERE uid={$uid} AND bdate='{$bdate}' AND units={$units} AND amount={$amount})";
    if (!mysqli_query($con, $queryTransaction)) {
        die('Error updating transaction status: ' . mysqli_error($con));
    }

    // Redirect to bill.php after successful update
    header("Location: bill.php");
    exit; // Terminate script execution after redirection
} else {
    // Handle case where pay_bill is not set
    echo "Invalid request.";
}
?>