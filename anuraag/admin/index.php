<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<title>Admin Panel</title>

	<style>
		body {
			color: #fff;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
			background-image: url('icon/bg.jpg');
	}
		input {
			font-size: 1rem;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
		#myDIV {
            display: none;
            width: 50%;
            padding: 50px 0;
            text-align: center;
            background-color: lightblue;
            margin-top: 20px;
			border-radius: 10px;
}
#myIV {
            display: none;
			color: black;
            width: 50%;
            padding: 50px 0;
            text-align: center;
            background-color: lightblue;
            margin-top: 20px;
			border-radius: 10px;
}
</style>
</head>
<body>
	<h1>WELCOME ADMIN PANEL</h1>
<button onclick="myfileFunction()">Uploaded Songs </button>

<div id="myIV">
<?php 
include 'db_conn.php';
session_start();
if (isset($_POST['submit']) && isset($_FILES['my_audio'])) {
	include "db_conn.php";
	$name = $_POST['name'];
    $audio_name = $_FILES['my_audio']['name'];
    $tmp_name = $_FILES['my_audio']['tmp_name'];
    $error = $_FILES['my_audio']['error'];

	$filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/".$filename;
    //echo "$folder";
	move_uploaded_file($tempname, $folder);

    if ($error === 0) {
    	$audio_ex = pathinfo($audio_name, PATHINFO_EXTENSION);

    	$audio_ex_lc = strtolower($audio_ex);

    	$allowed_exs = array("mp3");

    	if (in_array($audio_ex_lc, $allowed_exs)) {
    		
    		$new_audio_name = uniqid("audio-", true). '.'.$audio_ex_lc;
    		$audio_upload_path = '../audios/'.$new_audio_name;
    		move_uploaded_file($tmp_name, $audio_upload_path);

    		// Now let's Insert the audio path into database
            $sql = "INSERT INTO music(name,audio,image) 
                   VALUES('$name','$new_audio_name','$folder')";
                  if(mysqli_query($conn, $sql)>0){
					echo "<script>alert('New Songs inserted.')</script>";
    	}else {
    		$em = "You can't upload files of this type";
    		header("Location: adminhome.php?error=$em");
    	}
    }
}else{
	header("Location: adminhome.php");
}
}
?>

	 <form action="" method="post" enctype="multipart/form-data">
		<input type="text" name="name" placeholder="Enter Song Name:.."><br><br>
		<div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="image" name="filename">
      <label class="custom-file-label" for="customFile">Choose image for Song</label>
    </div>
	<div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="my_audio" name="filename">
      <label class="custom-file-label" for="customFile">Choose audio for Song</label>
    </div>
		
		<input type="submit" name="submit" value="Upload">
	 </form>
</div>
<br>



<button onclick="myFunction()" class="button-save">View Uploaded Songs </button>

<div id="myDIV">

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
	
</div>
<script>

function myfileFunction() {
  var b = document.getElementById("myIV");
  if (b.style.display === "block") {
    b.style.display = "none";
  } else {
    b.style.display = "block";
  }
}

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>