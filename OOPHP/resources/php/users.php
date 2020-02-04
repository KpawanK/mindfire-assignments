<?php include_once "db.php" ?>
<?php session_start (); ?>
<?php
class Users extends db{    
    function test_input( $data ) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    function __construct() {
        self::getInstance();
    }

    function validate_name($name){
    $temp = $this->test_input($name);
    if(!preg_match("/^[a-zA-Z ]*$/",$temp))
        return "Name can have only spaces";
    return true;
    }
    
    function validate_password($password){
    if(strlen($password)<7)
        return "Password Length should be greater than or equal to 7";
    return true;
    }
    
    function validate_email($email){
    $temp = $this->test_input($email);
    if(!filter_var($temp, FILTER_VALIDATE_EMAIL))
        return "Invalid email format";
    return true;
    }
    
    function validate_number($number){
    if(!preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/',$number))
        return "Invalid Number";
    return true;
    }
    
    function validate_age($age){
    $temp=$age;
    if($temp>=20 && $temp<=30)
        return true;
    return "Age should be in between 20 and 30";
    }
    
    function signUp( $post_data ){
        
        $name = $post_data['name'];
        $password = $post_data['password'];
        $nameRes = $this->validate_name($name);
        $passwordRes = $this->validate_password($password);
       
        if($nameRes!="true" && $passwordRes!="true")
            return "Invalid username and password";
            
        else if($nameRes && $passwordRes!="true")
            return "Invalid password";
        else if($nameRes!="true" && $passwordRes)
            return "Invalid username";
        
        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password,$hashF_and_salt);
        $name = "'".$name."'";
        $password = "'".$password."'";
        $parameter = [
        "user_name" => $name,
        "password" => $password,
        ];
        $columns = array("user_name","password");
        $result = $this->selectTable("MyUsers",$columns,$parameter);
        if($result->num_rows==0){
            $result = $this->insertRecord("MyUsers",$parameter );
            if(!$result)
                return "Sign Up Failed";
             else
                 return "Sign Up successfull";
        }else
            return "Account Exists";
    }
    
    function logIn( $post_data ){
        $name = $post_data['name'];
        $password = $post_data['password'];
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
        $result = $this->selectTable("MyUsers",$columns,$cond);
        if($result->num_rows==0){
            return "Invalid Credentials";
        }
        else{
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user_id"] = $row[id];
            $_SESSION["user_name"] = $row[user_name];
            header("location:login-body.php");
        }
    }
}


