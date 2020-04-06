<?php $paymentSuccess=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        background-color: #80808033;
    }
    .ticket {
        position: relative;
        border: 2px solid #80808033;
        background: white;
        color: black;
        text-align: center;
        display: inline-block;
        padding: 1em 2em;
    }
    .ticket:before,
    .ticket:after{
        content: '';
        position: absolute;
        top: 0.9em;
        top: calc(105px);
        height: 2.2em;
        width: 0.6em;
        border: 8px solid #80808033;
    }
    .ticket:before {
        left: -2px;
        border-radius: 0 1em 1em 0;
        border-left-color: #80808033;
    }
    .ticket:after {
        right: -2px;
        border-radius: 1em 0 0 1em;
        border-right-color: #80808033;
    }
</style>

<body>
    <div class="container mt-4" >
        <h2>Thank You for purchasing <?php echo $data['product'];?></h2>
        <hr>
        <div class="row">
            <div class="col-4">
                <p>Your transaction ID is <?php echo $data['tid'];?></p>
                <p>Check your mail for more info</p>
                <p>
                    <!-- <a href="<?php echo URLROOT .'/pages';?>" class="btn btn-light mt-2">
                        Continue Shopping
                    </a> -->
                    <a href="<?php echo URLROOT .'/payments/createPDF';?>" class="btn btn-warning mt-2">
                        Mail E-ticket & Continue Shopping
                    </a>
                </p>
            </div>
            <div class="col-8">
                <div class="text-center" style="color: green;">
                    <span>
                        <i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
                        <br>
                        <p><Strong>Your Booking is Confirmed</Strong></p>
                    </span>
                </div>
                
                <!-- Ticket -->
                <div class="ticket" style="margin-left: 133px">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo URLROOT.'/img/'.$_COOKIE['movieImage'];?>" style="height:100px;width:100px;" alt="Movie Image">
                        </div>
                        <div class="col-9">
                            <span>
                                <strong>    
                                    <?php echo $_COOKIE['movieSelected'];?>
                                </strong>
                            </span>
                            <br>    
                            <span class="text-muted">
                                Hindi,2d
                            </span>
                            <br>
                            <span>
                                <strong>    
                                    <?php echo $_COOKIE['time'];?>
                                </strong>
                            </span>
                            <br>
                            <span class="text-muted">
                                <?php echo $_COOKIE['hallSelected'];?> Dolby Digital
                            </span>
                        </div>
                    </div>
                    <hr class="text-muted" style="border-top: dotted 2px;">
                    <span class="mr-5">
                        <?php echo $_COOKIE['numberOfSeats'];?> Ticket(s)
                    </span>                   
                    <span class="text-muted">
                        <?php echo $_COOKIE['hallSelected'];?>
                    </span>
                    <br>
                    <span>
                        <strong>
                            Balcony: <?php echo $_COOKIE['seatsSelected'];?>
                        </strong> 
                    </span>
                    <hr class="text-muted" style="border-top: dotted 2px;">
                    <span style="font-size: 15px;">
                        You can cancel the tickets 4 hour(s) before the show.
                        <br>
                        Refunds will be done according to the Cancellation Policy.    
                    </span>
                </div>
                <p  class="text-center text-muted mt-2" style="font-size: 13px;">
                    Booking powered by <i class="fa fa-ticket text-danger" aria-hidden="true"></i> OTBS
                </p>
            </div>
        </div>
    </div>
</body>
</html>