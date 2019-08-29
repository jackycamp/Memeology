<?php
	session_start();
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

  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
	cart = [];
	function addToCart(name, price, picLocation, size){
		cart.push({"name":name, "price": price, "picture": picLocation, "size":size});
	}
	
	function getCart(){
		result = "";
		var i;
		for(i = 0; i < cart.length; i++){
			result += "<div class='row mb-3'><div class='col'><img class='card-img-top' src='"+cart[i].picture+"' alt='Card image cap'></div><div class='col my-auto'><h5>"+cart[i].size+" "+cart[i].name+" - $"+cart[i].price+"</h5></div><button type='button' class='btn btn-danger' onclick='removeItem(`"+cart[i].name+"`)'>Remove</button></div>";
		}
		
		document.getElementById("cartModalBody").innerHTML = result;
		document.getElementById("totalCost").innerHTML = "Total: $"+ getTotal() + ".00";
	}
	
	function removeItem(name){
		var i;
		for(i = 0; i < cart.length; i++){
			if(cart[i].name == name){
				cart.splice(i, 1);
				break;
			}
		}
		getCart();
	}
	
	function getTotal(){
		var i;
		result = 0
		for(i = 0; i < cart.length; i++){
			result += parseInt(cart[i].price,10)
		}
		
		return result
	}
	
</script>
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
      <li class="nav-item active">
        <a class="nav-link" href="merchandise.php">Merch<span class="sr-only">(current)</span></a>
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

      <!--Cart-->
      <div class="text-right" data-toggle="modal" data-target="#modalCart"><i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i></div>

      <h1 class="text-center mb-4">Shirts </h1>

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt1">
            <img class="card-img-top" src="assets/merch/001.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Don't Tread On Memes<br><small class="text-muted">$20</small></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt2">
            <img class="card-img-top" src="assets/merch/002.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Memeboys<br><small class="text-muted">$25</small></p></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt3">
            <img class="card-img-top" src="assets/merch/003.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Caveman Spongebob<br><small class="text-muted">$15</small></p></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt4">
            <img class="card-img-top" src="assets/merch/004.jpg" alt="Card image cap">
            <div class="card-body">The Zucc<br><small class="text-muted">$30</small></p></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt5">
            <img class="card-img-top" src="assets/merch/005.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Y Tho<br><small class="text-muted">$20</small></p></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt6">
            <img class="card-img-top" src="assets/merch/006.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Notorious Thomas<br><small class="text-muted">$30</small></p></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm text-center" data-toggle="modal" data-target="#modalShirt7">
            <img class="card-img-top" src="assets/merch/007.jpg" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">Wat<br><small class="text-muted">$15</small></p></p>
            </div>
          </div>
        </div>
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
<div class="modal fade" id="modalShirt1" tabindex="-1" role="dialog" aria-labelledby="modalShirt1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt1CenterTitle">Don't Tread On Memes</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/001.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$20.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Dont Tread On Memes', '20.00', 'assets/merch/001.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt2" tabindex="-1" role="dialog" aria-labelledby="modalShirt2"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt2CenterTitle">Memeboys</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/002.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$25.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Memeboys', '25.00', 'assets/merch/002.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt3" tabindex="-1" role="dialog" aria-labelledby="modalShirt3"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt3CenterTitle">Caveman Spongebob</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/003.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$15.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Caveman Spongebob', '15.00', 'assets/merch/003.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt4" tabindex="-1" role="dialog" aria-labelledby="modalShirt4"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt4CenterTitle">The Zucc</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/004.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$30.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('The Zucc', '30.00', 'assets/merch/004.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt5" tabindex="-1" role="dialog" aria-labelledby="modalShirt5"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt5CenterTitle">Y Tho</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/005.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$20.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Y Tho', '20.00', 'assets/merch/005.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt6" tabindex="-1" role="dialog" aria-labelledby="modalShirt6"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt6CenterTitle">Notorious Thomas</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/006.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$30.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Notorious Thomas', '30.00', 'assets/merch/006.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalShirt7" tabindex="-1" role="dialog" aria-labelledby="modalShirt7"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalShirt7CenterTitle">Wat</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col">
          <img class="card-img-top" src="assets/merch/007.jpg" alt="Card image cap">
        </div>
        <div class="col">
          <h2>$15.00</h2>
          <select class="custom-select mt-3">
            <option selected>Select a size</option>
            <option value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>
            <option value="3">Extra Large</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="addToCart('Wat', '15.00', 'assets/merch/007.jpg', 'Large')">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!--Cart Modal-->
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="modalCart"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cartModalBody">
              <!-- <div class="row mb-3" id="cartItem1"> -->
                <!-- <div class="col"> -->
                  <!-- <img class="card-img-top" src="assets/thumbnail.svg" alt="Card image cap"> -->
                <!-- </div> -->
                <!-- <div class="col my-auto"> -->
                  <!-- <h5>Size Title - $0.00</h5> -->
                <!-- </div> -->
              <!-- </div> -->
			
			</div>
			
            <div class="modal-footer">
                <div class="text-left" id="totalCost">Total: $0.00</div><button type="button" class="btn btn-primary">Checkout</button> <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->

<script>
	$(document).ready(function() {
		$('#modalCart').on('shown.bs.modal', function() {
			getCart();
		})
	});
</script>
</body>
</html>
