<?php
    class Pages extends Controller{
        public function __construct(){
            $this->pageModel = $this->model('Page');
        }

        public function index(){
            $movies = $this->pageModel->findThreeMovies();
            $data = [
                'movies' => $movies
            ];
            $this->view('pages/index' , $data);
        }
        
    }