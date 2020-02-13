<?php include_once "db.php" ?>
<?php
class Users extends db{    
    static $hashFormat = "$2y$10$" ,  $salt = "iusesomecrazystrings22";

    function __construct() {
        self::getInstance();
    }

    function validate_name($name){
        if(!preg_match("/^[a-zA-Z ]{3,}$/",$name))
            return false;
        return true;
    }
    
    function validate_password($password){
        if(!preg_match("/^[a-zA-Z0-9@_$]{7,}$/",$password))
            return false;
        return true;
    }
    
    function signUp( $name , $password ){
        $nameRes = $this->validate_name($name);
        $passwordRes = $this->validate_password($password);

        if(!$passwordRes || !$nameRes) {
            return "Invalid Credentials";
        }

        $hashF_and_salt = self::$hashFormat . self::$salt;
        $password = crypt($password,$hashF_and_salt);
        $name = "'".$name."'";
        $password = "'".$password."'";
        $parameter = [
        "user_name" => $name,
        "password" => $password,
        ];
        $columns = array("user_name","password");
        $result = $this->selectTable("users",$columns,$parameter);
        if($result->num_rows==0){
            $result = $this->insertRecord("users",$parameter );
            if(!$result){
                return "Sign Up Failed";
            } else {
                return "Sign Up successfull";
            }
        } else {
            return "Account Exists";
        }
    }
    
    function logIn(  $name , $password ){
        $nameRes = $this->validate_name($name);
        $passwordRes = $this->validate_password($password);
        if(!$passwordRes || !$nameRes) {
            return "Invalid Credentials";
        }
        $hashF_and_salt = self::$hashFormat . self::$salt;
        $password = crypt($password,$hashF_and_salt);
        $columns = array("id","user_name","password");
        $name = "'".$name."'";
        $password = "'".$password."'";
        $cond = array(
            "user_name" => $name,
            "password" => $password,
        );
        $result = $this->selectTable("users",$columns,$cond);
        if($result->num_rows==0){
            return "Invalid Credentials";
        }
        else{
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user_id"] = $row[id];
            return "success";
        }
    }
}


