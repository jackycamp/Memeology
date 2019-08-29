<?php
	include "/var/www/inc/dbinfo.inc";

	$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	if (isset($_POST['currentLetter'])) {
		$currentLetter = $_POST['currentLetter'];
		$sql = "SELECT * FROM MEMES WHERE LOWER(name) LIKE '$currentLetter%'";
		$result = $connection->query($sql);

		while($row = $result->fetch_assoc()){
			$submittedBy = $row['submitted_by'];
			$sql2 = "SELECT * FROM USER WHERE username='$submittedBy'";
			$result2 = $connection->query($sql2);
			while($row2 = $result2->fetch_assoc()){
				$authorId = $row2['user_id'];
			}

			$img_filePath = $row["file_path"];
			echo '<div class="col-md-4">';
			echo '<div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#exampleModalCenter" data-meme-id="';
			echo $row['meme_id'];
			echo '" data-meme-name="';
			echo htmlspecialchars($row['name']);
			echo '" data-meme-description="';
			echo htmlspecialchars($row['background_info']);
			echo '" data-meme-file="';
			echo $row['file_path'];
			echo '" data-meme-author="';
			echo htmlspecialchars($row['submitted_by']);
			echo '" data-meme-authorid="';
			echo $authorId;
			echo '">';
			echo '<img class="card-img-top" src="';
			echo $row['file_path'];
			echo '" alt="Card image cap" style="width:100%;height: 20vw;object-fit: cover;">';
			echo '<div class="card-body">';
			echo '<p class="card-text">';
			echo htmlspecialchars($row['name']);
			echo '</p>';
			echo '<p class="card-text">By: <a href="profile.php?page=';
			echo $authorId;
			echo '">';
			echo htmlspecialchars($submittedBy);
			echo '</a></p>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}


?>