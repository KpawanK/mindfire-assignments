<?php
    class Theaters extends Controller{
        public function __construct(){
            $this->theaterModel = $this->model('Theater');
            $this->movieModel = $this->model('Movie');
            $this->castModel = $this->model('Cast');
        }
        
        public function selectTheater($id){
            $theaterDetails = $this->theaterModel->selectTheater($id);
            $movieDetails = $this->movieModel->getMovieDescription($id);
            $castDetails = $this->castModel->getCastDescription($id);
            $data=[
                'theaterDetails' => $theaterDetails,
                'movieDetails' => $movieDetails,
                'castDetails' => $castDetails,
            ];
            $this->view('theaters/selectTheater' , $data);
        }
        
    }