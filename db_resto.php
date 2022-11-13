<?php
$server = "localhost";
$username = "root";
$password = "";
// $email = "";
$database = "tasteonway_resto";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    echo "unsuccess";
}
// else{
//     die("Error". mysqli_connect_error());
// }

?>
