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
    }