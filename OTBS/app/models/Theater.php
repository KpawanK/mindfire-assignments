<?php 
    class Theater {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get Theater details
        public function selectTheater($id){
                $this->db->query('  SELECT movies.movie_id,movies.movie_name,hall.hall_id,hall.hall_name,movie_timings.movie_date_time 
                                    AS date_time ,TIME_FORMAT(time(movie_timings.movie_date_time),"%h:%i %p") AS timings FROM movie_timings
                                    JOIN halls_has_movies ON movie_timings.hall_movie_id = halls_has_movies.id
                                    JOIN hall ON hall.hall_id = halls_has_movies.hall_id
                                    JOIN movies ON movies.movie_id = halls_has_movies.movie_id
                                    HAVING movies.movie_id = :id AND DATE(movie_timings.movie_date_time) = "2020-02-17"
                                    ORDER BY movies.movie_name , hall.hall_name , movie_timings.movie_date_time ;
                            ');

            //Bind Values
            $this->db->bind(':id' , $id);
            
            //Multiple row result set
            $results = $this->db->resultSet();
            return $results;

        }
        
        //get Seats Info using hall id
        public function seatsInfo($id){
            $this->db->query(' SELECT hall_no_rows , hall_no_cols FROM hall WHERE hall_id = :id');

            //Bind Values
            $this->db->bind(':id' , $id);

            //Single row result
            $row = $this->db->single();
            return $row;

        }
    }