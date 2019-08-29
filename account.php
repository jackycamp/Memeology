<?php
	session_start();
	

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	
	// Include config file
	include "/var/www/inc/dbinfo.inc";
	 
	/* Attempt to connect to MySQL database */
	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	 
	// Check connection
	if($conn === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$userId = $_SESSION['user_id'];
	$sql = "SELECT * FROM USER WHERE user_id='$userId'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
		 $profileBio = $row["profile_bio"];
	  }
	}
	mysqli_close($conn);
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
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

    <div class="mx-auto" style="width: 600px;">
      <img src="assets/profile-placeholder.jpg" class="rounded-circle mx-auto d-block border mb-3" alt="Profile picture" width="200" height="200">
      <h1 class="border">@<?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
      <p class="border"><?php echo htmlspecialchars($profileBio); ?></p>
      <hr/>
      <p class="text-center border"><a href="submit.php"><i class="fa fa-upload fa-4x fa-fw" aria-hidden="true"></i></a><i class="fa fa-bell fa-4x fa-fw" aria-hidden="true"></i><i class="fa fa-cog fa-4x fa-fw" aria-hidden="true"></i> <i class="fa fa-exclamation-triangle fa-4x fa-fw" aria-hidden="true"></i></p>
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

</body>
</html>
