<?php $payment=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<link rel="stylesheet" href="<?php URLROOT;?>/css/payments/style.css">
<div class="container">
    <h2 class="my-4 text-center">Welcome To Payment</h2>
    <form action="<?php echo URLROOT .'/payments/charge'?>" method="post" id="payment-form">
        <div class="form-row">
            <input type="text" name="name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Name on Card">
            <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
            <div id="card-element" class="form-control">
            <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
        </div>

        <button>Submit Payment</button>
    </form>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?php URLROOT;?>/js/payments/charge.js"></script>
