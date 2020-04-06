<?php
    class Pages extends Controller{
        public function __construct(){
            $this->pageModel = $this->model('Page');
            $this->movieModel = $this->model('Movie');
        }

        //function to get the carousel images and all movie details for the landing page of the site
        public function index(){
            $carousels = $this->pageModel->getCarousel();
            $movies = $this->movieModel->getMovies();
            $data = [
                'carousels' => $carousels,
                'movies' => $movies,
            ];
            $this->view('pages/index' , $data);   
        }
        
    }