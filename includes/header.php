<?php ob_start(); ?>
<?php include 'db_connection.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet">
    <link href="../public/css/font-awesome.min.css" rel="stylesheet">
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
