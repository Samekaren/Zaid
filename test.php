<?php  include('header.php');

if(@$_SESSION['user_session_id']){
    echo '<script>window.location.href="index.php";</script>';
    }

if (isset($_REQUEST['logins'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password_set'];

    // Check if the connection was successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select user by email
    $users_query = "SELECT * FROM registers WHERE email = '$email'";
    $get_user = mysqli_query($con, $users_query);

    // Check if the query executed successfully
    if ($get_user === false) {
        die("Error in query: " . mysqli_error($con));
    }

        $check_user = mysqli_num_rows($get_user);
        if ($check_user == 1) {
  
     while ($row = $get_user->fetch_assoc()) {
        if(password_verify($password, $row['password'])){
           
           

            $chech_admin = $row['user_role'];
            $permission = $row['permission'];

          

            if($chech_admin == '1'){
                
                $_SESSION['user_session_id']=$row['registers_id'];
                $_SESSION['session_email']=$row['email'];
                echo '<script>window.location.href="dashboard.php";</script>';
                exit;
            }elseif($chech_admin == '0'){
               
                $_SESSION['user_session_id']=$row['registers_id'];
			$_SESSION['session_email']=$row['email'];
                echo '<script>window.location.href="index.php";</script>';
                exit;

            }elseif($chech_admin == '2' && $permission == 'active'){
               
                $_SESSION['user_session_id']=$row['registers_id'];
			$_SESSION['session_email']=$row['email'];
                echo '<script>window.location.href="dashboard.php";</script>';
                exit;
                }elseif($chech_admin == '2' && $permission == 'inactive'){
                   
                    echo '<script>window.location.href="login.php?permission=status";</script>';
                
                }

           


        
        }else{
            echo '<script>window.location.href="login.php?user_password=incorrect";</script>';
            exit;
        }
        }

}else{
    echo '<script>window.location.href="login.php?user_loss=incorrects";</script>';
    exit;
}

    // Close the database connection
    mysqli_close($con);

}

?>