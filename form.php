<?php
include 'htlmbox/htmheader.php';
session_start();


if(@$_SESSION['id']):
    echo '<script>window.location.href="Home.php";</script>';
endif;

?>
<style>.error {
  background-color: rgb(255, 184, 77);
  color: rgb(189, 27, 27);
  font-family: sans-serif;
  padding: 10px;
  width: 95%;
  border-radius: 10px;
}</style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-white bg-info text-uppercase text-center mt-5">Login</h1>
            </div>
            <div>
            <?php  if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php }?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    
                    <button type="submit"  class="btn btn-primary">Submit</button>
            </form>
            <a href="registration.php">Sign Up here ?</a>

            </div>
        </div>
    </div>

<?php
include 'htlmbox/htmfooter.php';
?>