<?php $ticketSummary=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
</style>
<div class="row">
    <div class="col-md-7">
        <?php if(!isLoggedin()):?>
            <div class="card m-3">
                <div class="card-header" style="background-color: mediumseagreen; ">
                    <span class="text-white ml-3">
                        <i class="fa fa-caret-down mr-3"></i> Share your Contact Details For doing Payement
                    </span>
                </div>
                <div class="card-body">
                    <form class="form-inline">
                        <input class="form-control mr-2 mb-2" type="text" id="email" placeholder="Enter Email">
                        <input class="form-control mr-2 mb-2" type="phone" id="phone" >

                        <button class="btn btn-primary px-3 mb-2" type="submit">Continue</button>
                    </form>
                </div>
            </div>
        <?php else :?>
            <div class="m-3">
                <img src="<?php echo URLROOT;?>/img/enjoyMovieImage.jpg" alt="..">
            </div>
        <?php endif;?>
    </div>
    <div class="col-md-4">
        <div class="card m-3 p-3">
            <p>ORDER SUMMARY</p>
            <span class="text-right pr-3">2</span>
            <span class="text-right">Tickets</span>
            <span><script>document.write(localStorage.getItem('movieSelected'));</script></span>
            <span><script>document.write(localStorage.getItem('hallSelected'));</script></span>
            <br>
            <span><script>document.write(localStorage.getItem('seatsSelected'));</script></span>
            <span><script>document.write(localStorage.getItem('dateSelected'));</script></span>
            <span>Time</span>
            <br>
            <hr>
            <div class="row">
                <div class="col text-muted">Sub Total</div>
                <div class="col text-right">Rs. <script>document.write(localStorage.getItem('payableAmount'));</script></div>
            </div>
            <div class="row mt-3 p-3" style="background-color:#fffcdc;">
                <div class="col pt-1" style="font-size:12px;">Amount Payable</div>
                <div class="col text-right font-weight-bold" style="font-size:17px;">Rs. <script>document.write(localStorage.getItem('payableAmount'));</script></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 offset-md-7">
        <a href="<?php echo URLROOT;?>/payments">
            <button class="btn btn-primary btn-lg btn-block <?php echo !isLoggedin() ? 'disabled' : '' ;?>">Make Payment</button>
        </a> 
    </div>
</div>






                    