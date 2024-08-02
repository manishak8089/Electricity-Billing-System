<!-- NOTE
SINGLE PAGE FORM ALONG WITH VALIDATION
NO PHP LEAKS BACK TO THE INDEX 
 -->
<?php
require_once("Includes/session.php");
$nameErr = $phoneErr = $addrErr = $emailErr = $passwordErr = $confpasswordErr = "";
$name = $email = $password = $confpassword = $address = "";
$flag=0;
$query = "SELECT board_name FROM board";
$result = mysqli_query($con, $query);
$boards = mysqli_fetch_all($result, MYSQLI_ASSOC);
//CHECK IF A VALID FORM STRING
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

if(isset($_POST["reg_submit"])) {
        $email = test_input($_POST['email']); 
        $password = test_input($_POST["inputPassword"]);
        $confpassword = test_input($_POST["confirmPassword"]);
        $address = test_input($_POST["address"]);
        $email = test_input($_POST['email']);

        // NAME VALIDATION
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag=1;
            echo $nameErr;
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed"; 
                $flag=1;
                echo $nameErr;
            }
        }

        // EMAIL VALIDATION
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $flag=1;
            } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $flag=1;
                echo $emailErr;
            }
        }

        // PASSWORD VALIDATION
        if (empty($_POST["inputPassword"])) 
        {
            $passwordErr = "PASSWORD missing";
            $flag=1;
        }
        else 
        {
            $password = $_POST["inputPassword"];
        }
        // CONFIRM PASSWORD
        if (empty($_POST["confirmPassword"])) 
        {
            $confpasswordErr = "missing";
            $flag=1;
        }
        else 
        {
            if($_POST['confirmPassword'] == $password)
            {
                $confpassword = $_POST["confirmPassword"];
            }
            else
            {
                $confpasswordErr = "Not same as password!";
                $flag = 1;
            }
        }

        // ADDRESS VALIDATION
        if (empty($_POST["address"])) {
            $addrErr = "Address is required";
            $flag=1;
            echo $addrErr;
        } else {
            $address = test_input($_POST["address"]);
            // check if address only contains letters and whitespace
            // if (!preg_match("/^[a-zA-Z1-9]*$/",$address)) {
            //     $addrErr = "Only letters, numbers and white space allowed";
            //     // $flag=1; 
            //     echo $addrErr;
            // }
        }

        //CONTACT VALIDATION
        if (empty($_POST["contactNo"])) {
            $flag=1;
            $contactNo = "";
            // echo "error here";
        } else {
            $contactNo = test_input($_POST["contactNo"]);
            if(!preg_match("/^d{10}$/", $_POST["contactNo"])){
                $phoneErr="10 digit phone no allowed.";
                // $flag=1;
                // echo "or here";
                echo $_POST['contactNo'];
            }
        }

        // Only if succeed from the validation thourough put  
        echo $flag; 
        if($flag == 0)
        {
            require_once("Includes/config.php");
            $sql = "INSERT INTO user (`name`,`email`,`phone`,`pass`,`address`)
                    VALUES('$name','$email','$contactNo','$password','$address')";
                    echo $sql;
            if (!mysqli_query($con,$sql))
            {
                die('Error: ' . mysqli_error($con));
            }
            header("Location:index.php");
        }
    }
?>

<?php
    // if(isset($flag)) {
    //     if($flag === 0) {
    //         echo '
    //             <table class="table"> 
    //             <tr class="success">Account Created</tr>
    //             </table>
    //         ';
    //     } elseif ($flag === 1) {
    //         echo '
    //             <table class="table"> 
    //             <tr class="danger">There were errors in the form.</tr>
    //             </table>
    //         ';
    //     } 
    // }
?>
<form action="signup.php" method="post" class="form-horizontal" role="form" onsubmit="return validateForm()">
    <center>
    <div class="row form-group">
            <div class="col-md-12">
                <input type="name" class="form-control" name="name" id="name" placeholder="Full Name" required>
                <span id="nameError" style="color: white; display: none;"></span>
            </div>
        </div>

    <div class="form-group">
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            <!-- <label><?php echo $emailErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" required>
            <!-- <label><?php echo $passwordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
            <!-- <label><?php echo $confpasswordErr;?></label><label><?php echo $confpasswordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
            <div class="col-md-12">
                <input type="tel" class="form-control" name="contactNo" id="contactNo" placeholder="Contact No." required>
                <span id="contactError" style="color: white; display: none;"></span>
            </div>
        </div>

    <div class="form-group">
        <div class="col-md-12">
            <input type="address" class="form-control" name="address" placeholder="Address" required>
            <!-- <label><?php echo $addrErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
    <div class="col-md-12">
        <select class="form-control" name="board_name" required>
            <option value="" selected disabled>Select Electricity Board</option>
            <?php foreach ($boards as $board) : ?>
                <option value="<?php echo $board['board_name']; ?>"><?php echo $board['board_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


        <!-- Submit button -->
        <div class="form-group">
            <div class="col-md-10">
                <button id="submitButton" name="reg_submit" class="btn btn-primary" disabled>Sign Up</button>
            </div>
        </div>
    </center>
</form>

<script>
    document.getElementById("name").addEventListener("input", function() {
        var nameInput = document.getElementById("name").value.trim();
        var submitButton = document.getElementById("submitButton");
        var nameError = document.getElementById("nameError");
        
        // Check if name contains only letters and is not empty
        if (/^[a-zA-Z\s]*$/.test(nameInput) && nameInput !== "") {
            submitButton.disabled = false; // Enable the submit button
            nameError.style.display = "none"; // Hide the error message
        } else {
            submitButton.disabled = true; // Disable the submit button
            nameError.textContent = "Only letters and white space allowed"; // Set the error message text
            nameError.style.display = "inline"; // Display the error message
        }
    });
</script>
<script>
    document.getElementById("contactNo").addEventListener("input", function() {
        var contactInput = document.getElementById("contactNo").value.trim();
        var submitButton = document.getElementById("submitButton");
        var contactError = document.getElementById("contactError");

        // Check if contact number contains exactly 10 digits
        if (/^\d{10}$/.test(contactInput)) {
            submitButton.disabled = false; // Enable the submit button
            contactError.style.display = "none"; // Hide the error message
        } else {
            submitButton.disabled = true; // Disable the submit button
            contactError.textContent = "Please enter a 10-digit phone number"; // Set the error message text
            contactError.style.display = "inline"; // Display the error message
        }
    });
</script>

<style>
    /* Style for the "Sign Up" button */
    #submitButton {
        background-color: MediumSeaGreen; /* Green background color */
        border: none; /* Remove border */
        color: white; /* White text color */
        padding: 10px 30px; /* Add padding */
        text-align: center; /* Center text */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make it a block element */
        font-size: 16px; /* Increase font size */
        cursor: pointer; /* Add cursor on hover */
        border-radius: 5px; /* Add border radius */
        transition: background-color 0.3s; /* Smooth transition on hover */
        font-weight: bold; /* Make text bold */
        margin-left: 80px;
    }
    .line {
        border-top: 1px solid #ccc; /* Line style */
        margin: 20px 0; /* Add space above and below the line */
    }
    /* Style for the "Sign Up" button on hover */
    #submitButton:hover {
        background-color: tomato; /* Darker green background color */
    }
</style>

<p>If you don't have an account, sign up here.</p>
