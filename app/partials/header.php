<nav class="navbar navbar-expand-lg navbar-light bg-warning">
	<a class="navbar-brand" href="../views/home.php"><i class="fab fa-forumbee"></i> Dishonest Bee</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
		    <li class="nav-item <?php if(isset($home_active)) { echo $home_active; } ?>">
		        <a class="nav-link" href="../views/home.php">Home <span class="sr-only">(current)</span></a>
		    </li>
		    <li class="nav-item <?php if(isset($catalog_active)) { echo $catalog_active; } ?>">
		        <a class="nav-link" href="../views/catalog.php">Catalog</a>
		    </li>
		    <li class="nav-item <?php if(isset($cart_active)) { echo $cart_active; } ?>">
		        <a class="nav-link" href="#">Cart <span class="badge bg-light text-dark" id="cart-count">
		        	<?php
		        		if (isset($_SESSION['cart'])) {
		        			echo array_sum($_SESSION['cart']);
		        		} else {
		        			echo 0;
		        		}
		        	?>
		        </span></a>
		    </li>

		    <?php if(isset($_SESSION['user'])) { ?>
				<li class="nav-item">
		        	<a class="nav-link" href="../controllers/logout.php">Logout</a>
		    	</li>
		    <?php } else { ?>
		    	<li class="nav-item <?php if(isset($login_active)) { echo $login_active; } ?>">
			        <a class="nav-link" href="./login.php">Login</a>
			    </li>
			    <li class="nav-item <?php if(isset($register_active)) { echo $register_active; } ?>">
			        <a class="nav-link" href="../views/register.php">Register</a>
			    </li>
		    <?php } ?>					    
		</ul>
	</div>
</nav>
