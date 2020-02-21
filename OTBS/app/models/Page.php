<?php 
    class Page {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Find 3 recent movies
        public function findThreeMovies(){
            $this->db->query('SELECT * FROM movies');
            $row = $this->db->resultSet();

            return $row;
        }
    }