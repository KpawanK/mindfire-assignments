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
            $this->db->query(' SELECT movies.movie_id , movies.movie_name , hall.hall_name , GROUP_CONCAT(time_format(
                                movie_timings.movie_time , "%h:%i %p") SEPARATOR ",")
                                AS timings FROM movie_timings JOIN halls_has_movies ON movie_timings.hall_movie_id = halls_has_movies.id
                                JOIN hall ON hall.hall_id = halls_has_movies.hall_id
                                JOIN movies ON movies.movie_id = halls_has_movies.movie_id 
                                GROUP BY movies.movie_name , hall.hall_name HAVING movies.movie_id = :id
                            ');

            //Bind Values
            $this->db->bind(':id' , $id);
            
            //Multiple row result
            $results = $this->db->resultSet();
            return $results;

        }
    }