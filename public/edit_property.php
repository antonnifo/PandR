<?php include '../includes/header.php'; ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-home" aria-hidden="true"></span> Properties<small> Update Property</small></h1>
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
  <a href="manage_payments.php" class="list-group-item"><i class="fa fa-money" aria-hidden="true"></i> Manage Payments <span class="badge">
  <?php 
  $query = "SELECT count(*) as total from mpesa";
  $result = mysqli_query($con, $query);
  confirm_query($result);
  $data = mysqli_fetch_assoc($result);
  echo $data['total'];
  ?>
  </span></a>
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
                <h3 class="panel-title">Edit Property details</h3>
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


<?php include '../includes/footer.php'; ?>
