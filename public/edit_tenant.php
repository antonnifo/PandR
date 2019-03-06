<?php include '../includes/header.php'; ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-users" aria-hidden="true"></span> Tenants<small> Update tenant</small></h1>
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
                <h3 class="panel-title"> Edit Tenant Details</h3>
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
                $new_id = $_POST["tena_id"];
              }
              ?>
             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
         
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="tena_id" value="<?php echo $row["tena_id"]; ?>">   
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

              <?php 

    if (isset($_POST["lname"])) {
      $query = "UPDATE tenants SET fname = '{$fname}', lname='{$lname}', id_no = '{$id}',
       phone = '{$phone}', email = '{$mail}', property_name = '{$pro}',
       unit_no = '{$unit}',depo_amount = '{$depo}',occupants = '{$occup}' WHERE tena_id = '{$new_id}' ";
      
      $results = mysqli_query($con, $query);
      confirm_query($results);
      
      if ($results) {
          // Redirect user to manage landlords page on success edit
          header("Location: manage_tenants.php");
       
      }else {
          echo' <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert"
          aria-hidden="true">
          &times;prop_name
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

<?php include '../includes/footer.php'; ?>
