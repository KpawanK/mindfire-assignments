<?php 
    class Theater {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get Theater details
        public function selectTheater($id){
                $this->db->query('  SELECT movies.movie_id,movies.movie_name,hall.hall_id,hall.hall_name,movie_timings.movie_date_time 
                                    AS date_time ,TIME_FORMAT(time(movie_timings.movie_date_time),"%h:%i %p") AS timings ,
                                    DATE_FORMAT(movie_timings.movie_date_time,"%Y-%m-%d") AS dates,
                                    DATE_FORMAT(movie_timings.movie_date_time,"%d %b") AS dateMonth,
                                    DATE_FORMAT(movie_timings.movie_date_time,"%a") AS days FROM movie_timings
                                    JOIN halls_has_movies ON movie_timings.hall_movie_id = halls_has_movies.id
                                    JOIN hall ON hall.hall_id = halls_has_movies.hall_id
                                    JOIN movies ON movies.movie_id = halls_has_movies.movie_id
                                    HAVING movies.movie_id = 4 AND DATE(movie_timings.movie_date_time) >= "2020-02-17 00:00:00"
                                    ORDER BY movies.movie_name , hall.hall_name , movie_timings.movie_date_time ;
                            ');

            //Bind Values
            $this->db->bind(':id' , $id);
            
            //Multiple row result set
            $results = $this->db->resultSet();
        
            if($this->db->rowCount()>0)
                return $results;
            else 
                return false;

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

        //get all Movie details for admin to view
        public function getAllTheaters(){
            $this->db->query('SELECT hall_id,hall_name,hall_seats,
                              hall_no_rows,hall_no_cols FROM hall');
            
            //Multi row result
            $rows = $this->db->resultSet();

            return $rows;
        }

        //Insert hall detail into database for admin
        public function insertHallRecord($data){
            $this->db->query('INSERT INTO hall(hall_name,hall_seats,hall_no_rows,hall_no_cols) 
                              VALUES (:hallName,:noOfSeats,:noOfRows,:noOfCols)');
            
            //Bind Values
            $this->db->bind(':hallName',$data['hallName']);
            $this->db->bind(':noOfSeats',$data['noOfSeats']);
            $this->db->bind(':noOfRows',$data['noOfRows']);
            $this->db->bind(':noOfCols',$data['noOfCols']);

            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }