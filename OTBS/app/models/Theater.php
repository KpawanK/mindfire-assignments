<?php 
    class Theater {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get Theater details
        public function selectTheater($id){
            $this->db->query('  SELECT movies.movie_id,movies.movie_name,hall.hall_name,movie_timings.movie_date_time AS date_time ,
                                TIME_FORMAT(time(movie_timings.movie_date_time),"%h:%i %p") AS timings FROM movie_timings
                                JOIN halls_has_movies ON movie_timings.hall_movie_id = halls_has_movies.id
                                JOIN hall ON hall.hall_id = halls_has_movies.hall_id
                                JOIN movies ON movies.movie_id = halls_has_movies.movie_id
                                HAVING movies.movie_id = 4 AND DATE(movie_timings.movie_date_time) = "2020-02-17"
                                ORDER BY movies.movie_name , hall.hall_name , movie_timings.movie_date_time ;
                            ');

            //Bind Values
            $this->db->bind(':id' , $id);
            
            //Multiple row result
            $results = $this->db->resultSet();
            return $results;

        }
    }