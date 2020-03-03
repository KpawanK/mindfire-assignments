<?php
    class Theaters extends Controller{
        public function __construct(){
            $this->theaterModel = $this->model('Theater');
            $this->movieModel = $this->model('Movie');
        }
        
        public function selectTheater($id){
            $theaterDetails = $this->theaterModel->selectTheater($id);
            $movieDetails = $this->movieModel->getMovieDescription($id);
            $data=[
                'theaterDetails' => $theaterDetails,
                'movieDetails' => $movieDetails,
            ];
            $this->view('theaters/selectTheater' , $data);
        }
        
    }