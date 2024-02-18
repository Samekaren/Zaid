<?php
    include 'connect.php';
    session_start();
    if(@$_SESSION['id']):
        echo '<script>window.location.href="Home.php";</script>';
    endif;
    if (isset($_POST['email']) && isset($_POST['password'])) {

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        if (empty($email)) {
            header("Location: form.php?error=email is required");
            exit();
        } elseif (empty($password)) {
            header("Location: form.php?error=Password is required");
            exit();
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Retrieve hashed password from the database
            $sql = "SELECT * FROM `registration` WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows === 1) {

            while ($row = mysqli_fetch_assoc($result)) {

                // Verify the password
                if ($row['email'] === $email && password_verify($password, $row['password'])) {

                    $status = $row['status'];
                    $roll = $row['roll'];
                    

                        // code change

                        if($status == '1'){
                        if ($roll == 'admin') {
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['id'] = $row['id'];

                            echo '<script>window.location.href="Admin.php?admin=ok";</script>';

                            exit;
                        } else {

                            $_SESSION['email'] = $row['email'];
                            $_SESSION['id'] = $row['id'];

                            echo '<script>window.location.href="Home.php?user=ok";</script>';

                            exit;
                        }
                        }else{
                           
                            header("Location: form.php?error=User is not active");
                            exit();
                        }

                        // end here

                } else {
                    header("Location: form.php?error=User name or password incorrect");
                    exit();
                }
            } 
            } else {
                header("Location: form.php?error=User not found");
                exit();
            }
        }
    } else {
        header("Location: form.php");
        exit();
    }
?>
