<?php $ticketSummary=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
</style>
<div class="row">
    <div class="col-md-7">
        <div class="card m-3">
            <div class="card-header" style="background-color: mediumseagreen; ">
                <span class="text-white ml-3">
                    <i class="fa fa-caret-down mr-3"></i> Share your Contact Details
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
    </div>
    <div class="col-md-4">
        <div class="card m-3 p-3">
            <p>ORDER SUMMARY</p>
            <span class="text-right pr-3">2</span>
            <span class="text-right">Tickets</span>
            <span>Movie Name</span>
            <span>Hall Name</span>
            <br>
            <span><script>document.write(localStorage.getItem('seatsSelected'));</script></span>
            <span>Day,Date</span>
            <span>Time</span>
            <br>
            <hr>
            <div class="row">
                <div class="col text-muted">Sub Total</div>
                <div class="col text-right">Rs. amount</div>
            </div>
            <div class="row mt-3 p-3" style="background-color:#fffcdc;">
                <div class="col pt-1" style="font-size:12px;">Amount Payable</div>
                <div class="col text-right font-weight-bold" style="font-size:17px;">Rs. amount</div>
            </div>
        </div>
    </div>
</div>




<!-- <input class="form-control mr-2" type="email" id="email" placeholder="Enter email">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+91</span>
                    </div>    
                    <input class="form-control mr-2 " type="tel" id="phone" >
                    <button class="btn btn-primary px-4" type="submit">Continue</button>   -->


                    