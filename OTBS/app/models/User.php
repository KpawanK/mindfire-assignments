<?php 
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Register User
        public function register($data){
            $this->db->query('INSERT INTO users (user_name,user_email,user_password) VALUES (:name , :email , :password)');

            //Bind values
            $this->db->bind(':name' , $data['name']);
            $this->db->bind(':email' , $data['email']);
            $this->db->bind(':password' , $data['password']);

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
                return $row;
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