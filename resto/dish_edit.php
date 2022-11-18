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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="resto_home.css"> -->
    <!-- <link rel="stylesheet" href="index.css" class="css"> -->
    <title>Document</title>
</head>

<body>

    <!-- Edit Modal End -->
    <div class="row row-cols-1 " style="margin-left: auto; margin-right:auto; border-radius: 15px; width: auto; height: 230px; margin-top: 23px; margin-bottom:23px;">
        <?php
        $user = $_SESSION['username'];
        $id = $_GET['dishid'];
        $sql = "SELECT * FROM `$user` WHERE sno=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sno_id = $row['sno'];
            $dish_name = $row['dish_name'];
            $dish_disc = $row['dish_disc'];
            $dish_rate = $row['dish_rate'];
            $dish_img = $row['dish_img'];
            echo '<div class="col mb-2" id="dishtable">
            <div class="card" style="width: 18rem; border-radius: 15px; margin-left: auto; margin-right:auto; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); margin-top: 23px; margin-bottom:23px;">
            <div class="userimg ml-2 mr-2 mt-2 mb-2" style="display: flex; flex-direction: row; width: 35px; height: 35px; border-radius: 50%; background: red;">
            <img src="https://i.pravatar.cc/35" style="border-radius: 50%; margin:auto; " alt="" class="restoprofile">
            <p class="restoname ml-2 mr-2" style="font-weight: bold; font-size: 18px; margin-top: auto; margin-bottom:auto;">@Username</p>
            </div>
            <img src="https://source.unsplash.com/500x400/?graps,strawberry" class="card-img-top" style="width: auto; height: 200px; border-radius: 15px;" alt="...">
            <div class="card-body">
            <h5 class="card-title" ><p class="dishname">' . $row['dish_name'] . '</p></h5>
            <h6 class="text-center mt-1 mb-2">' . substr($dish_disc, 0, 30) . '</h6>
            <button class="edit " id="' . $row['sno'] . '" style="display: block;margin-left: auto;margin-right: auto;margin-top: 25px;width: 125px;
            height: 40px;
            border-radius: 25px;
            box-shadow: inset 0px 4px 4px 1px rgba(0, 0, 0, 0.25);
            box-shadow: 0px 4px 4px 1px rgba(0, 0, 0, 0.25);
            background: #8f71ff; color: #000000;
            font-weight: bold;" data-toggle="modal" data-target="#editModal">Edit</button>
            
            </div>
            </div>
            </div>
            
            ';
        }
        ?>
    </div>
    <!-- Edit Modal -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <form action="dish_edit_success.php?dishid=<?php echo$id;?>" method="post">
                        <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $sno_id;?>" name="idofdish" id="idofdish" aria-describedby="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $dish_name;?>" name="dishname" id="dishname" aria-describedby="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $dish_disc;?>" name="dishdisc" id="dishdisc" aria-describedby="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $dish_rate ;?>" name="rs" id="rs" aria-describedby="">
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
                <div class="modal-footer" style="display: flex; flex-direction:column; margin-left:auto; margin-right:auto;">

                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <!-- <button type="submit" name="edit" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                dish_name = tr.getElementsByClassName("dishname")[0].innerText;
                description = tr.getElementsByTagName("h6")[1].innerText;
                console.log(dish_name, description);
                titleEdit.value = dish_name;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `/crud/index.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>