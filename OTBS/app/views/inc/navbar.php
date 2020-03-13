<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
	<!-- Navbar look in select seats section -->
	<?php if(isset($isCheckout)) :?>
		<div class="col-6">
			<a href="javascript:history.go(-1)" class="ml-5"><i class="fa fa-backward text-white"></i></a>
		</div>
		<div class="col-6">
			<div class="float-right">
				<a href="javascript:history.go(-1)"><i class="fa fa-times text-white mt-2 ml-5"></i></a>
			</div>
			<div class="btn text-white float-right" id="no-of-tickets" data-toggle="modal" data-target="#noOfTicketModal">
				2 tickets 
				<i class="fa fa-caret-down"></i>
			</div>			
		</div>
		<!-- Navbar look in ticket summary section -->
		<?php elseif(isset($ticketSummary)) :?>
			<div class="col-6">
				<a href="javascript:history.go(-2)" class="ml-5"><i class="fa fa-backward text-white"></i></a>
			</div>
			<div class="col-6">
				<a href="javascript:history.go(-2)" class="float-right"><i class="fa fa-times text-white"></i></a>
			</div>
		</div>
		<!-- Navbar look iin all places  -->
		<?php else :?>
			<a class="navbar-brand" href="<?php echo URLROOT;?>"><?php echo SITENAME;?></a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  			</button>
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<form class="form-inline my-2 my-lg-0" action="<?php echo URLROOT ;?>/movies/findMovie" method="post">
					<input class="form-control mr-sm-2" id="searchMovieBar" name="search" type="text" placeholder="Search for Movies" aria-label="Search" style="width:450px;" autocomplete="off">
				</form>  
  			</div>
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav ml-auto">
					<?php if(isset($_SESSION['user_id'])) :?>
						<li class="nav-item">
							<a href="#" class="nav-link">Welcome <?php echo $_SESSION['user_name'];?></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo URLROOT;?>/users/logout" class="nav-link">Logout</a>
						</li>
					<?php else :?>
						<li class="nav-item">
							<a href="<?php echo URLROOT;?>/users/register" class="nav-link">Register</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo URLROOT;?>/users/login" class="nav-link">Login</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
	<?php endif ;?>
  
</nav>

