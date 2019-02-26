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
