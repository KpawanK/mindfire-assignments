<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
    .modal-content{
        height: 450px;
        width: 515px;
    }
    .checked{
        
        padding: 6px 10px;
        border-radius: 2px;
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
            }
        }
        foreach($data['theaterDetails'] as $theater){
            array_push($theaterNames[$theater->hall_name],$theater->timings);
        }
?>
        <div class="container">
            <?php foreach($theaterNames as $key=>$name) :?>
                <div class="row">
                    <div class="col-4 pt-3">
                        <a href="#" class="text-dark"><strong><?php echo $key ;?> </strong></a>
                    </div>
                    <div class="col-8 pt-4">
                        <ul class="list-unstyled list-inline"> 
                            <?php foreach($name as $temp) : ?>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-light text-success" role="button"
                                    data-toggle="modal" data-target="#noOfTicketModal" ><?php echo $temp; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
</div>
<!-- NUMBER OF TICKET SELECTION MODAL -->
<div class="modal fade m-3" id="noOfTicketModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="align-self">How many seats?</p>
            </div>
             <div class="modal-body">
                 <div class="container">
                    <ul class="list-unstyled list-inline ml-5">
                        <li class="list-inline-item checked" id="1" onmouseover="seatMark(this)" onclick="">1</li>
                        <li class="list-inline-item checked" id="2" onmouseover="seatMark(this)" onclick="">2</li>
                        <li class="list-inline-item checked" id="3" onmouseover="seatMark(this)" onclick="">3</li>
                        <li class="list-inline-item checked" id="4" onmouseover="seatMark(this)" onclick="">4</li>
                        <li class="list-inline-item checked" id="5" onmouseover="seatMark(this)" onclick="">5</li>
                        <li class="list-inline-item checked" id="6" onmouseover="seatMark(this)" onclick="">6</li>
                        <li class="list-inline-item checked" id="7" onmouseover="seatMark(this)" onclick="">7</li>
                        <li class="list-inline-item checked" id="8" onmouseover="seatMark(this)" onclick="">8</li>
                        <li class="list-inline-item checked" id="9" onmouseover="seatMark(this)" onclick="">9</li>
                    </ul>
                    <button class="btn btn-primary btn-block">
                        Select Seats
                    </button>
                 </div>
             </div>
        </div>
    </div>
</div>
<script>
    function seatMark(item){
        console.log(getElementById(item.id));
    }
</script>
<?php include APPROOT . '/views/inc/footer.php';?>
