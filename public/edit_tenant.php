h<?php include '../includes/db_connection.php'; ?>
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
            <h1><span class="fa fa-users" aria-hidden="true"></span> Tenants<small> Add tenant</small></h1>
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
                <h3 class="panel-title"> Update Tenant Details</h3>
              </div>
              <?php 
                $tenant_id = $_REQUEST['id'];
                $sel_query = "SELECT * FROM tenants  WHERE tena_id = '{$tenant_id}'; ";
                $result_1 = mysqli_query($con, $sel_query);
                confirm_query($result_1);
                $row = mysqli_fetch_assoc($result_1);

              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $id = $_POST["id_no"];
                $phone = $_POST["phone"];
                $mail = $_POST["email"];
                $pro = $_POST["property"];
                $unit = $_POST["unit_no"];
                $depo = $_POST['depo'];
                $occup = $_POST['occu'];
                $agent = $_SESSION['username'];
              }
              ?>
             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" enctype="multipart/form-data">

          <div class="form-group">
          <label for =fname>First Name</label>
        <input class="form-control " name="fname" id="name" type="text" value="<?php echo $row["fname"]; ?>" placeholder="First Name" required>
        </div> 

          <div class="form-group">
          <label for =fname>Last Name</label>
        <input class="form-control " name="lname" id="name" type="text" value="<?php echo $row["lname"]; ?>" placeholder="last Name" required>
        </div> 

        <div class="form-group">
        <label for =fname>ID/Passport Number</label>
        <input class="form-control " name="id_no" id="name" type="text" value="<?php echo $row["id_no"]; ?>" placeholder="ID Number" required>
        </div> 

        <div class="form-group">
        <label for =fname>Phone Number</label>
        <input class="form-control " name="phone"  type="text" value="<?php echo $row["phone"]; ?>" placeholder="Phone Number" required>
        </div>
        <div class="form-group">
        <label for =fname>Email</label>
        <input class="form-control " name="email" id="name" type="email" value="<?php echo $row["email"]; ?>" placeholder="Email Address" required>
        </div> 

        <div class="form-group">
        <label for =fname>Property Name</label>
        <input class="form-control " name="property" id="name" type="text" value="<?php echo $row["property_name"]; ?>" placeholder="Property Name" required>
        </div> 

        <div class="form-group">
        <label for =fname>Unit Number</label>
        <input class="form-control " name="unit_no" id="name" type="text" value="<?php echo $row["unit_no"]; ?>" placeholder="Unit Number" required>
        </div> 

        <div class="form-group">
        <label for =fname>Deposit amount</label>
        <input class="form-control " name="depo" id="name" type="text" value="<?php echo $row["depo_amount"]; ?>" placeholder="Deposit" required>
        </div> 

        <div class="form-group">
        <label for =fname>No of Occupants</label>
        <input class="form-control " name="occu" id="name" type="text" value="<?php echo $row["occupants"]; ?>" placeholder="NO of Occupants" required>
        </div> 

        <div class="form-group last">
        <input type="submit" class="btn btn-danger btn-outline-primary" value="submit">
        </div>
        </form>
              </div>
              </div>


             
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
