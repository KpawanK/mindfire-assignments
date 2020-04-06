<?php include APPROOT . '/views/inc/header.php';?>
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails mt-3" data-ride="carousel">
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
    <style>
        a:hover{
            text-decoration: none;
        }
    </style>
    <div class="container mt-5">
        <h2 class="mt-3"><strong>Movies</strong></h2>
        <div class="row ml-2">
            <?php foreach($data['movies'] as $movie) :?>
                <div class="card mb-4 mr-4">
                    <a href="<?php echo URLROOT .'/movies/index/'. $movie->movie_id ;?>">
                        <img src="<?php echo URLROOT .'/img/'.$movie->movie_image?>" alt="Movie Image" class="card-img-top img-fluid" style="height:300px;width:250px;">
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

    <!-- <script>
       $(document).ready(function(){
            var res = document.cookie;
            var multiple = res.split(";");
            for(var i = 0; i < multiple.length; i++) {
                var key = multiple[i].split("=");
                document.cookie = key[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
            }
       });
    </script> -->
    <script>    
        // Destroy all the cookies set
        $(document).ready(function(){
            document.cookie = "hallSelected=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "movieSelected=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "movie_timing_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "numberOfSeats=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "payableAmount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "seatsSelected=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "time=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "movieImage=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        });
    </script>
<?php include APPROOT . '/views/inc/footer.php';?>





