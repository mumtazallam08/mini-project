<?php 
include 'db_conn.php';
session_start();
error_reporting(0);
if (isset($_POST['submit'])) {
	$u = $_POST['email'];
	$p =$_POST['password'];
	

	$sql = "SELECT * FROM `user` WHERE email = '$u'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$x=$row['password'];
	$y=$row['type'];
	if(strcasecmp($x,$p)==0 && !empty($u) && !empty($p))
	  {//echo "Login Successful";
	   $_SESSION['email']=$u;
	   
	
	  if($y=='Admin')
	   header('location:admin/index.php');
	  else
		  header('location:customer/index.php');
			
	  }
	else 
	 { echo "<script type='text/javascript'>alert('Failed to Login! Incorrect RollNo or Password')</script>";
	}
	   
	
	}

?>

<!DOCTYPE html>
<html>
<head>
		<title>Spotify</title>
	<style>
		body{
    background-image: url('iconanddb/bg.jpg');
    text-align: center;
    text-decoration: none;
}
.contaimer-one{
    display: inline-block;
    background-color: rgb(42, 25, 25);
    width: 30%;
    height: 350px;
    border-radius: 10px;
    border: 0px;
    color: #fff;
    margin-top: 100px;
}
.logo-first{
    width: 35px;
    position: absolute;
    margin-top: 38px;
    margin-left: -110px;
}
input{
    width:80%;
    height: 30px;
    border-radius: 5px;
    margin-top: 10px;
}
button{
    width: 80%;
    height: 30px;
    background-color: #4CAF50;
    border-radius: 5px;
    font-size: larger;
    color: #fff;
    border: none;
    margin-top: 10px;
    cursor: pointer;
}
	</style>
</head>
<body>

    <div class="contaimer-one">
		<img src="iconanddb/logo.png" class="logo-first" alt="logo"><br>
		<h1>SPOTIFY</h1>
		<form action="" method="POST" >

				<input  type="text" placeholder="Email" name="email" required>

				<input type="password" placeholder="Password" name="password" required>

				<button name="submit">Login</button>
			<p>Don't have an account? <a href="register.php">Register Here</a></p>
		</form>
	</div>
</body>
</html>