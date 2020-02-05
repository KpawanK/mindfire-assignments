<?php session_start() ;?>
<?php 
    // Check user login or not
    if(!isset($_SESSION[user_id])){
        header('Location: login-form.php');
    }
?>
<?php include "../../includes/header.php"?>
<section class="section-features">
    <h1>Welcome <?php echo $_SESSION["user_name"];?></h1>
</section>
<?php include "../../includes/footer.php"?>