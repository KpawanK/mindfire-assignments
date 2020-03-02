<?php
    class Movies extends Controller{
        public function __construct(){
            $this->movieModel = $this->model('Movie');
        }
        
        public function index($id){
            $movieDetail = $this->movieModel->getMovieDescription($id);
            $data = [
                'movieDescription' => $movieDetail,
            ];
            $this->view('movies/index' , $data);   
        } 

        public function findMovie(){
            //Process the data
            $name = $_POST['search'];
            $movieDetail = $this->movieModel->getMovieDescriptionByName($name);
            if(!$movieDetail){
                 redirect('pages');
            } else {
                $data = [
                    'movieDescription' => $movieDetail,
                ];
                $this->view('movies/index' , $data);   
            }
        }
    }