
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
	    		<ul class="navbar-nav mr-auto">
        			<form class="form-inline my-2 my-lg-0" action="<?php echo URLROOT ;?>/movies/findMovie" method="post">
						<input class="form-control mr-sm-2" id="searcMovieBar" name="search" type="text" placeholder="Search for Movies" aria-label="Search" 
						 style="width:450px;" autocomplete="off">
        			</form>  
    			</ul>
  			</div>
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">English</a>
						<div class="dropdown-menu" aria-labelledby="dropdown01">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo URLROOT;?>/users/	login">Sign In</a>
						</li>
					</li>
				</ul>
			</div>
	<?php endif ;?>
  
</nav>



