<?php ob_start(); ?>
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
            <h1><span class="fa fa-home" aria-hidden="true"></span> Properties<small> Add Property</small></h1>
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
                <h3 class="panel-title">Update Property details</h3>
              </div>
              <?php
                $property_id = $_REQUEST['id'];
                $sel_query = "SELECT * FROM property  WHERE property_id = '{$property_id}'; ";
                $result_1 = mysqli_query($con, $sel_query);
                confirm_query($result_1);
                $row = mysqli_fetch_assoc($result_1); 

              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"];
                $typeprop = $_POST["type"];
                $rent = $_POST["rent"];
                $occu = $_POST["occu"];
                $vac = $_POST["vac"];
                $landlord = $_POST["landlord_id"];
                $agent = $_SESSION['username'];
                $new_id = $_POST["property_id"];
              }

              ?>
             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="property_id" value="<?php echo $row["property_id"]; ?>">

          <div class="form-group">
               <label for =name> Name</label>
               <input class="form-control " name="name" id="name" type="text" value="<?php echo $row["prop_name"]; ?>" placeholder="Property name" required>
          </div> 

          <div class="form-group">
          <label for =type>Property Type</label>
                <input class="form-control " name="type" id="name" type="text" value="<?php echo $row["prop_type"]; ?>" placeholder="eg Mansion,swahili" required>
        </div> 

        <div class="form-group">
        <label for =rent>Rent per unit</label>
        <input class="form-control " name="rent" id="name" type="text" value="<?php echo $row["rent"]; ?>" placeholder="Rent per unit" required>
        </div> 

        <div class="form-group">
        <label for =occu>Occupied Units</label>
        <input class="form-control " name="occu"  type="text" value="<?php echo $row["units_occ"]; ?>" placeholder="Occupied units" required>
        </div>

        <div class="form-group">
        <label for =vac>Vacant Units</label>
            <input class="form-control " name="vac" id="name" type="text" value="<?php echo $row["units_vac"]; ?>" placeholder="vacant units" required>
        </div> 

        <div class="form-group">
        <label for =landlord_id>Landlord ID/Passport</label>
           <input class="form-control " name="landlord_id" id="name" type="text" value="<?php echo $row["landlord_id"]; ?>" placeholder="landlord ID" required>
        </div> 

        <div class="form-group last">
            <input type="submit" class="btn btn-danger btn-outline-primary" value="Save changes">
        </div>
        </form>
              </div>
              </div>
<?php 

if (isset($_POST["name"])) {
    $query = "UPDATE property SET prop_name = '{$name}', prop_type='{$typeprop}', rent = '{$rent}',
     units_occ = '{$occu}', units_vac = '{$vac}', landlord_id = '{$landlord}',
      added_by = '{$agent}' WHERE property_id = '{$new_id}' ";
    
    $results = mysqli_query($con, $query);
    confirm_query($results);
    
    if ($results) {
        // Redirect user to manage property page on success edit
        header("Location: manage_properties.php");
     
    }else {
        echo' <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">
        &times;
        </button>
        Erorr while updating record.<a href="manage_properties.php">Go Back</a>
        </div>';         
          }
  }
        

?>             </div>
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