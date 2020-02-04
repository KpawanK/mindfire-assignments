<?php  session_start(); ?>
<?php  include "../../includes/db.php"; ?>
<?php include "functions.php" ?>

<!------------------------------LOGIN VALIDATION --------------------------------->
<?php 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password,$hashF_and_salt);
        $columns = array("id","user_name","password");
        $name = "'".$name."'";
        $password = "'".$password."'";
        $cond = array(
            "user_name" => $name,
            "password" => $password,
        );
        $result = selectTable("MyUsers",$columns,$cond);
        if(!$result->num_rows)
            die("Query failed".mysqli_error($connection));   
        $row = mysqli_fetch_assoc($result);
        if($row){
            $_SESSION["user_id"] = $row[id];
            $_SESSION["user_name"] = $row[user_name];
            header("location:login-body.php");
        }
        else
            header("location:login-form.php?msg=Invalid Credentials");
        mysqli_close($connection);
    }
?>