<?php 
    class Movie {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get movie details
        public function getMovies(){
            $this->db->query('SELECT * FROM movies');
            $row = $this->db->resultSet();

            return $row;
        }
    }