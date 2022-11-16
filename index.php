<?php
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

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css" class="css">
  <title>Hello, world!</title>
</head>

<body>
  <?php include("navbar.php") ?>
  <div class="row row-cols-1 row-cols-md-5 mt-3" style="margin-left: auto; margin-right:auto; border-radius: 15px; width: auto; height: 230px; ">
  <?php
  $sql = "SELECT * FROM `menu`";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['sno'];
    $dish_name = $row['dish_name'];
    $dish_disc = $row['dish_disc'];
    $dish_rate = $row['dish_rate'];
    $dish_img = $row['dish_img'];
    $dish_img_name = $row['dish_img_name'];

  echo '<div class="col mb-2">
  <div class="card" style="width: 18rem; border-radius: 15px; margin-left: auto; margin-right:auto; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
  <div class="userimg ml-2 mr-2 mt-2 mb-2" style="display: flex; flex-direction: row; width: 35px; height: 35px; border-radius: 50%; background: red;">
  <img src="https://i.pravatar.cc/35" style="border-radius: 50%; margin:auto;" alt="" class="restoprofile">
  <p class="restoname ml-2 mr-2" style="font-weight: bold; font-size: 18px; margin-top: auto; margin-bottom:auto;">@Username</p>
      </div>
      <img src="https://source.unsplash.com/500x400/?graps,strawberry" class="card-img-top" style="width: auto; height: 200px; border-radius: 15px;" alt="...">
      <div class="card-body">
      <h5 class="card-title">' . $dish_name . '</h5>
      <h6 class="text-center mt-1 mb-2">'. substr($dish_disc, 0 , 30).'</h6>
      <a href="#" class="btn btn-primary" style="display: flex; flex-direction: column; margin-left: auto; margin-right: auto;">Order Now &#x1F60B;</a>
      </div>
      </div>
      </div>';
      
    }
    
    ?>
    </div>

  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>