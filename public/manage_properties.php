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
     <script src="js/jquery.min.js"></script>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<style media="print">
  .noPrint{ display: none; }
  #noPrint{ display: none; }
  /* two-axis{ display: block !important; } */
</style>
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
            <!-- <li><a href="pages.html">Pages</a></li> -->
            
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
            <h1><span class="fa fa-home" aria-hidden="true"></span> Properties<small> Manage Properties</small></h1>
          </div>
          <div class="col-md-2" id="noPrint"> 
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Add Entity
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <!-- <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li> -->
                <li><a href="add_landlord.php">Add Landlord</a></li>
                <li><a href="add_property.php">Add Property</a></li>
                <li><a href="add_tenant.php">Add Tenant</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

   

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title" id="noPrint">Managing Properties  <i class="fa fa-spinner fa-pulse fa-fw"></i> </h3>
              </div>
            
             <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
       <div class="table-responsive"> 
       
   <input type="text" id="myInput" placeholder="Search..." title="Type in  something" class="noPrint" >
  <button type="button" class="btn btn-info btn-flat btn-pri" onclick="window.print()" id="noPrint"><i class="fa fa-print" aria-hidden="true">
  </i>Print report</button> 
          <table class="table table-striped table-hover" id="">
          <thead >
                      <tr class="danger">
                        <th>Sr.no</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Rent</th>
                        <th>Vaccant</th>
                        <th>Occupied</th>
                        <th>Date Added</th>
                        <th>Added By</th>
                        <th>Owner ID</th>
                        <th></th>
                        <th></th>
                      </tr>
          </thead>    
          <tbody id="myTable">        
                      <?php
                      $count = 1;
                      $sel_query = "SELECT * FROM property  ORDER BY property_id Asc; ";
                      $result = mysqli_query($con, $sel_query);
                      confirm_query($result);
                      while ($row = mysqli_fetch_assoc($result)) { ?>

                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row["prop_name"]; ?></td>
                        <td><?php echo $row["prop_type"]; ?></td>
                        <td><?php echo $row["rent"]; ?></td>
                        <td><?php echo $row["units_vac"]; ?></td>
                        <td><?php echo $row["units_occ"]; ?></td>
                        <td><?php echo $row["DOA"]; ?></td>
                        <td><?php echo $row["added_by"]; ?></td>
                        <td><?php echo $row["landlord_id"]; ?></td>
                        <td id="noPrint"><a href="edit_property.php?id=<?php echo $row["property_id"]; ?>"class="btn btn-default"> <i class="fa fa-pencil"></i> Edit</a> </td>
                        <td id="noPrint"><a href="delete_property.php?id=<?php echo $row["property_id"]; ?>"class="btn btn-warning"> <i class="fa fa-trash"></i> Delete </a> </td>
                      </tr>
                       <?php $count++;
                    } ?>
                      </tbody>
                      
                     
                    </table>
        
              </div>
              </div>
              </div>


             
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

<?php include '../includes/footer.php'; ?>
