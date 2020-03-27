<?php
    class Searchs extends Controller{
        public function __construct(){
            $this->movieModel = $this->model('Movie');
        }
        
        public function index(){
            $data=[];
            $this->view('searchs/index' , $data);   
        } 

        public function searchMovie(){
            //Process the data
            $name = $_POST['search'];
            $searchDetail = $this->movieModel->searchMovieHaving($name);
            $output = '';
            if($searchDetail!=false){
                $output .='<h4 class="text-center">Search Result</h4>';
                $output .='<ul class="list-group text-center mx-auto" style="width:60%;">';
                foreach($searchDetail as $movie){
                    $output .= '
                        <li class="list-group-item">
                            <a href="'.URLROOT.'/movies/index/'.$movie->movie_id.'" style="text-decoration:none">'.$movie->movie_name.'</a>              
                        </li>
                    ';
                }
                $output .= '</ul>';
                echo $output;
            }
            else{
                $output .='<h4 class="text-center"><strong>Data Not Found!</strong></h4>';
                echo $output;
            }
            
        }
    }
    