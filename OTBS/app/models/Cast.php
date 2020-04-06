<?php 
    class Cast {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //function which gets the cast details for particular movie seleted
        public function getCastDescription($id){
            $this->db->query(' 
                                SELECT cast_name,cast_role,cast_image FROM cast AS c JOIN movies_has_casts AS mhc 
                                ON c.cast_id = mhc.cast_id WHERE movie_id = :id  ORDER by c.cast_role
                            ' );

            //Bind Values
            $this->db->bind(':id' , $id);

            //Single row result
            $rows = $this->db->resultSet();
            return $rows;

        }
    }