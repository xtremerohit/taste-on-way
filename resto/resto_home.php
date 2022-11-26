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
   $post_dish_username = $_SESSION['username'];
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
      $showError = true;
   } else {
      // $exists = false; 

      $sql = "INSERT INTO `menu` (`username_of_dish_insert`, `dish_name`, `dish_disc`,`dish_rate`, `dish_img`, `dt`) VALUES ('$post_dish_username', '$dish_name', '$dishdisc','$rate', '$img', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result) {
         $server = "localhost";
         $username = "root";
         $password = "";
         // $email = "";
         $database = "post_resto";

         $conn2 = mysqli_connect($server, $username, $password, $database);
         if (!$conn2) {
            echo "unsuccess";
         }
         $user = $_SESSION['username'];
         $showAlert = true;
         $sql2 = "INSERT INTO `$user` (`dish_name`, `dish_disc`,`dish_rate`, `dish_img`, `dt`) VALUES ('$dish_name', '$dishdisc','$rate', '$img', current_timestamp())";
         $result = mysqli_query($conn2, $sql2);
      }
   }
}


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
   <div class="content">
      <form action="resto_home.php" method="post">
         <div class="form-group">
            <p class="text=center mt-0 mb-3" style="font-size: 25px; font-weight: bold; color: #000000; margin-top: 23px;margin-bottom: 23px;">Add Dish</p>
            <!-- <label for="">Username</label> -->
            <?php
            if ($showError) {
               echo '<p class="text-center mt-2 mb-3" style="font-size: 15px; font-weight: bold; color: red; margin-bottom: 23px;">Dish Already Exists</p>';
            }
            if ($showAlert) {
               echo '<p class="text-center mt-2 mb-3" style="font-size: 15px; font-weight: bold; color: green; margin-bottom: 23px;">Dish Added Successfuly!</p>';
            }
            ?>
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
            <p class="text-center mt-2 mb-3" style="font-size: 15px; font-weight: bold; color: #ffff; margin-bottom: 23px;">Select img Of Dish</p>
            <input type="file" name="upload" accept=".png,.gif,.jpg,.webp" required>
         </div>
         <button type="submit" class="btn1 btn-primary mt-4">Send</button>
      </form>
   </div>
   </div>
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