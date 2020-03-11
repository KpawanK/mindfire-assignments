<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<?php if(isset($isCheckout)) :?>
		<div class="btn text-white" id="no-of-tickets" data-toggle="modal" data-target="#noOfTicketModal">
				2 tickets 
				<i class="fa fa-caret-down"></i>
		</div>
		<?php elseif(isset($ticketSummary)) :?>
			<a class="navbar-brand" href="<?php echo URLROOT;?>"><?php echo SITENAME;?></a>
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
					<li class="nav-item">
						<a href="<?php echo URLROOT;?>/users/register" class="nav-link">Register</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo URLROOT;?>/users/login" class="nav-link">Login</a>
					</li>
				</ul>
			</div>
	<?php endif ;?>
  
</nav>

