<html>
 <head>
 <title>display image</title>
 </head>
 <body>
 <p>Here in your form and text</p>
	<?php
	$conn = mysqli_connect("localhost", "root", "", "resto_menu");
	$image_details  = mysqli_query($conn, "SELECT * FROM menu1");
     while ($row = mysqli_fetch_array($image_details)) {     
		
      	echo "<img src='".$row['dish_img']."' >";   
      
    }     

	?>
  
 </body>
 </html>