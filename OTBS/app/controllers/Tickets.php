<?php
    class Tickets extends Controller{
        public function __construct(){
            
        }
        public function index(){
            redirect('pages');  
        }
        
        //landing page for the ticket summary page
        public function ticketSummary(){
            $data=[
                
            ];
            $this->view('tickets/ticketSummary' , $data);
        }
    }