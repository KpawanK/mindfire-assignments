<?php
    class Seats extends Controller{
        public function __construct(){
            $this->theaterModel = $this->model('Theater');
        }
        public function index(){

        }
        public function selectSeats($id){
            $seatDetails = $this->theaterModel->seatsInfo($id);
            $data=[
                'seatInfo' => $seatDetails,
            ];
            $this->view('seats/selectSeats' , $data);
        }
    }