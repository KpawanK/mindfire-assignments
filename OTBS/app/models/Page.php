<?php 
    class Page {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get all carousel images
        public function getCarousel(){
            $this->db->query('SELECT carousel_image FROM carousel');
            $row = $this->db->resultSet();

            return $row;
        }
    }