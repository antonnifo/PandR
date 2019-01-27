<?php include '../includes/db_connection.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#">P<small>and</small>R Management System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>
    <?php
// If form submitted, insert values into the database.
    if (isset($_POST['username'])) {
        // removes backslashes
      $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
      $username = mysqli_real_escape_string($con, $username);
      $password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con, $password);
  //Checking  is user existing in the database or not

      $query = "SELECT * FROM `agents` WHERE username='$username'
and pword='{" . md5($password) . "}'";
      $result = mysqli_query($con, $query);
      confirm_query($result);
      $rows = mysqli_num_rows($result);
      if ($rows == 1) {
        $_SESSION['username'] = $username;
            // Redirect user to dashboard.php
        header("Location: index.php");
      } else {
        echo "
<h3>username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Re-Login</a>";
      }
    } else {
      ?>  

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="well" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Enter Username" name="username">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Login</button>
              </form>
              <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
  <p>© 2017-<?php echo date("Y"); ?> P<small>and</small>R. All rights reserved 
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
