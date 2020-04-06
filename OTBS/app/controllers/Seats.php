<?php
    class Seats extends Controller{
        public function __construct(){
            $this->theaterModel = $this->model('Theater');
            $this->seatModel = $this->model('Seat');
        }

        public function index(){
            
        }

        //function to get the available and booked seats info for particular show of the movie hall selected
        public function selectSeats($id){
            $seatDetails = $this->theaterModel->seatsInfo($id);
            $seatBooked = $this->seatModel->seatsBookedInfo($_COOKIE['movie_timing_id']);
            $seatsBooked = array();
            foreach($seatBooked as $seat){
                array_push($seatsBooked,$seat->ticket_id);
            }
            $data=[
                'seatInfo' => $seatDetails,
                'bookedSeatsInfo' => $seatsBooked,
            ];
            $this->view('seats/selectSeats' , $data);
        }

    }