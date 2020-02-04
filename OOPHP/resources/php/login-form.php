<?php include "users.php" ?>
<?php 
    $invalid=false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['submit']=='Sign Up'){
            $newUser = new Users;
            $result = $newUser -> signUp( $_POST );
            $invalid = $result;
        }
        else{
            $newUser = new Users();
            $result = $newUser -> logIn( $_POST );
            $invalid = $result;
        }
    }
?>


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
    <form method="post" action="login-form.php" class="login-credentials">
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
        <form method="post" action="login-form.php" class="login-credentials">
            <input type="text" name="name"  placeholder="Your Name" required>
            <input type="password" name="password" id="name" placeholder="New Password" required>
            <br>
            <p class="policy">By clicking Sign Up,you agree to our Terms,Data Policy and Cookie Policy.</p>
            <input class="signUp" type="submit" name="submit" value="Sign Up">
             <?php
            if ($invalid!=false) :?>
                <div class="alert alert-danger result"><?php echo $invalid ?></div>
            <?php endif; ?> 
         </form>
     </div>
    </div>
</section>
<button class="accordion"><b>OFFICE LOCATIONS - INDIA,USA</b></button>
    <div class="panel">
        <div class="row">
            <div class="col span-1-of-3">
                <b>NOIDA(NORTH AMERICA)</b>
                <p>Mindfire Solutions
                    6th & 7th Floors, Assotech One
                    C-20/1/1A, Sector 62
                    Noida - 201309, India
                </p>
            </div>
            <div class="col span-1-of-3">
                <b>USA SALES OFFICE</b>
                <p>Mindfire LLC
                   1890 Crooks, Suite 340
                   Troy, MI - 48084
                   (phone) +1 248.740.0611
                   (fax)   +1 248.498.5957
                </p>
            </div>
            <div class="col span-1-of-3">
                <b>BHUBANESWAR(EAST AMERICA)</b>
                <p>Mindfire Solutions
                   10th Floor, DLF Cybercity,
                   Infocity Area,
                   Bhubaneswar - 751024, Odisha, India.
                </p>
            </div>
            
        </div>
    </div>
<button class="accordion"><b>CAREER OPPORTUNITIES (JOBS)</b></button>
    <div class="panel">
     <div class="row contact">
         <p>US East Coast:   +1 248.686.1424 <br>
            US West Coast: +1 415.226.6334 <br>
            (Email) sales@mindfiresolutions.com
      </p>
     </div>
    </div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
    }
</script>
</body>
</html>