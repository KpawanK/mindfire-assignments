<?php
    class Theaters extends Controller{
        public function __construct(){
            $this->theaterModel = $this->model('Theater');
            $this->movieModel = $this->model('Movie');
            $this->castModel = $this->model('Cast');
        }
        
        //get the movie dates on which the movie will be present
        public function selectTheater($id){
            $theaterDetails = $this->theaterModel->selectTheater($id);
            $movieDetails = $this->movieModel->getMovieDescription($id);
            $castDetails = $this->castModel->getCastDescription($id);

            // If there is any show then return show details else return false
            if($theaterDetails != false){
                //Extracting the movie dates and return dates in an sorted manner
                $uniqueDates = array();
                foreach($theaterDetails as $movie){
                    if(!array_key_exists($movie->CD,$uniqueDates)){
                        $uniqueDates[$movie->CD]=array($movie->D,$movie->days);
                    }
                }
                ksort($uniqueDates);

                $data=[
                    'uniqueDates' => $uniqueDates,
                    'movieDetails' => $movieDetails,
                    'castDetails' => $castDetails,
                ];
            } else {
                $data=[
                    'uniqueDates' => 'false',
                    'movieDetails' => $movieDetails,
                    'castDetails' => $castDetails,
                ];
            }
            $this->view('theaters/selectTheater' , $data);
        }

        //get the movie show timings for the selected date using ajax
        public function selectTimings(){
            $output='';
            $theaterDetails = $this->theaterModel->selectTimings($_POST['movieId'],$_POST['date']);
            
            // PROCESSING THE HALL DETIALS TO MAKE TIMINGS GROUP TO THEIR HALL NAME
            $theaterNames=[];
            foreach($theaterDetails as $theater){
                if(!in_array($theater->hall_name,$theaterNames)){
                    $theaterNames[$theater->hall_name]=[];
                    $theaterNames[$theater->hall_name]=array( 
                        'movie_id' => $theater->movie_id,
                        'hall_id' => $theater->hall_id,
                        'timing' => array(),
                    );
                }
            }
            foreach($theaterDetails as $theater){
                array_push($theaterNames[$theater->hall_name]['timing'],$theater->timings);
            }
            foreach($theaterNames as $key=>$value){
                $output .= '<div class="row">';
                    $output .= '<div class="col-4 pt-3">';
                        $output .= '<a href="#" class="text-dark ml-5"><strong>'.$key.'</strong></a>
                    </div>
                    <div class="col-8 pt-4">
                        <ul class="list-unstyled list-inline" id="movie-time"> ';
                            foreach($value['timing'] as $temp){
                                $output.= '<li class="list-inline-item">
                                    <button class="btn btn-light text-success m-1" data-toggle="modal" data-target="#notes" data-movie-id ="'.$value['movie_id'].'" data-hall-id="'.$value['hall_id'].'">'.
                                        $temp. 
                                    '</button>
                                </li>';
                            }
                        $output .= '</ul>
                    </div>
                </div>
                <hr>';
            }
            echo $output;
        }
        
    }
    