<?php
    class Admins extends Controller{
        public function __construct(){
            $this->movieModel = $this->model('Movie');
            $this->theaterModel = $this->model('Theater');
            $this->userModel = $this->model('User');
        }
        
        public function index(){
            $data=[];
            $this->view('admins/index' , $data);   
        } 

    // Function to handle all the requests of admin to MOVIES TAB
        public function movies($param){
            $output = '';
            if($param == "view"){
                $output .= "<table class='table table-bordered table-hover mr-3'>
                            <thead> 
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                $movieDetail = $this->movieModel->getAllMovies();
                foreach($movieDetail as $movie){
                    $output .= "<tr>
                                    <td>".$movie->movie_id."</td>
                                    <td>".$movie->movie_name."</td>
                                    <td>".$movie->movie_date."</td>
                                    <td>".$movie->movie_time."</td>
                                    <td><img height='180' width='150' src='".URLROOT."/img/".$movie->movie_image."'></td>
                                    <td>".$movie->movie_content."</td>
                                    <td>".$movie->movie_tags."</td>
                                    <td>".$movie->movie_status."</td>
                                    <td><a href='".URLROOT."/admins/movies/delete/".$movie->movie_id."'><span class='btn fa fa-trash text-danger'></span></a>
                                    </td>
                                </tr>    
                                ";
                }
                $output .= " </tbody>
                            </table>
                            ";
                echo $output;
            } else if($param == "add"){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $data=$_POST;
                    $insertStatus=$this->movieModel->insertMovieRecord($data);
                    if($insertStatus){
                        flash('movie_record_inserted_success','Successfully inserted the movie details into database');
                        echo $insertStatus;
                    } else{
                        echo 'Failed to entry the movie details'   ;
                    }
                }
            } else if($param == "delete"){
                echo($param);
            }
        }
        
        // Function to handle all the requests of admin to halls tab
        public function halls($param){
            $output = '';
            if($param == "view"){
                $output .= "<table class='table table-bordered table-hover mr-3'>
                            <thead> 
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>No-Of-Seats</th>
                                    <th>No-Of-Rows</th>
                                    <th>No-Of-Columns</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                $theaterDetail = $this->theaterModel->getAllTheaters();
                foreach($theaterDetail as $theater){
                    $output .= "<tr>
                                    <td>".$theater->hall_id."</td>
                                    <td>".$theater->hall_name."</td>
                                    <td>".$theater->hall_seats."</td>
                                    <td>".$theater->hall_no_rows."</td>
                                    <td>".$theater->hall_no_cols."</td>
                                    <td><span class='btn fa fa-trash text-danger'></span></td>
                                </tr>    
                                ";
                }
                $output .= " </tbody>
                            </table>
                            ";
                echo $output;
            } else if($param == "add"){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $data=$_POST;
                    $insertStatus=$this->theaterModel->insertHallRecord($data);
                    if($insertStatus){
                        flash('hall_record_inserted_success','Successfully inserted the hall details into database');
                        echo $insertStatus;
                    } else{
                        echo 'Failed to entry the hall details'   ;
                    }
                }        
            } else{

            }
        }

        // Function to handle all the requests of admin to timeSlots tab
        public function timeSlots($param){
            $output = '';
            if($param == "view"){
                $output .= "<table class='table table-bordered table-hover mr-3'>
                            <thead> 
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                // $userDetail = $this->userModel->getAllUsers();
                // foreach($userDetail as $user){
                //     $output .= "<tr>
                //                     <td>".$user->user_id."</td>
                //                     <td>".$user->user_name."</td>
                //                     <td>".$user->user_email."</td>
                //                     <td>".$user->user_image."</td>
                //                 </tr>    
                //                 ";
                // }
                $output .= " </tbody>
                            </table>
                            ";
                echo $output;
            } else if($param == "add"){
                echo "Not Yet Written the code for this";
            } else{

            }
        }

        // Function to handle all the requests of admin to users tab
        public function users($param){
            $output = '';
            if($param == "view"){
                $output .= "<table class='table table-bordered table-hover mr-3'>
                            <thead> 
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                $userDetail = $this->userModel->getAllUsers();
                foreach($userDetail as $user){
                    $output .= "<tr>
                                    <td>".$user->user_id."</td>
                                    <td>".$user->user_name."</td>
                                    <td>".$user->user_email."</td>
                                    <td><img height='100' width='100' src='".URLROOT."/img/users/".$user->user_image."'></td>
                                    <td><span class='btn fa fa-trash text-danger'></span></td>
                                </tr>    
                                ";
                }
                $output .= " </tbody>
                            </table>
                            ";
                echo $output;
            } else if($param == "add"){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $data=$_POST;
                    $insertStatus=$this->userModel->insertUserRecord($data);
                    if($insertStatus){
                        flash('movie_record_inserted_success','Successfully inserted the user details into database');
                        echo $insertStatus;
                    } else{
                        echo 'Failed to entry the user details'   ;
                    }
                }
            } else{

            }
        }
    }





    
            