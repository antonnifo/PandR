<?php include '../includes/db_connection.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php include '../includes/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">P<small>and</small>R Management System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Dashboard</a></li>         
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, <?php echo $_SESSION['username']; ?> <i class="fa fa-user" aria-hidden="true">
  </i></a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-user" aria-hidden="true"></span> Landlords<small> Add landlord</small></h1>
          </div>
         
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
               <a href="index.php" class="list-group-item active main-color-bg">
                <span class="fa fa-cog fa-spin" aria-hidden="true"></span> Dashboard
              </a>
  <a href="manage_properties.php" class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i> Manage Properties <span class="badge">
  <?php 
  $query = "SELECT count(*) as total from property";
  $result = mysqli_query($con, $query);
  confirm_query($result);
  $data = mysqli_fetch_assoc($result);
  echo $data['total'];
  ?>
  </span></a>

  <a href="manage_tenants.php" class="list-group-item"><i class="fa fa-group" aria-hidden="true"></i>  Manage Tenants <span class="badge">
  <?php 
  $query = "SELECT count(*) as total from tenants";
  $result = mysqli_query($con, $query);
  confirm_query($result);
  $data = mysqli_fetch_assoc($result);
  echo $data['total'];
  ?>
  </span></a>
  
  <a href="manage_landlords.php" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>  Manage Landloards <span class="badge">
  <?php 
  $query = "SELECT count(*) as total from landlords";
  $result = mysqli_query($con, $query);
  confirm_query($result);
  $data = mysqli_fetch_assoc($result);
  echo $data['total'];
  ?>
 </span></a>
  <a href="#" class="list-group-item"><i class="fa fa-money" aria-hidden="true"></i> Manage Payments <span class="badge">203</span></a>
            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"> Edit Landlord details</h3>
              </div>

              <?php
              $landlord_id = $_REQUEST['id'];
              $sel_query = "SELECT * FROM landlords  WHERE landlord_id = '{$landlord_id}'; ";
              $result_1 = mysqli_query($con, $sel_query);
              confirm_query($result_1);
              $row = mysqli_fetch_assoc($result_1);

              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $id = $_POST["id_no"];
                $phone = $_POST["phone"];
                $mail = $_POST["email"];
                $bank = $_POST["bank"];
                $property_name = $_POST["property_name"];
                $account = $_POST["account"];
                $agent = $_SESSION['username'];
                $new_id = $_POST["landlord_id"];
              }
              ?>

             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" enctype="multipart/form-data">
                   
             <input type="hidden" name="landlord_id" value="<?php echo $row["landlord_id"]; ?>">
              <div class="form-group">
                  <input class="form-control " name="fname" id="name" type="text" placeholder="First Name" value="<?php echo $row["fname"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="lname" id="name" type="text" placeholder="last Name" value="<?php echo $row["lname"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="id_no" id="name" type="text" placeholder="ID Number" value="<?php echo $row["id_no"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="phone"  type="text" placeholder="Phone Number" value="<?php echo $row["phone"]; ?>" required>
              </div>

              <div class="form-group">
                  <input class="form-control " name="email" id="name" type="text" placeholder="Email Address" value="<?php echo $row["email"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="property_name" id="name" type="text" placeholder="Property Name" value="<?php echo $row["prop_name"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="bank" id="name" type="text" placeholder="Name of Bank" value="<?php echo $row["bank"]; ?>" required>
              </div> 

              <div class="form-group">
                  <input class="form-control " name="account" id="name" type="text" placeholder="Account Number" value="<?php echo $row["account_no"]; ?>" required>
              </div> 

              <div class="form-group last">
                    <input type="submit" class="btn btn-danger btn-outline-primary" value="save changes">
              </div>

    </form>
              </div>
              </div>
<?php 

    if (isset($_POST["lname"])) {
      $query = "UPDATE landlords SET fname = '{$fname}', lname='{$lname}', id_no = '{$id}',
       phone = '{$phone}', email = '{$mail}', prop_name = '{$property_name}',
        bank = '{$bank}',agent = '{$agent}',account_no = '{$account}' WHERE landlord_id = '{$new_id}' ";
      
      $results = mysqli_query($con, $query);
      confirm_query($results);
      
      if ($results) {
        echo ' <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">
              &times;
              </button>
              Landlord details successfully updated.<a href="manage_landlords.php">view</a>
              </div>';
      }else {
              echo' <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">
              &times;
              </button>
              Erorr while updating record.<a href="manage_landlords.php">Go Back</a>
              </div>';         
            }
    }
?>       
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
       <p>© 2017-<?php echo date("Y"); ?> P<small>and</small>R. All rights reserved 

</p>
    </footer>

    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
  </body>
</html>
