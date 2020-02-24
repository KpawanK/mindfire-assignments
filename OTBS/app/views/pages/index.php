<?php include APPROOT . '/views/inc/header.php';?>
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <?php foreach($data['carousels'] as $key => $carousel) :?>
                <div class='carousel-item <?php echo ( $key == 0 ) ? "active" : ""; ?>'>
                    <img class="d-block w-100" src="<?php echo URLROOT . '/img/carousel/' . $carousel->carousel_image;?>">
                </div>
            <?php endforeach; ?>

        </div>
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach($data['carousels'] as $key => $carousel) :?>
                <li data-target="#carousel-thumb" data-slide-to="<?php echo $key;?>" class='<?php echo ( $key == 0 ) ? "active" : ""; ?>'>
                    <img src="<?php echo URLROOT . '/img/carousel/' . $carousel->carousel_image;?>" width="100">
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
    <h2 class="mt-3"><strong>Movies</strong></h2>
    <div class="container mt-5">
        <div class="row">
            <?php foreach($data['movies'] as $movie) :?>
                <div class="card mr-5" style="width: 18rem;">
                    <a href="<?php echo URLROOT .'/movies/getMovieDescription/'. $movie->movie_id ;?>" style="color: black;">
                        <img src="<?php echo URLROOT .'/img/'.$movie->movie_image?>" class="card-img-top" alt="..." style="height:286px" width="286px">
                        <div class="card-body">
                            <p class="card-text">
                                <i class="fa fa-heart" style="color: red;"></i>
                                <?php echo ' ' . $movie->movie_name ;?>

                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php include APPROOT . '/views/inc/footer.php';?>
