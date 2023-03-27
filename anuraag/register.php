<?php 

include 'db_conn.php';

error_reporting(0);

session_start();

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password=$_POST['password'];
	$type='person';

	$sql="insert into user (name,email,password,type) VALUES('$name','$email','$password','$type')";
	if ($conn->query($sql) === TRUE) {
echo "<script type='text/javascript'>alert('Registration Successful')</script>";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
echo "<script type='text/javascript'>alert('User Exists')</script>";
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
				<input type="text" placeholder="Name" name="name"  required>
				<input type="email" placeholder="Email" name="email" required>
				<input type="password" placeholder="Password" name="password" required>
				<button name="submit" >Register</button>
			<p>Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>