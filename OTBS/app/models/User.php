<?php 
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data,$randomText){
            $this->db->query('INSERT INTO users (user_name,user_email,user_password,otp_code) VALUES (:name , :email , :password , :otp)');

            //Bind values
            $this->db->bind(':name' , $data['name']);
            $this->db->bind(':email' , $data['email']);
            $this->db->bind(':password' , $data['password']);
            $this->db->bind(':otp' , $randomText);

            //Execute 
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        //Login User
        public function login($email,$password){
            $this->db->query('SELECT * FROM users WHERE user_email = :email');
            $this->db->bind(':email',$email);

            $row = $this->db->single();
            
            $hashed_password = $row->user_password;
            if(password_verify($password , $hashed_password)){
                if($row->user_status==1){
                    return $row;
                } else {
                    return 'otpNotVerified';
                }
            } else {
                return false;
            }
        }
        
        //Check the otp
        public function checkOTP($data){
            $this->db->query('SELECT otp_code FROM users WHERE user_email = :email');
            $this->db->bind(':email',$data['email']);

            $row = $this->db->single();
            
            $otp = $row->otp_code;
            if($otp == $data['otp']){
                return true;
            } else {
                return false;
            }
        }
      
        //Update the user status
        public function updateUserStatus($mail){
            $this->db->query('UPDATE users SET user_status = :status WHERE user_email = :email');
            
            //Bind
            $this->db->bind(':email',$mail);
            $this->db->bind(':status' , 1);

            //Execute 
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE user_email = :email');
            

            //Bind values
            $this->db->bind(':email' , $email);

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        //get all User details for admin to view
        public function getAllusers(){
            $this->db->query('SELECT user_id,user_name,user_email,
                              user_image,user_role FROM users');
            
            //Multi row result
            $rows = $this->db->resultSet();

            return $rows;
        }

        //Insert user detail into database for admin
        public function insertUserRecord($data){
            $this->db->query('INSERT INTO users(user_name,user_email,
                              user_password,user_image) 
                              VALUES (:username,:email,:password,:userImage)');
            
            //Bind Values
            $this->db->bind(':username',$data['username']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':password',$data['password']);
            $this->db->bind(':userImage',$data['userImage']);

            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }