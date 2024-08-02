<?php
// Include necessary files and establish database connection
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

// Check if user is logged in
if ($logged == false) {
    header("Location:../index.php");
}

// Check if the user ID is provided in the URL
if (!isset($_GET['board_id'])) {
    header("Location: users.php");
}

// Get the user ID from the URL
$board_id = $_GET['board_id'];

// Delete user record from the database
$delete_query = "DELETE FROM board WHERE board_id = $board_id";
$delete_result = mysqli_query($con, $delete_query);

if ($delete_result) {
    // Redirect to user details page after successful deletion
    header("Location: board.php");
} else {
    echo "Error deleting user!";
}
?>
