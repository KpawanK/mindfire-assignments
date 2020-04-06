<?php 
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }
        
        //function to handle register user
        public function register(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                //Process the form

                //Sanitize the POST data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data
                $data=[
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                //Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                } else {
                    $regexEmail ='/[a-zA-Z]{3,}[a-zA-Z0-9]*@[a-zA-Z]{5,}\.[a-zA-Z]{2,}/';
                    //Check valid mail syntax or not
                    if(!preg_match($regexEmail,$data['email'])){
                        $data['email_err'] = 'Email is not proper!';
                    }
                    //Check email
                    else if ($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                //Validate name
                 if(empty($data['name'])){
                    $data['name_err'] = 'Please enter name';
                } else{
                    $regexName = '/^[a-zA-Z ]*$/'; 
                    if(!preg_match($regexName,$data['name'])) { 
                        $data['name_err'] = 'Name can have only letters and spaces';
                    } 
                }

                //Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                } elseif(strlen($data['password'])<6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                //Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                } else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Password do not match';
                    }
                }

                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err'])  && empty($data['confirm_password_err'])){
                    //Validated
                    //Hash password
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    //Generate a random String as an OTP
                    $randomText=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 5);
                    //Register User
                    if($this->userModel->register($data,$randomText)){
                        
                        //Send mail to the registered mail id
                        $subject ='OTP for account verification by OTBS';
                        $body = 'Here is the OTP for your account verification. OTP is : '.$randomText;
                        $to = $data['email'];
                        $result = send_mail($subject,$body,$to,false);
                        //Display the flash message and redirect to the otp verification page
                        flash('register_success','Enter OTP sent to your registered mail to verify your account');
                        redirect('users/otpVerify/'.$data['email']);
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //Load view with errors
                    $this->view('users/register',$data);    
                }

            } else{
                //init data
                $data=[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //Load view
                $this->view('users/register',$data);
            }
        }

        // Function to handle otp verify  section
        public function otpVerify($mail){
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Process the form

                //Sanitize the POST data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data
                $data=[
                    'otp' => trim($_POST['otp']),
                    'email' => $mail,
                    'otp_err' => '',  
                ];

                //Validate otp
                if(empty($data['otp'])){
                    $data['otp_err'] = 'Please enter email';
                } else if(!$this->userModel->checkOTP($data)){
                    $data['otp_err'] = 'Enter the correct OTP';
                }

                //Make sure errors are empty
                if(empty($data['otp_err'])){
                    //Validated
                    //Update user status
                    $statusResult = $this->userModel->updateUserStatus($mail);
                    if($statusResult){
                        flash('otp_success','Registered Successfully and can now login');
                        //redirect('users/login');
                        redirect('users/login');
                    } else {
                        die('Something wrong happened');
                    }
                } else {
                    //Load view with errors
                    $this->view('users/otpVerify',$data);
                }

            } else{
                //init data
                $data=[
                    'otp' => '',
                    'email' => $mail,
                    'otp_err' => '', 
                ];

                //Load view
                $this->view('users/otpVerify',$data);
            }
        }

        // Function to handle login section
        public function login(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Process the form

                //Sanitize the POST data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data
                $data=[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',  
                ];

                //Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }

                //Validate Password
                 if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                } 

                //Check for user/email
                if($this->userModel->findUserByEmail($data['email'])){
                    //User found

                } else {
                    //User not found
                    $data['email_err'] = "No user found";
                }

                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    //Validated
                    //Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                    if($loggedInUser->user_status == "1"){
                        //Create Session 
                        $this->createUserSession($loggedInUser);
                    }else if($loggedInUser=='otpNotVerified'){
                        //flash message that accoubt not verified and redirect to the login page
                        flash('login_status','Please verify your account');
                        redirect('users/login');
                    } else {
                        $data['password_err'] = 'Password Incorrect';
                        $this->view('users/login',$data);
                    }
                } else {
                    //Load view with errors
                    $this->view('users/login',$data);
                }

            } else{
                //init data
                $data=[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //Load view
                $this->view('users/login',$data);
            }
        }

        //function which creates session for the logged in user
        public function createUserSession($user){   
            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_email'] = $user->user_email;
            $_SESSION['user_name'] = $user->user_name;
            $_SESSION['user_role'] = $user->user_role;
            redirect('pages/index');
        }   

        //function to logout the user , unset and destroy the session variables
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            session_destroy();
            redirect('pages/index');
        }

        
    }