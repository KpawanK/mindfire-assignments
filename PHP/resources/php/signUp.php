<?php  include "../../includes/db.php"; ?>
<?php  include "functions.php"; ?>
<?php  include "userValidation.php"; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $nameRes=validate_name($name);
    $passwordRes=validate_password($password);
    if( !$nameRes) {
        header("location:login-form.php?msg=nameFailure");
        exit();
    } else if(!$passwordRes) {
        header("location:login-form.php?msg=passwordFailure");
        exit();
    } else if(!$nameRes && !$passwordRes) {
        header("location:login-form.php?msg=bothFailure");
        exit();
    }
    include "../../includes/db.php";
    global $connection;
    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hashFormat . $salt;
    $password = crypt($password,$hashF_and_salt);       
    $param = [
       "user_name" => $name,
       "password" => $password,
    ];
    $columns = array("user_name","password");
    $result = selectTable("MyUsers",$columns,$param);
    if(!$result->num_rows){
        $result = insertRecord("MyUsers",$param );
        if($result)
         header("location:login-form.php?msg=success");
        else
        header("location:login-form.php?msg=failure");
    }
    else
        header("location:login-form.php?msg=account_exists");  
    mysqli_close($connection);
}
?>

