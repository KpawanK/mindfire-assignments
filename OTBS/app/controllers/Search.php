<?php
    class Search extends Controller{
        public function __construct(){
            $this->movieModel = $this->model('Movie');
        }
        
        public function index(){
            $data=[];
            $this->view('search/index' , $data);   
        } 
    }