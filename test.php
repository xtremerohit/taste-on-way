<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- (A) UPLOAD FORM -->
<form method="post" enctype="multipart/form-data">
  <input type="file" name="upload" accept=".png,.gif,.jpg,.webp" required>
  <input type="submit" name="submit" value="Upload Image">
</form>

<?php
// (B) SAVE IMAGE INTO DATABASE
if (isset($_FILES["upload"])) {
  try {
    // (B1) CONNECT To DATABASE
    require "2-connect-db.php";

    // (B2) READ IMAGE FILE & INSERT
    $stmt = $pdo->prepare("INSERT INTO `images` (`img_name`, `img_data`) VALUES (?,?)");
    $stmt->execute([$_FILES["upload"]["name"], file_get_contents($_FILES["upload"]["tmp_name"])]);
    echo "OK";
  } catch (Exception $ex) { echo $ex->getMessage(); }
}
?>
</body>
</html>