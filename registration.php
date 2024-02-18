<?php 
include 'htlmbox/htmheader.php';

// Initialize $email_error variable
$email_error = "";

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve form data
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    } else {
        // Check if passwords match
        if($password === $confirmPassword){
            // Add password validation if needed
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Assuming $conn is your database connection variable
            // Check if the email already exists in the database
            $sql_check = "SELECT * FROM registration WHERE email = '$email'";
            $result_check = mysqli_query($conn, $sql_check);
            
            // Check if any rows are returned
            if(mysqli_num_rows($result_check) > 0) {
                // Email already exists, show error message
                $email_error = "This email already exists. Please enter another email.";
            } else {
                // Email does not exist, proceed with registration
                // Insert user details into the database
                $sql_insert = "INSERT INTO `registration` (Name, email, password, status, roll) VALUES ('$name','$email','$hashedPassword','1','user')";
                $result_insert = mysqli_query($conn, $sql_insert);
                
                if($result_insert) {
                    // Registration successful
                    header("Location: form.php"); // Redirect to success page
                    exit();
                } else {
                    // Error handling for insertion failure
                    echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            // Passwords don't match, show error message
            $email_error = "Passwords do not match";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-white text-uppercase text-center pt-5 bg-danger">Registration</h1>
        </div>
        <div class="col-md-12 text-center">
            <?php if(isset($_REQUEST['password']) && $_REQUEST['password'] == 'incorrected'){ ?>
                <span style="color:red;font-size:22px;">Password Does not Match with confirm password</span>
            <?php } ?>
               
            <!-- <?php   echo $result_insert;    ?> -->
            <span class="error"><?php echo $email_error; ?></span>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="form">
                <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="name" name="Name" aria-describedby="nameHelp">
                        <div class="form-text">We'll never share your Name with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                        <div class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                        <div class="form-text">We'll never share your Password with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="exampleInputPassword2">
                        <div class="form-text">We'll never share your Password with anyone else.</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include 'htlmbox/htmfooter.php';
?>
