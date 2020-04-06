<?php 
    class Seat {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get all carousel images
        public function bookSeats($hall_movie_time_id,$user_id,$ticket_id){
            $this->db->query('INSERT INTO seats (hall_movie_time_id,user_id,ticket_id) VALUES (:hall_movie_time_id,:user_id,:ticket_id)');

            //Bind values
            $this->db->bind(':hall_movie_time_id' , $hall_movie_time_id);
            $this->db->bind(':user_id' , $user_id);
            $this->db->bind(':ticket_id',$ticket_id);
            
            //Execute 
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        //get all booked seats detail
        public function seatsBookedInfo($movieTimeId){
            $this->db->query('SELECT ticket_id FROM seats WHERE hall_movie_time_id = :movieTimeId');

            //Bind values
            $this->db->bind(':movieTimeId' , $movieTimeId);
            
            //Single row result
            $rows = $this->db->resultSet();
            return $rows;
        }
    }