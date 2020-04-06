<?php
    class Movies extends Controller{
        public function __construct(){
            $this->movieModel = $this->model('Movie');
            $this->castModel = $this->model('Cast');
        }
        
        //function to get the movie and cast details for the selected movie using movie id
        public function index($id){
            $movieDetail = $this->movieModel->getMovieDescription($id);
            $castDetail = $this->castModel->getCastDescription($id);
            $data = [
                'movieDescription' => $movieDetail,
                'castDescription' => $castDetail,
            ];
            $this->view('movies/index' , $data);   
        } 
    }