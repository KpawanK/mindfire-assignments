<?php include APPROOT . '/views/inc/header.php';?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success');?>
            <h2>OTP Verification</h2>
            <p>Please enter the OTP sent to your registered email address</p>
            <form action="<?php echo URLROOT.'/users/otpVerify/'.$data['email'] ;?>" method="POST">
                <div class="form-group">
                    <label for="otp">OTP: <sup>*</sup></label>
                    <input type="text" name="otp" class="form-control form-control-lg <?php echo (!empty($data['otp_err'])) ?'is-invalid' : '' ;?>" value="<?php echo $data['otp'];?>">
                    <span class="invalid-feedback"><?php echo $data['otp_err'];?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Submit" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>