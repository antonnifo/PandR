<?php include '../includes/header.php'; ?>

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
                <h3 class="panel-title"> Landlord details</h3>
              </div>
              <?php 
              $fname = $lname = $phone = $mail = "";
              $bank = $account = $passport = $date =$type= "";
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $id = $_POST["id_no"];
                $phone = $_POST["phone"];
                $mail = $_POST["email"];
                $bank = $_POST["bank"];
                $account = $_POST["account"];
                $propertyid =$_POST["property_id"];
                $date = date("Y-m-d");
                $agent = $_SESSION['username'];
              }
              if (isset($_FILES) & !empty($_FILES)) {
                $pass = $_FILES['pass']['name'];
                $size = $_FILES['pass']['size'];
                $type = $_FILES['pass']['type'];
                $tmp_name = $_FILES['pass']['tmp_name'];
              }
              $location = "landlords/";
              $maxsize = 90000000;
              ?>
             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <input class="form-control " name="fname" id="name" type="text" placeholder="First Name" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="lname" id="name" type="text" placeholder="last Name" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="id_no" id="name" type="text" placeholder="ID Number" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="phone"  type="text" placeholder="Phone Number" required>
            </div>

            <div class="form-group">
              <input class="form-control " name="email" id="name" type="text" placeholder="Email Address" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="property_id" id="name" type="text" placeholder="Property Name" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="bank" id="name" type="text" placeholder="Name of Bank" required>
            </div> 

            <div class="form-group">
              <input class="form-control " name="account" id="name" type="text" placeholder="Account Number" required>
            </div> 


            <div class="form-group last">
              <input type="file" name="pass" id="name">
            <p class="help-block">Passport Photo</p>
            </div>

            <div class="form-group last">
              <input type="submit" class="btn btn-danger btn-outline-primary" value="submit">
            </div>
        </form>
              </div>
              </div>
<?php 
if (isset($pass) & !empty($pass)) {
  if ($type == "image/jpeg" || $type == "image/JPG" || $type == "image/png" || $type == "image/PNG" || $type == "image/jpeg" || $type == "image/JPEG" && $size <= $maxsize) {
  if (move_uploaded_file($tmp_name, $location . $pass)) {

    if (isset($_POST["lname"])) {

      $query = "INSERT INTO landlords (fname,lname,id_no,phone,email,prop_name,DOA,bank,agent,account_no,passport)

VALUES ('{$fname}','{$lname}','{$id}','{$phone}','{$mail}','{ $propertyid}','{$date}','{$bank}','{$agent}','{$account}','{$pass}')";

      $results = mysqli_query($con, $query);
      confirm_query($results);

      if ($results) {
        echo ' <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                    &times;
                    </button>
                    Landlord  added Successfully.<a href="manage_landlords.php">view</a>
                </div>';
      } 

    } else {
        echo' <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert"
                  aria-hidden="true">
                  &times;
                  </button>
                  Staff creation failed.<a href="add_landlord.php">Try Again</a>
              </div>';   
    }
  }
} else {
    echo '<div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert"
          aria-hidden="true">
          &times;
          </button>
          File should be jpeg/jpg/png image & only 100 kb in size.<a href="add_landlord.php">Try Again</a>
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
