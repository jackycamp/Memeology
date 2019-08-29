<?php
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The best place for memes">

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

    <div class="col mb-5 text-center mx-auto" style="width: 800px;">
		<form action="uploadfile.php" method="POST" enctype="multipart/form-data">
			<input class="form-control form-control-sm px-0 py-0 mb-3" type="file" name="file" required>
			<input class="form-control form-control-sm px-0 py-0 mb-3" type="text" name="name" placeholder="Name of the Meme" required>
			<input class="form-control form-control-sm px-0 py-0 mb-3" type="text" name="description" placeholder="Description of the Meme" required>
			<button class="btn btn-primary" type="submit" name="submit">Submit</button>
		</form>
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
