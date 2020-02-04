<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/PHP/resources/css/login-form-style.css">
    <link rel="stylesheet" type="text/css" href="/PHP/vendors/css/Grid.css">
    <title>Login</title>
</head>
<body style="overflow-x:hidden"> 
<header>
    <div class="row">
    <div class="row">
        <h1>mindfire solutions</h1>
    </div>
    </div>
    <form method="post" action="login.php" class="login-credentials">
        <div class="row login_credentials">
            <label for="name">Name</label>
            &nbsp;
            <input type="text" name="name" id="name" placeholder="Your Name" required>
            &nbsp;
            <label for="password">Password</label>
            &nbsp;
            <input type="password" name="password" id="password" placeholder="Your Password" required>
            <label>&nbsp;</label>
            <input type="submit" value="login">
            <?php 
            if ( isset( $_GET["msg"] ) && "Invalid Credentials" == $_GET["msg"] ) : ?>
                <div class="alert alert-danger result">Invalid Credentials</div>
            <?php endif; ?>
        </div>
    </form>
</header>
<section class="create_account">
    <div class="row">
        <div class="col span-1-of-2">
            <ul class="mindfire_pics">
            <li><img src="../images/1.jpeg" class="office_pic" width="300" height="168"></li>
            <li><img src="../images/6.jpeg"class="office_pic"></li>

            </ul>
            <ul class="mindfire_pics">
            <li><img src="../images/3.jpeg"class="office_pic"></li>
            <li><img src="../images/logo.jpeg"class="office_pic logo"></li>
            </ul>
        </div>
     <div class="col span-1-of-2">
        <h2>Create an account</h2>
        <p class="text">It's quick and easy</p>
        <br>
        <form method="post" action="signUp.php" class="login-credentials">
            <input type="text" name="name"  placeholder="Your Name" required>
            <input type="password" name="password" id="name" placeholder="New Password" required>
            <br>
            <p class="policy">By clicking Sign Up,you agree to our Terms,Data Policy and Cookie Policy.</p>
            <input class="signUp" type="submit" name="submit" value="Sign Up">
            <?php 
            if ( isset( $_GET["msg"] ) && "success" == $_GET["msg"] ) :?>
                <div class="alert alert-success result">Successfully Signed up</div>
            <?php endif; ?>
            <?php
            if ( isset( $_GET["msg"] ) && "failure" == $_GET["msg"] ) :?>
                <div class="alert alert-danger result"> Sign up Failed</div>
             <?php endif; ?> 
             <?php
            if ( isset( $_GET["msg"] ) && "account_exists" == $_GET["msg"] ) :?>
                <div class="alert alert-danger result">Account Exists</div>
             <?php endif; ?> 
              <?php
            if ( isset( $_GET["msg"] ) && "nameFailure" == $_GET["msg"] ) :?>
                <div class="alert alert-danger result">Name can have only spaces </div>
             <?php endif; ?> 
              <?php
            if ( isset( $_GET["msg"] ) && "passwordFailure" == $_GET["msg"] ) :?>
                <div class="alert alert-danger result">Password length should be greater than 7</div>
             <?php endif; ?> 
              <?php
            if ( isset( $_GET["msg"] ) && "bothFailure" == $_GET["msg"] ) :?>
                <div class="alert alert-danger result">Invalid Sign Up credentials</div>
             <?php endif; ?> 
         </form>
     </div>
    </div>
</section>
</body>
</html>