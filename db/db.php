<?php
$server = "localhost";
$username = "root";
$password = "";
// $email = "";
$database = "tasteonway88303";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    echo "unsuccess";
}
// else{
//     die("Error". mysqli_connect_error());
// }

?>
