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

            // If there is any show then return show details else return false
            if($theaterDetails != false){
                //Extracting the movie dates and return dates in an sorted manner
                $uniqueDates = array();
                foreach($theaterDetails as $movie){
                    if(!array_key_exists($movie->dates,$uniqueDates)){
                        $uniqueDates[$movie->dates]=array($movie->dateMonth,$movie->days);
                    }
                }
                ksort($uniqueDates);

                $data=[
                    'theaterDetails' => $theaterDetails,
                    'uniqueDates' => $uniqueDates,
                    'movieDetails' => $movieDetails,
                    'castDetails' => $castDetails,
                ];
            } else {
                $data=[
                    'theaterDetails' => 'false',
                    'uniqueDates' => 'false',
                    'movieDetails' => $movieDetails,
                    'castDetails' => $castDetails,
                ];
            }
            $this->view('theaters/selectTheater' , $data);
        }
        
    }
    