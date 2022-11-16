<?php
session_start();
include 'resto_db.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: resto_login.php");
  exit;
}elseif (isset($_SESSION['loggedin'])) {
  $check = $_SESSION['username'];
  $sql = "SELECT * FROM `resto_log` WHERE `resto_username` = '$check' ";

  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 0) {
    header("location: resto_login.php");
  }
}
?>
<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $server = "localhost";
  $username = "root";
  $password = "";
  // $email = "";
  $database = "resto_menu";

  $conn = mysqli_connect($server, $username, $password, $database);
  if (!$conn) {
    echo "unsuccess";
  }
  // else{
  //     die("Error". mysqli_connect_error());
  // }
  $dish_name = $_POST["dishname"];
  $dishdisc = $_POST["dishdisc"];
  $rate = $_POST["rs"];
  $img = $_POST["upload"];
  // $dish_img_name = $_POST["email"];

  // $exists=false;

  // Check whether this username exists
  $existSql = "SELECT * FROM `menu` WHERE dish_name = '$dish_name'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    // $exists = true;
    $showError = "Username Already Exists";
  } else {
    // $exists = false; 

    $sql = "INSERT INTO `menu` (`dish_name`, `dish_disc`,`dish_rate`, `dish_img`, `dt`) VALUES ('$dish_name', '$dishdisc','$rate', '$img', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = true;
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
  <link rel="stylesheet" href="resto_home.css">
  <!-- <link rel="stylesheet" href="resto_style.css"> -->


  <title>Hello, world!</title>
</head>

<body>
  <?php include("resto_nav.php") ?>

  <form action="resto_home.php" method="post">
    <div class="form-group">
      <p class="text=center" style="font-size: 25px; font-weight: bold; color: #000000;">Resto Login</p>
      <!-- <label for="">Username</label> -->
      <input type="text" class="form-control" placeholder="Dish Name" name="dishname" id="dishname" aria-describedby="">
    </div>
    <div class="form-group">
      <!-- <label for="">Password</label> -->
      <textarea class="form-control" placeholder="dish Info" id="dishdisc" name="dishdisc" rows="3"></textarea>
      <!-- <input type="dishdisc" placeholder="dish Info" class="form-control" name="dishdisc" id="dishdisc"> -->
    </div>
    <div class="form-group">
      <!-- <label for="">Password</label> -->
      <input type="number" placeholder="Rs" class="form-control" name="rs" id="rs">
    </div>
    <div class="form-group">
      <!-- <label for="">Password</label> -->
      <p class="text-center mt-2 mb-2" style="font-size: 15px; font-weight: bold; color: #ffff;">Select img Of Dish</p>
      <input type="file" name="upload"  accept=".png,.gif,.jpg,.webp" required>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Send</button>
  </form>
  </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>