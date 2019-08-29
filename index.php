<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: login.php");
    // exit;
// }
?>


<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The best place for memes">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/me_gusta.png"/>

    <title>Memeology</title>
    <meta name="description" content="Memeology">
    <meta name="author" content="MonkaSquad">

    <!--<link rel="stylesheet" href="css/styles.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

</head>

<body>

<!--nav bar-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">Memeology</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="browse.php">Browse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="merchandise.php">Merch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>

        </ul>
		
		<?php
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
				echo '<ul class="navbar-nav">';
				echo '<li class="nav-item">';
                echo '<a class="nav-link" href="login.php">Login</a>';
				echo '</li>';
				echo '</ul>';
			}else{
				echo '<ul class="navbar-nav">';
				echo '<li class="nav-item dropdown">';
				echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> My Profile (';
				echo htmlspecialchars($_SESSION["username"]);
				echo ')</a>';
				echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
				echo '<a class="dropdown-item" href="account.php">Edit</a>';
				echo '<a class="dropdown-item" href="logout.php">Log out</a>';
				echo '</div>';
				echo '</li>';
				echo '</ul>';
			}
		?>

    </div>
</nav>

<!--end of nav bar-->

<!--main-->

<main role="main">

    <div class="jumbotron text-center mt-5">
        <img src="assets/banner1.png" alt="Memeology: Expand your mind" height="75" width="300">
    </div>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
			
				<?php include "/var/www/inc/dbinfo.inc";

				$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

				$sql = "SELECT * FROM MEMES";
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

				?>


            </div>

        </div>

    </div>

</main>
<!--end of main-->


<!--footer-->
<footer class="text-center text-muted">
    <div class="container">
        <p>&copy; MonkaSquad 2018 &copy;</p>
    </div>
</footer>
<!--end of footer-->

<!-- modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Title of the Meme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<img class="card-img-top mb-3" src="<?php echo $img_filePath; ?>" alt="Card image cap" id="meme">
				<h6 class="mb-3" id="description">Description: This is a description of the meme. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vulputate ultrices ligula, non placerat odio vehicula quis. Nunc venenatis cursus nibh sed sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque consequat massa eget diam convallis, tristique ultrices nulla gravida. Nunc porttitor magna neque, quis euismod velit pellentesque et. In risus purus, ornare in sodales eu, pellentesque non felis. Cras vitae tellus scelerisque, consequat mauris non, gravida arcu. Nulla tempus, nisl sit amet molestie auctor, metus elit congue eros, at aliquet nunc libero eu lorem. Quisque nec efficitur ex. Ut rhoncus sagittis erat, vitae commodo leo molestie et. Donec et mi leo. Donec ac mauris nunc.</h6>
				<h6 id="author">By: <a href="account.php">Author Of This Meme</a></h6>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->


<script>
	//triggered when modal is about to be shown
	$('#exampleModalCenter').on('show.bs.modal', function(e) {
		
		var memeId = $(e.relatedTarget).data('meme-id');
		var memeName = $(e.relatedTarget).data('meme-name');
		var memeAuthor = $(e.relatedTarget).data('meme-author');
		var memeDesc = $(e.relatedTarget).data('meme-description');
		var memeFile = $(e.relatedTarget).data('meme-file');
		var memeAuthorId = $(e.relatedTarget).data('meme-authorid');
		var memeAuthorHTML = '<a href="profile.php?page='+memeAuthorId+'">'+memeAuthor+'</a>';
		
		$( '#exampleModalCenterTitle' ).text(memeName);
		$( '#description' ).text("Description: "+memeDesc);
		$( '#author' ).html("By: "+memeAuthorHTML);
		$( '#meme' ).attr("src",memeFile);
		
		
	});
</script>
</body>
</html>
