<?php 
include 'htlmbox/htmheader.php';
?>
<?php

session_start();
if(isset($_SESSION['id']) && ($_SESSION['email'] )){

 



?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <nav class="navbar navbar-expand-lg navbar-light  bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <button class="btn btn-info" type="submit" ><a href="logout.php"><?php echo $_SESSION['email'] ?></a> </button>
      </form>
    </div>
  </div>
</nav>
    </div>
  </div>
</div>


    <div class="container">
        <div class="row " > 
            <div class="col-md-12 ">
                <div class="bg-dark mt-5  text-center" >
                <h1 style="font-size: 60px;" class="text-primary">Wellcome to home</h1>
                <h1 style="font-size: 30px;" class="text-primary pb-3">how are you( <?php echo $_SESSION['email']; ?>)</h1>
                </div>
            </div>
        </div>
    </div>
<?php 
include 'htlmbox/htmfooter.php';
?>
<?php
}else{
    header("Location:form.php"); 

    exit();
}
?>