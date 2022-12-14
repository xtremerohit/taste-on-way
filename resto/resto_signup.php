<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'resto_db.php';
  $username = $_POST["username"];
  $password = $_POST["pass"];
  $cpassword = $_POST["cpass"];
  $email = $_POST["email"];

  // $exists=false;

  // Check whether this username exists
  $existSql = "SELECT * FROM `resto_log` WHERE resto_username = '$username'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    // $exists = true;
    $showError = "Username Already Exists";
  } else {
    // $exists = false; 
    if (($password == $cpassword)) {
      $hash = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO `resto_log` (`resto_username`, `resto_password`, `email`, `resto_dt`) VALUES ('$username', '$hash', '$email', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        include 'resto_post_db.php';
        $showAlert = true;
        $username = $_POST['username'];
        $sql2 = "CREATE TABLE $username (
          sno INT(25) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          $username VARCHAR(225) NOT NULL,
          dish_name VARCHAR(225) NOT NULL,
          dish_disc VARCHAR(225)  NOT NULL,
          dish_rate INT(25)  NOT NULL,
          dish_img MEDIUMBLOB NOT NULL,
          dish_img_name VARCHAR(225)  NOT NULL,
          dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
        $run = mysqli_query($conn, $sql2);
      }
    } else {
      $showError = "Passwords do not match";
    }
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="resto_style.css" class="css">
  <title>Home</title>
</head>

<body>
  <?php include("resto_nav.php") ?>
  <p class="text-center mt-2 mb-2" style="font-size: 30px; font-weight: bold; color: #ffff;">Taste on Way</p>
  <div class="main-section mt-3">
    <div class="card">

      <form action="resto_signup.php" method="post">
        <div class="form-group">
          <p class="text=center" style="font-size: 25px; font-weight: bold; color: #000000;">Resto SignUp</p>
          <!-- <label for="">Username</label> -->
          <input type="text" class="form-control" placeholder="Username" maxlength="12" name="username" id="username" aria-describedby="">
        </div>
        <div class="form-group">
          <!-- <label for="">Password</label> -->
          <input type="password" placeholder="Password" class="form-control" name="pass" id="pass">
        </div>
        <div class="form-group">
          <!-- <label for="">Password</label> -->
          <input type="password" placeholder="Password" class="form-control" name="cpass" id="cpass">
        </div>
        <div class="form-group">
          <!-- <label for="">Password</label> -->
          <input type="email" placeholder="Email" class="form-control" name="email" id="email">
        </div>
        <button type="submit" class="btn btn-primary mt-4">SignUp</button>
      </form>
      <div>
        <form action="resto_login.php">
          <button class="btn"><b>Login<b></button>
        </form>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>