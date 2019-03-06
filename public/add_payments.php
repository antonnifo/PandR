<?php include '../includes/header.php'; ?>

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
                <h3 class="panel-title"> Payment Records</h3>
              </div>

<?php 
 
      $amount=$code=$name="";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $code=test_input($_POST["code"]);
            $name=test_input($_POST["name"]);
            $amount=test_input($_POST["amount"]);
            $period=test_input($_POST["period"]);
            $date=date("Y-m-d");
            $agent = $_SESSION['username'];
      
      }
?>
            
        <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" method="POST" >

                <div class="form-group">
                   <input class="form-control " name="name" id="name" type="text" placeholder="Account Name" required>
                </div> 

                <div class="form-group">
                    <input class="form-control " name="code" id="name" type="text" placeholder="Transaction code" required>
                </div> 

                <div class="form-group">
                    <input class="form-control " name="amount"  type="text" placeholder="Amount in KSH" required>
                </div>

                <div class="form-group">
                    <input class="form-control " name="period"  type="text" placeholder="Being Payment of Period eg Feb/2019" required>
                </div>

                <div class="form-group last">
                    <input type="submit" class="btn btn-danger btn-outline-primary" value="submit">
                </div>
            </form>
              </div>
                </div>
<?php 
if (isset($_POST["amount"])) {
    $query1= "INSERT INTO mpesa (" ;
    $query1.="account_name,transaction_code,date, " ;
    $query1.="amount,period,agent)" ;
    $query1.="VALUES (" ;
    $query1.=" '{$name}','{$code}', " ;
    $query1.="'{$date}','{$amount}','{$period}','{$agent}'" ;
    $query1.=")";
    $results=mysqli_query($con,$query1);
            confirm_query($results);

    if ($results) {
          echo ' <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                        &times;
                        </button>
                        Payment Recorded Successfully.<a href="manage_payments.php">Manage Payments</a>
                </div>';
        

    } else {
        echo ' <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                        &times;
                        </button>
                        Payment recording failed.<a href="add_payments.php">Try Again</a>
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
