<?php

	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	
	include "/var/www/inc/dbinfo.inc";

	$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	$userId = $_SESSION["user_id"];
	$sql = "SELECT * FROM USER WHERE user_id='$userId'";
	$result = mysqli_query($connection, $sql);
	
	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		 $currentPerm = $row['permission'];
	  }
	}else{
		$currentPerm = "";
	}
	
	if($currentPerm == "admin"){
		if(isset($_POST['submit'])){
			$file = $_FILES['file'];

			$fileName = $file['name'];
			$fileTmpName = $file['tmp_name'];
			$fileSize = $file['size'];
			$fileError = $file['error'];
			$fileType = $file['type'];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array('jpg', 'jpeg', 'png');

			if(in_array($fileActualExt, $allowed)){
				if($fileError == 0){
				  if($fileSize < 500000){
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination = 'uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$memeName = $_POST['name'];
					$memeName = mysqli_real_escape_string($connection, $memeName);
					$memeDescription = $_POST['description'];
					$memeDescription = mysqli_real_escape_string($connection, $memeDescription);
					$memeLocation = '/uploads/'.$fileNameNew;
					$currentUser = $_SESSION['username'];
				  
					$sql = "INSERT INTO MEMES (name, file_path, submitted_by, background_info) VALUES ('$memeName','$memeLocation','$currentUser','$memeDescription')";
					$retval = mysqli_query( $connection, $sql );
					header("Location: submit.php?uploadsuccess");
				  }else{
					echo "Your file is too big!";
					header("Location: submit.php?filetoobig");
				  }
				}
			}else{
				echo "You cannot upload files of this type!";
				header("Location: submit.php?wrongfiletype");
			}
			
		}
	}else{
		header("Location: submit.php?permissiondenied");
	}
	
	// Close connection
    mysqli_close($connection);
?>
