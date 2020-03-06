<?php
    class Tickets extends Controller{
        public function __construct(){
            
        }
        public function index(){

        }
        public function ticketSummary(){
            $data=[
                
            ];
            $this->view('tickets/ticketSummary' , $data);
        }
    }