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
<div class="bg-dark">
    <div class="row mx-3">
        <div class="col-md-6">
            <h1 class="display-5 text-white pt-4"><?php echo $data['movieDetails']->movie_name ;?></h1>
            <p>
                <i class="fa fa-calendar text-white"><?php echo ' ' . $data['movieDetails']->movie_date;?></i>
                <i class="fa fa-clock-o text-white"><?php echo ' ' . $data['movieDetails']->movie_time;?></i>
            </p>
        </div>
        <div class="col-md-6">
            <h1 class="display-5 text-white pt-4"><?php echo $data['movieDetails']->movie_name ;?></h1>
        </div>
    </div>
</div>

<!-- HALL TIMIMGS CARD -->

<div class="card m-3">
<?php 
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
                                    <button class="btn btn-light text-success" data-toggle="modal" data-target="#notes" data-movie-id =<?php echo $value['movie_id'] ;?> data-hall-id=<?php echo $value['hall_id'] ;?>>
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
</div>
<!-- NOTES MODAL -->
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
