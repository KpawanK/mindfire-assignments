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

        //get Movie description having name for search bar
        public function searchMovieHaving($name){
            $this->db->query('SELECT * FROM movies WHERE movie_name LIKE :name');

            //Bind Values
            $name = "%$name%";
            $this->db->bind(':name' , $name);

            //Multi row result
            $rows = $this->db->resultSet();

            //Check row
            if($this->db->rowCount() >0){
                return $rows;
            } else {
                return false;
            }
        }

        //get all Movie details for admin to view
        public function getAllMovies(){
            $this->db->query('SELECT movie_id,movie_name,movie_date,
                              movie_time,movie_image,movie_content,movie_tags,movie_status FROM movies');
            
            //Multi row result
            $rows = $this->db->resultSet();

            return $rows;
        }

        //Insert movie detail into database for admin
        public function insertMovieRecord($data){
            $this->db->query('INSERT INTO movies(movie_name,movie_date, 
                              movie_time,movie_image,movie_content,
                              movie_tags,movie_status)
                              VALUES (:movieName,:releaseDate,:duration,:movieImage,:content,:tags,:status)');
            
            //Bind Values
            $this->db->bind(':movieName',$data['movieName']);
            $this->db->bind(':releaseDate',$data['releaseDate']);
            $this->db->bind(':duration',$data['duration']);
            $this->db->bind(':movieImage',$data['movieImage']);
            $this->db->bind(':content',$data['content']);
            $this->db->bind(':tags',$data['tags']);
            $this->db->bind(':status',$data['status']);

            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }