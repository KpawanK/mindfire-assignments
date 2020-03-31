<?php
    class Payments extends Controller{
        public function __construct(){
            
        }
        
        public function index($id){
            $data = [
            ];
            $this->view('payments/index' , $data);   
        } 
    }