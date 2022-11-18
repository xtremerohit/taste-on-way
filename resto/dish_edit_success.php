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
if (!$conn){
    echo "unsuccess";
}
// else{
//     die("Error". mysqli_connect_error());
// }
$user = $_SESSION['username'];
       
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $server = "localhost";
                $username = "root";
                $password = "";
                // $email = "";
                $database = "post_resto";
                
                $conn = mysqli_connect($server, $username, $password, $database);
                if (!$conn) {
                    echo "unsuccess";
                }
                $user = $_SESSION['username'];
                $sno_id = $_POST['idofdish'];
                $dish_name = $_POST["dishname"];
                $dish_disc = $_POST["dishdisc"];
                $rate = $_POST["rs"];
                $img = $_POST["upload"];
                
                
                // $sql = "UPDATE `rosh` SET `dish_name` = '$dish_name', `dish_disc` = '$dish_disc', `dish_img_name` = '$img', `dish_rate` = '$rate' WHERE `rosh`.`sno` = $sno_id;";
                
                // $sql = "UPDATE `$user` SET `dish_name`=$dish_name, `dish_disc`=$dish_disc, `dish_rate`=$rate, `dish_img_name`=$img WHERE `rosh`.`sno` = $sno_id";
                
                $sql = "UPDATE $user
                SET dish_name = '$dish_name', dish_disc= '$dish_disc',dish_rate = '$rate'
                WHERE sno = $sno_id;";
                
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showSuccess = true;
                } else {
                    // echo mysqli_error();s
                }
            }
            
            
        


?>
