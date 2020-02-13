<?php session_start() ;?>
<?php 
    // Check user login or not
    if(!isset($_SESSION[user_id])){
        header('Location: login-form.php');
    }
?>
<?php include "users.php";?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        $newUser = new Users;
        $cond = array(
            "id" => $_SESSION["user_id"]
        );
        $col_name = array("user_name");
        $result = $newUser->selectTable("users" , $col_name , $cond);
        $row = mysqli_fetch_assoc($result);
    }
?>
<?php include "../../includes/header.php"?>
<section class="section-features">
    <h1>Welcome <?php echo $row["user_name"];?></h1>
</section>
<?php include "../../includes/footer.php"?>