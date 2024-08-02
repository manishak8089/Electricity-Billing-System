
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
if (!isset($_GET['id'])) {
    header("Location: users.php");
}

// Get the user ID from the URL
$user_id = $_GET['id'];

// Trigger to log deletion of user
$triggerQuery = "
CREATE TRIGGER log_delete_user
AFTER DELETE ON user
FOR EACH ROW
BEGIN
    -- Log the deletion
    INSERT INTO user_deletion_log (user_id, deletion_timestamp)
    VALUES (OLD.id, NOW());
END;
";

// Execute the trigger query
if (mysqli_query($con, $triggerQuery)) {
    // Trigger created successfully, proceed with deletion
    // Delete user record from the database
    $delete_query = "DELETE FROM user WHERE id = $user_id";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        // Redirect to user details page after successful deletion
        header("Location: users.php");
    } else {
        echo "Error deleting user!";
    }
} else {
    echo "Error creating trigger: " . mysqli_error($con);
}
?>
