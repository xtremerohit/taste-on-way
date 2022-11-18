<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from emp where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
	
    $edit = mysqli_query($db,"update emp set fname='$fname', lname='$lname' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location:all_records.php"); // redirects to all records page
        exit;
    }
    else
    {
        // echo mysqli_error();s
    }    	
}
?>

<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="fname" value="<?php echo $data['fname'] ?>" placeholder="Enter Full Name" Required>
  <input type="text" name="lname" value="<?php echo $data['lname'] ?>" placeholder="Enter Last Name" Required>
  <input type="submit" name="update" value="Update">
</form>
</body>
</html>