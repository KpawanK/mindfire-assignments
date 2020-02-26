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

        //get Movie description by ID
        public function getMovieDescription($id){
            $this->db->query('SELECT * FROM movies WHERE movie_id = :id ');

            //Bind Values
            $this->db->bind(':id' , $id);

            //Single row result
            $row = $this->db->single();

            return $row;

        }

        //get Movie description by name
        public function getMovieDescriptionByName($name){
            $this->db->query('SELECT * FROM movies WHERE movie_name = :name ');

            //Bind Values
            $this->db->bind(':name' , $name);

            //Single row result
            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() >0){
                return $row;
            } else {
                return false;
            }

        }

        //get Hall names and their description
        public function selectHall($id){
            $this->db->query('SELECT * FROM hall WHERE hall_id IN (
                                SELECT hall_id FROM halls_has_movies INNER JOIN movies USING(movie_id) 
                                WHERE movie_id =  :id )'
                            );
            //Bind Values
            $this->db->bind(':id' , $id);

            //Multiple row result
            $results = $this->db->resultSet();
    
            return $results;

        }
    }