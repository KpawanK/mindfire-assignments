<?php session_start() ;?>

<?php include "../../includes/header.php"?>
<section class="section-features">
    <h1>Welcome <?php echo $_SESSION["user_name"];?></h1>
</section>
<?php include "../../includes/footer.php"?>