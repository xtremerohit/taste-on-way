<?php
session_start();
include 'resto_db.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: resto_login.php");
    exit;
} elseif (isset($_SESSION['loggedin'])) {
    $check = $_SESSION['username'];
    $sql = "SELECT * FROM `resto_log` WHERE `resto_username` = '$check' ";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
        header("location: resto_login.php");
    }
}
$server = "localhost";
$username = "root";
$password = "";
// $email = "";
$database = "post_resto";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    echo "unsuccess";
}
// else{
//     die("Error". mysqli_connect_error());
// }
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Dash</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="resto_home.css">
    <link rel="stylesheet" href="index.css" class="css">

</head>

<body>
    
    <div class="btn">
        <span class="fas fa-bars"></span>
    </div>
    <nav class="sidebar">
        <div class="text">
            Hi! <?php echo $_SESSION['username'] ?>
            <img src="https://i.pravatar.cc/35" style="display:flex; flex-direction: column; margin-left: auto;
    margin-right: auto; justify-content: center; width: 45px; height: 45px; border-radius: 50%; margin-bottom: 13px;" alt="">
        </div>
        <ul>
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="resto_manage.php">Manage Restaurant</a></li>
            <li>
                <a href="#" class="feat-btn">Features
                    <span class="fas fa-caret-down first"></span>
                </a>
                <ul class="feat-show">
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Elements</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="serv-btn">Services
                    <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="serv-show">
                    <li><a href="#">App Design</a></li>
                    <li><a href="#">Web Design</a></li>
                </ul>
            </li>
            <li><a href="#">Overview</a></li>
            <li><a href="#">Shortcuts</a></li>
            <li><a href="resto_logout.php">Logout</a></li>
        </ul>
    </nav>
    <!-- NavbarEnd -->
 
    <div class="row row-cols-1 " style="margin-left: auto; margin-right:auto; border-radius: 15px; width: auto; height: 230px; margin-top: 23px; margin-bottom:23px;">
        <?php
        $user = $_SESSION['username'];
        $sql = "SELECT * FROM `$user`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            // $id = $row['sno'];
            $id = $row['sno'];
            $dish_name = $row['dish_name'];
            $dish_disc = $row['dish_disc'];
            $dish_rate = $row['dish_rate'];
            $dish_img = $row['dish_img'];
            // $dish_img_name = $row['dish_img_name'];

            echo '<div class="row mb-2">
  <div class="card" style="width: 18rem; border-radius: 15px; margin-left: auto; margin-right:auto; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); margin-top: 23px; margin-bottom:23px;">
  <div class="userimg ml-2 mr-2 mt-2 mb-2" style="display: flex; flex-direction: row; width: 35px; height: 35px; border-radius: 50%; background: red;">
  <img src="https://i.pravatar.cc/35" style="border-radius: 50%; margin:auto;" alt="" class="restoprofile">
  <p class="restoname ml-2 mr-2" style="font-weight: bold; font-size: 18px; margin-top: auto; margin-bottom:auto;">@Username</p>
      </div>
      <img src="https://source.unsplash.com/500x400/?graps,strawberry" class="card-img-top" style="width: auto; height: 200px; border-radius: 15px;" alt="...">
      <div class="card-body">
      <h5 class="card-title">' . $dish_name . '</h5>
      <h6 class="text-center mt-1 mb-2">' . substr($dish_disc, 0, 30) . '</h6>
      <a href="dish_edit.php?dishid='.$id.'">
  <button class="edit" style="display: block;margin-left: auto;
  margin-right: auto;
  margin-top: 25px;
  width: 125px;
  height: 40px;
  border-radius: 25px;
  box-shadow: inset 0px 4px 4px 1px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 4px 4px 1px rgba(0, 0, 0, 0.25);
  background: #8f71ff; color: #000000;
  font-weight: bold;">Edit</button>
</a>
      </div>
      </div>
      </div>
      
      ';
    }
    
    ?>
    </div>
    <script>
        $('.btn').click(function() {
            $(this).toggleClass("click");
            $('.sidebar').toggleClass("show");
        });
        $('.feat-btn').click(function() {
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });
        $('.serv-btn').click(function() {
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });
        $('nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>
</body>

</html>