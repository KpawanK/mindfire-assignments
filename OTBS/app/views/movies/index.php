<?php include APPROOT . '/views/inc/header.php';?>
    <style> 
       .back-image{
            background-image: linear-gradient(rgba(0, 0, 0, 0.80),rgba(0, 0, 0, 0.80)),url(<?php echo URLROOT .'/img/'.$data['movieDescription']->movie_image?>);
            height: 16vw;
            background-size: cover; 
            background-position: center;
       }
        .movie-details h1,
        .movie-details p{
            color: white;
        }   
    </style>
    <div class="back-image">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="https://www.youtube.com/embed/4QvqHwH_je8">
                        <img src="<?php echo URLROOT .'/img/'.$data['movieDescription']->movie_image?>" class="img-fluid mt-5" style="height: 286px; width:240px;">
                    </a>
                </div>
                <div class="col-md-9">
                   <div class="mt-5 movie-details">
                        <h1>
                            <?php echo $data['movieDescription']->movie_name ;?>
                        </h1>
                        <p>
                            <i class="fa fa-calendar"><?php echo ' ' . $data['movieDescription']->movie_date;?></i>
                            <i class="fa fa-clock-o"><?php echo ' ' . $data['movieDescription']->movie_time;?></i>
                        </p>
                   </div>
                   <div class="mt-5 book-tickets">  
                        <?php if(1 == $data['movieDescription']->movie_status) :?>
                            <a href="<?php echo URLROOT .'/theaters/selectTheater/'. $data['movieDescription']->movie_id ;?>" class="btn btn-primary pull-right mr-5 mt-5">
                                <i class="fa fa-ticket"></i>Book Tickets
                            </a>
                        <?php endif; ?>
                   </div>
                </div>
            </div>
        </div>
    </div>
    
