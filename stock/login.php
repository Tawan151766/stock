
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<?php
      session_start();
      date_default_timezone_set("Asia/Bangkok");

      include "connectdb.php";

      if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql   = "SELECT * FROM `users` WHERE  username='$username' and password ='$password'; ";
        $query = mysqli_query($connection, $sql);
        $num   = mysqli_num_rows($query);
        if ($num <= 0) {
            echo "<br><br><center><font size='5' color='red' face='MS Sans Serif'><b>Username or Password Invalid</b></font></center>";
            echo "<meta http-equiv=refresh content=2;URL=login.php>";
            exit();
          } else {
            $result                     = mysqli_fetch_array($query);
            $_SESSION['username']       = $result['username'];
            $_SESSION['ath']     = $result['ath'];
            $_SESSION['phone']           = $result['phone'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['address']           = $result['address'];
            $_SESSION['gender']       = $result['gender'];
            $_SESSION['date_of_birth']      = $result['date_of_birth'];
  
            echo "<br><br><center><font size='5' color='green' face='MS Sans Serif'><b>Login Please Wait</b></font></center>";
            echo "<meta http-equiv='refresh' content='1 ;url=index.php'>";
            exit();
          }
      }
      ?>
      
<div class="container mt-5">
<form class="bg-light border boreder-primary p-3 rounded" action="" method="post">
    <div class="container text-center">
        <h1>Log-in</h1>
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary me-1">Submit</button>
  <a href="register.php">Register</a>
</form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</html>