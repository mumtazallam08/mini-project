<!DOCTYPE html>
<?php

include 'db_conn.php';
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
  <style>
	body{
		background-color: lightgreen;
		margin-left: 20px;
		margin-top: 30px;
	}
	.container-middle{
		background-image: url('icon/bg.jpg');
		min-height: 72vh;
        color: white;
        font-family: 'Varela Round', sans-serif;
        margin: 23px auto;
        width: 70%;
        margin-top: 30px;
        border-radius: 12px;
        padding: 34px;

	}
	.boxs{
		width: 40%;
		border-radius: 10px;
		height: 300px;
		background-color: gray;
		margin-top: 20px;
		text-align: center;
	}

  </style>
</head>
<body>
	<div class="navbar">
	              <img src="icon/logo.png" alt="logo" width="40px" style="margin-top: -10px; position: absolute;">
				  <h1 style="margin-left: 60px; position:absolute; margin-top: -10px;" >SPOTIFY MUSIC</h1>
				  <input type="text" id="mySearch" style="margin-left: 400px; width: 400px; height: 40px; margin-top: -10px; border-radius: 10px; border: none;" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
				   <a href="logout.php" style="margin-left: 20px;">Logout</a>
</div><br>

    <div class="container-middle">
    <?php 
			$query = "SELECT * FROM music";
			$data = mysqli_query($conn, $query);		
			$total = mysqli_num_rows($data);		
			if($total !=0){
				while($result = mysqli_fetch_assoc($data)){
					echo"<div class='boxs'>";
					echo "<img src='../".$result['image']."' style='border-radius: 50%; margin-top: 10px; width: 150px; height: 150px;'>"; echo"<br>";
					echo "<h2 id ='myMenu'>".$result['name']."<br>"; echo"<br>";

					$audiofile = $result['audio'];
					?><audio src="../audios/<?=$audiofile?>" 
					controls>
				   </audio>
				</div>
				   <?php   
				}
			}
			else{
				echo "No record";
			}
?>
</body>
</html>