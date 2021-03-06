<?php include '../includes/header.php'; ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-user" aria-hidden="true"></span> Landlords<small> Update landlord</small></h1>
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
                  <label for =fname>First Name</label>
                  <input class="form-control " name="fname" id="name" type="text" placeholder="First Name" value="<?php echo $row["fname"]; ?>" required>
              </div> 

              <div class="form-group">
                   <label for =fname>Last Name</label>
                  <input class="form-control " name="lname" id="name" type="text" placeholder="last Name" value="<?php echo $row["lname"]; ?>" required>
              </div> 

              <div class="form-group">
                  <label for =fname>ID/Passport Number</label>
                  <input class="form-control " name="id_no" id="name" type="text" placeholder="ID Number" value="<?php echo $row["id_no"]; ?>" required>
              </div> 

              <div class="form-group">
                  <label for =fname>Phone</label>
                  <input class="form-control " name="phone"  type="text" placeholder="Phone Number" value="<?php echo $row["phone"]; ?>" required>
              </div>

              <div class="form-group">
                   <label for =fname>Email Address</label>
                  <input class="form-control " name="email" id="name" type="text" placeholder="Email Address" value="<?php echo $row["email"]; ?>" required>
              </div> 

              <div class="form-group">
                  <label for =fname>Property Name</label>
                  <input class="form-control " name="property_name" id="name" type="text" placeholder="Property Name" value="<?php echo $row["prop_name"]; ?>" required>
              </div> 

              <div class="form-group">
                  <label for =fname>Name of Bank</label>
                  <input class="form-control " name="bank" id="name" type="text" placeholder="Name of Bank" value="<?php echo $row["bank"]; ?>" required>
              </div> 

              <div class="form-group">
                  <label for =fname>Account Number</label>
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
          // Redirect user to manage landlords page on success edit
          header("Location: manage_landlords.php");
       
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

    <?php include '../includes/footer.php'; ?>
