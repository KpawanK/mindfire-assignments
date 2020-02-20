<?php
    /* 
     * Base Controller
     * Loads the model and views
     */
    class Controller{
        //Load model
        public function model($model){
            //Require model file
            require_once '../app/models/' . $model . '.php';

            //Instantiate mode
            return new $model;
        }

        //Load view
        public function view($view , $data = []){
            //Check for view
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                //View doesnt exist
                die('View does not exist');
            }
        }
    }