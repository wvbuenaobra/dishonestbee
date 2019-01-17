<nav class="navbar navbar-expand-lg navbar-light bg-warning">
	<a class="navbar-brand" href="../views/home.php"><i class="fab fa-forumbee"></i> Dishonest Bee</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">

			<?php if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 2)) { ?>

				<!-- HOME -->
			    <li class="nav-item <?php if(isset($home_active)) { echo $home_active; } ?>">
			        <a class="nav-link" href="../views/home.php">Home <span class="sr-only">(current)</span></a>
			    </li>

			    <!-- CATALOG -->
			    <li class="nav-item <?php if(isset($catalog_active)) { echo $catalog_active; } ?>">
			        <a class="nav-link" href="../views/catalog.php">Catalog</a>
			    </li>

			    <!-- CART -->
			    <li class="nav-item <?php if(isset($cart_active)) { echo $cart_active; } ?>">
			        <a class="nav-link" href="../views/cart.php">Cart <span class="badge bg-light text-dark" id="cart-count">
			        	<?php
			        		if (isset($_SESSION['cart'])) {
			        			echo array_sum($_SESSION['cart']);
			        		} else {
			        			echo 0;
			        		}
			        	?>
			        </span></a>
			    </li>

			<?php } else if(isset($_SESSION['user']) &&  $_SESSION['user']['roles_id'] == 1) { ?>
		    	
				<!-- ORDERS -->
				<li class="nav-item <?php if(isset($orders_active)) { echo $orders_active; } ?>">
		        	<a class="nav-link" href="../views/orders.php">Orders</a>
		    	</li>

		    	<!-- ITEMS -->
				<li class="nav-item <?php if(isset($items_active)) { echo $items_active; } ?>">
		        	<a class="nav-link" href="../views/items.php">Items</a>
		    	</li>

		    	<!-- USERS -->
				<li class="nav-item <?php if(isset($users_active)) { echo $users_active; } ?>">
		        	<a class="nav-link" href="../views/users.php">Users</a>
		    	</li>

		    <?php } ?>

		    <?php if(isset($_SESSION['user'])) { ?>

		    	<!-- MY PROFILE -->
				<!-- <li class="nav-item <?php //if(isset($profile_active)) { echo $profile_active; } ?>">
		        	<a class="nav-link" href="../views/profile.php">My Profile</a>
		    	</li> -->

		    	<!-- LOGOUT -->
				<!-- <li class="nav-item">
		        	<a class="nav-link" href="../controllers/logout.php">Logout</a>
		    	</li> -->

		    	<!-- WELCOME USER -->
		    	<li class="nav-item dropdown <?php if(isset($profile_active)) { echo $profile_active; } ?>">
       				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          				Welcome, <?php echo $_SESSION['user']['firstname'] ?>
        			</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          	<a class="dropdown-item" href="../views/profile.php">My Profile</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="../controllers/logout.php">Logout</a>
			        </div>
      			</li>


		    <?php } else { ?>

		    	<!-- LOGIN -->
		    	<li class="nav-item <?php if(isset($login_active)) { echo $login_active; } ?>">
			        <a class="nav-link" href="./login.php">Login</a>
			    </li>
			    
			    <!-- REGISTER -->
			    <li class="nav-item <?php if(isset($register_active)) { echo $register_active; } ?>">
			        <a class="nav-link" href="../views/register.php">Register</a>
			    </li>

		    <?php } ?>					    
		</ul>
	</div>
</nav>
