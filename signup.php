<?php require 'partials/_nav.php' ?>
<?php require 'partials/_dbconn.php'?>
<?php
 $showAlert = false;
 $showError = false;
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //Check Whether Username Exists
    $existSql = "SELECT * FROM `user` WHERE username = '$username' ";
    $result = mysqli_query($conn, $existSql);
    $ExistsRow = mysqli_num_rows($result);
    if($ExistsRow > 0)
    {
        $showError = "Username already Exists";
    }
    else
   {
        if(($password == $cpassword))
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user` (`username`, `password`, `date`)
            VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                $showAlert = "Account has Been Created Successfully";
            }
        }
        else
        {  
            $showError = "Password Mismatch";
        }
   }
 }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
   if($showAlert)
   {
   echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> '.$showAlert.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
   ?>
   <?php
   if($showError)
   {
   echo '
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
   ?>
    <div class="container">
        <h1 class="text-center" > Signup to our Website</h1>
        <form method="post" action="/PROJECT/signup.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" name="username" id="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
        <button class="btn btn-primary"><a href="http://localhost/PROJECT/login.php" class="text-light">Login</a></button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>