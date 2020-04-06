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
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <!-- <a href="https://www.youtube.com/embed/4QvqHwH_je8"> -->
                        <img src="<?php echo URLROOT .'/img/'.$data['movieDescription']->movie_image?>" class="img-fluid mt-5" style="height: 286px; width:240px;">
                    </a>
                </div>
                <div class="col-9">
                   <div class="mt-5 movie-details">
                        <h1>
                            <?php echo $data['movieDescription']->movie_name ;?>
                        </h1>
                        <p>
                            <i class="fa fa-calendar"><?php echo ' ' . $data['movieDescription']->movie_date;?></i>
                            <i class="fa fa-clock-o"><?php echo ' ' . $data['movieDescription']->movie_time;?></i>
                        </p>
                        <?php 
                            $tags = explode(",",$data['movieDescription']->movie_tags);
                            echo "<ul class='list-unstyled list-inline'>";
                            foreach($tags as $tag){
                                echo "<li class='list-inline-item text-muted px-2' style='border-radius: 25px;
                                border: 1px solid white;font-size: 13px;'>".$tag."</li>";
                            }
                            echo "</ul>";
                        ?>
                   </div>
                   <div class="mt-5 book-tickets">  
                        <?php if(1 == $data['movieDescription']->movie_status) :?>
                            <a href="<?php echo URLROOT .'/theaters/selectTheater/'. $data['movieDescription']->movie_id ;?>" class="btn btn-primary pull-right mr-5 mt-5">
                                <i class="fa fa-ticket text-danger"></i> Book Tickets
                            </a>
                        <?php endif; ?>
                   </div>
                </div>
                
            </div>
            <div class="col-9 offset-3">
                <ul class="list-unstyled list-inline mb-5">
                    <li class="list-inline-item">
                        <strong style="font-size: 20px;border-bottom: 3px solid green;" class="pb-2">
                            Summary
                        </strong>  
                    </li>
                </ul>
                <div id="movieSummary" class="mb-5">
                    <h6><Strong>SYNOPSIS</Strong></h6>
                    <p>
                        <?php echo $data['movieDescription']->movie_content;?>
                    </p>
                </div>
                <div id="movieCast">
                    <h6><Strong>CAST & CREW</Strong></h6>
                    <ul class="list-unstyled list-inline">
                        <?php foreach($data['castDescription'] as $cast):?>
                            <li class="list-inline-item">
                                <span>
                                    <img src="<?php echo URLROOT . '/img/cast/'.$cast->cast_image;?>" alt="castImage" class="mr-3 mb-2" style="height: 130px;width:130px;border-radius: 50%;">
                                    <br>
                                    <p class="text-center">
                                        <?php echo $cast->cast_name;?> 
                                        <br>
                                        <?php echo $cast->cast_role==0 ? 'Director' : 'Actor';?>
                                    </p>
                                </span>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>        
            </div>
        </div>
    </div>

<script>
    // set cookie with the movie image name selected
    $(document).ready(function(){
        var movieImage = '<?php echo $data['movieDescription']->movie_image?>';
        document.cookie = "movieImage="+movieImage+";path=/ ";  
    });
</script>                     
    
<?php include APPROOT . '/views/inc/footer.php';?>
