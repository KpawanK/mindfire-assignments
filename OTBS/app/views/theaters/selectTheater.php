<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
    .modal-content{
        height: 450px;
        width: 515px;
    }
    .date-active{
        background-color: blue;
        color: #fff;
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
<div class="ml-4" id="dateSlider">
    <ul class="list-unstyled list-inline">
        <?php $i=0; foreach($data['uniqueDates'] as $key=>$dates):?>
            <li class='<?php echo ( $i == 0 ) ? "date-active" : ""; ?> list-inline-item btn mt-1' data-date="<?php echo $key ;?>"> 
                <?php echo $dates[0];?>
                <br>    
                <?php echo $dates[1];?>
            </li>
        <?php $i++; endforeach;?>
    </ul>
</div>


<!-- HALL TIMIMGS CARD -->

<div class="card m-3" id="hall-timings-card">  
     <h2 class="text-center">
         <strong>
            NO SHOWS FOUND!!
         </strong>
     </h2>
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
    //SCRIPT FOR RETREIVING THE HALL ID FROM THE DATA ATTTRIBUTE OF CLICKED BUTTON
    var controller_method_path = "<?php echo URLROOT.'/seats/selectSeats/'; ?>";
    $(document).on("click","#movie-time .btn", function(){
        var hallId = $(this).attr("data-hall-id");
        $('#policy_accept').attr("href",controller_method_path + hallId );
    });

    // AJAX CALL FOR THE MOVIE SHOW TIMINGS
    $("#dateSlider ul li").on('click',function(){
        $('#dateSlider ul li').removeClass('date-active');
        $(this).addClass('date-active');
        date=$(this).attr('data-date');
        $.ajax({
            url:URLROOT+'/theaters/selectTimings',
            method:'post',
            data:{
                "date":date,
                "movieId":'<?php echo $data['movieDetails']->movie_id;?>',
            },
            success:function(data){
                $('#hall-timings-card').html(data);
            }
         });
    });
</script>
<?php include APPROOT . '/views/inc/footer.php';?>
