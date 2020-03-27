<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
    .modal-content{
        height: 450px;
        width: 515px;
    }
</style>
<div style="background-color: #212529" class="text-white px-3">
    Movies
</div>

<!-- MOVIE DESCRIPTION SECTION -->
<div class="bg-dark">
    <div class="row px-3">
        <div class="col-md-6">
            <h1 class="display-5 text-white pt-4"><?php echo $data['movieDetails']->movie_name ;?></h1>
            <p>
                <i class="fa fa-calendar text-white"><?php echo ' ' . $data['movieDetails']->movie_date;?></i>
                <i class="fa fa-clock-o text-white"><?php echo ' ' . $data['movieDetails']->movie_time;?></i>
            </p>
        </div>

        <!-- CAST SECTION -->
        <div class="col-md-6">
            <div class="row px-3">
                <div class="dir_info mt-4 ml-auto">
                    <span style="font-size: 10px;" class="text-white">DIRECTOR</span>
                    <br>
                        <div class="row ml-1 mr-2">
                            <span class="m-2">
                                <div>
                                <img style="border-radius:50%;height:40px;" alt="Dan Scanlon" title="Dan Scanlon" data-error="//in.bmscdn.com/webin/profile/user.jpg" data-src="//in.bmscdn.com/iedb/artist/images/website/poster/large/dan-scanlon-36180-03-03-2020-03-12-59.jpg" src="//in.bmscdn.com/iedb/artist/images/website/poster/large/dan-scanlon-36180-03-03-2020-03-12-59.jpg"></a>
                                </div>
                                <span style="font-size: 10px;" class="text-white">Name</span>
                            </span>

                        </div>
                </div>

                <div class="cast_info mt-4">
                    <span style="font-size:10px;" class="text-white">CAST & CREW</span>
                    <br>
                    <div class="row ml-1">
                        <span class="m-2">
                            <div>
                            <img style="border-radius:50%;height:40px;" alt="Dan Scanlon" title="Dan Scanlon" data-error="//in.bmscdn.com/webin/profile/user.jpg" data-src="//in.bmscdn.com/iedb/artist/images/website/poster/large/dan-scanlon-36180-03-03-2020-03-12-59.jpg" src="//in.bmscdn.com/iedb/artist/images/website/poster/large/dan-scanlon-36180-03-03-2020-03-12-59.jpg"></a>

                            </div>
                            
                            <span style="font-size: 10px;" class="text-white">Name</span>
                        </span>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- MOVIE DATE SLIDER -->
<div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2" data-ride="carousel">
    <!--Controls-->
    <div class="controls-top">
        <a class="btn-floating" href="#carousel-example-multi" data-slide="prev"><span class="carousel-control-prev-icon bg-primary"></span></a>
        <a class="btn-floating" href="#carousel-example-multi" data-slide="next"><span class="carousel-control-next-icon bg-primary"></span></a>
    </div>
    <!--/.Controls--> 
    <!-- INDICATORS -->
    <div class="carousel-inner v-2" role="listbox">
        <div class="carousel-item active">
            <div class="col-12 col-md-4">
                <div class="card mb-2">
                    <img class="card-img-top" src="<?php URLROOT;?>/img/casts/Vicky_Kaushal.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                        <a class="btn btn-primary btn-md btn-rounded">Button</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- HALL TIMIMGS CARD -->

<div class="card m-3">  
    <?php if($data['theaterDetails'] == 'false'):?>
        <div class="text-center">
            <h3><Strong>No Shows Found!!</Strong></h3>
        </div>
    <?php else:
    // PROCESSING THE HALL DETIALS TO MAKE TIMINGS GROUP TO THEIR HALL NAME
        $theaterNames=[];
            foreach($data['theaterDetails'] as $theater){
                if(!in_array($theater->hall_name,$theaterNames)){
                    $theaterNames[$theater->hall_name]=[];
                    $theaterNames[$theater->hall_name]=array( 
                        'movie_id' => $theater->movie_id,
                        'hall_id' => $theater->hall_id,
                        'timing' => array(),
                    );
                }
            }
            foreach($data['theaterDetails'] as $theater){
                array_push($theaterNames[$theater->hall_name]['timing'],$theater->timings);
            }
        ?>
        <!-- DISPLAYING THE PRE PROCESSED DATA  -->
        <div class="container">
            <?php foreach($theaterNames as $key=>$value) :?>
                <div class="row">
                    <div class="col-4 pt-3">
                        <a href="#" class="text-dark"><strong><?php echo $key;?> </strong></a>
                    </div>
                    <div class="col-8 pt-4">
                        <ul class="list-unstyled list-inline" id="movie-time"> 
                            <?php foreach($value['timing'] as $temp) : ?>
                                <li class="list-inline-item">
                                    <button class="btn btn-light text-success m-1" data-toggle="modal" data-target="#notes" data-movie-id =<?php echo $value['movie_id'] ;?> data-hall-id=<?php echo $value['hall_id'] ;?>>
                                        <?php echo $temp; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    <?php endif;?>
</div>


<!-- TERMS AND CONDITION MODAL -->
<div class="modal fade m-3" id="notes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notes</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Tickets are compulsory for children 3 years and above.</li>
                    <li>Outside eatables and beverages are not allowed.</li>
                    <li>The ticket is not transferable or refundable.</li>
                    <li>Rights of admission are reserved.</li>
                    <li>If there is any show breakdown or cancellation due to technical reasons, your money will be 
                        refunded online by Online booking partner and not at the theatre.
                    </li>
                    <li>Only Online booking partner server messages are allowed, printouts & forwarded messages are 
                        not allowed for both F&B and movie tickets.
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a id="policy_accept" href="<?php echo URLROOT .'/seats/selectSeats/'  ;?>" class="btn btn-primary"> Accept</a>
            </div>
        </div>
    </div>
</div>






<script>
    var controller_method_path = "<?php echo URLROOT.'/seats/selectSeats/'; ?>";
    $('#movie-time .btn').click( function(){
        var hallId = $(this).attr("data-hall-id");
        $('#policy_accept').attr("href",controller_method_path + hallId );
    });
</script>
<?php include APPROOT . '/views/inc/footer.php';?>
