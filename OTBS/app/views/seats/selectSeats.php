<?php $isCheckout=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }

    /* seat layout style sheet */
    .layout{
        background-color: white;
        margin-left:auto;
        margin-right:auto;
    }
    .boundary{
        border: 1px solid black;
        border-radius: 5px;
    }
    .wrapSeats{
        display: block;
        width: max-content;
        margin: 2rem auto
    }
    .seat,
    .seatRowName{
        min-width: 26px;
        margin: 3px;
        text-align: center;
    }
    .seat:hover{
        background-color: deepskyblue;
        cursor: pointer;
    }
    .seat:hover span{
        color: white;
    }
    .seatMarkActive{
        background-color: deepskyblue;
    }
    /* modal style style sheet */

    .modal-content{
        height: 450px;
        width: 515px;
    }
    .active,
    ul#seatQuantity li:hover {
        background-color: deepskyblue;
        color: white;
    }
</style>

<!-- Seat layout Section-->

<div class="layout">
    <div class="wrapSeats">
    <?php 
        $seat=0;
        $count=1;
        $r=65;

        // Seat Layout

        for($row=0 ; $row < $data['seatInfo']->hall_no_rows ; $row++){
            echo "<div class='seatRowName d-inline-block'>".chr($r+$row)."</div> ";
            for($col=0 ; $col < $data['seatInfo']->hall_no_cols ; $col++):?>
                    <div class="d-inline-block seat boundary text-muted seatMark" id="<?php echo $count++;?>">
                        <span>
                            <?php echo $seat+1;?>
                        </span>
                    </div>
                    <?php $seat++;   
                endfor;
                $seat=0;
            ?>
            
            <br> 

        <?php }
    ?>
    </div>
    <div>
        <p style="text-align: center;">All eyes this way please!</p> 
    </div>

    <!-- Fixed Navigation Bottom -->
    <nav class="navbar  fixed-bottom d-none" id="payAmount">
        <button class="btn btn-success btn-block ">
            Pay Amount
        </button>
    </nav>
</div>

<!-- NUMBER OF TICKET SELECTION MODAL -->

<div class="modal fade m-3" id="noOfTicketModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <p >How many seats?</p>
            </div>
             <div class="modal-body">
                 <div class="container mb-3" style="height:200px;">
                     <img class="d-block img-fluid imgh" src="<?php echo URLROOT . '/img/vehicles/' . '2.jpeg' ;?>" alt="seatVehicleImage" style="
                        margin-left: auto;
                        margin-right: auto; 
                    ">
                 </div>
                 <div class="container">
                    <ul class="list-unstyled list-inline ml-3" id="seatQuantity">
                        <li class="list-inline-item btn" id="1" >1</li>
                        <li class="list-inline-item btn active" id="2">2</li>
                        <li class="list-inline-item btn" id="3" >3</li>
                        <li class="list-inline-item btn" id="4" >4</li>
                        <li class="list-inline-item btn" id="5" >5</li>
                        <li class="list-inline-item btn" id="6" >6</li>
                        <li class="list-inline-item btn" id="7" >7</li>
                        <li class="list-inline-item btn" id="8" >8</li>
                        <li class="list-inline-item btn" id="9" >9</li>
                    </ul>
                    <button class="btn btn-primary btn-block" data-dismiss="modal">
                        Select Seats
                    </button>
                 </div>
             </div>
        </div>
    </div>
</div>


<script>
    let toSelect=2;
    let noOfColumns = "<?php echo $data['seatInfo']->hall_no_cols;?>"; 
    // Auto load ticket modal on page load

    $(document).ready(function(){
        $("#noOfTicketModal").modal('show');
    });
    /* Add active class to the current button of select no of seat modal (highlight it) */

    $('ul#seatQuantity li.btn').on( 'click', function(){
        $('.btn').removeClass('active');
        $(this).addClass('active');
        var quantity=$(this).attr('id');
        toSelect=quantity;
        $('#no-of-tickets').html(quantity + ' tickets   <i class="fa fa-caret-down"></i>' );
        
    });
    var base_image_path = "<?php echo URLROOT.'/img/vehicles/'; ?>";

    $('#seatQuantity .btn').hover(function(){
        //this code will execute when mouse enters the html element
        var file_name = this.id + '.jpeg';
        $('.imgh').attr("src", base_image_path + file_name );
    },
    function(){
        //this code will execute when mouse leaves the html element
        var active_seat = $('#seatQuantity li.active');
        active_seat = active_seat.attr('id');
        var file_name = active_seat + '.jpeg';
        $('.imgh').attr("src", base_image_path + file_name );
    }); 

    // Mark Seats
    $('.seatMark').on('click' , function(){
        var seatNumber = $(this).attr('id');
        var r=(seatNumber % noOfColumns === 0)? Math.floor(seatNumber/noOfColumns) : Math.floor(seatNumber/noOfColumns+1);
        var c=(seatNumber % noOfColumns === 0)? noOfColumns : seatNumber%noOfColumns;
        if(noOfColumns-c+1 <= toSelect){
            var i;
            seatNumber=parseInt(seatNumber)
            for(i=0 ; i< toSelect ; i++){
                $(`#${seatNumber+i}`).addClass('seatMarkActive');
                $(`#${seatNumber+i}`).children('span').addClass('text-white');    
            }
            $('#payAmount').addClass('d-block');
        } else{

        }
    });
</script>