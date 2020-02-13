<?php session_start() ;?>
<?php 
class db 
{ 
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "Mfsi@6500";
    private $dbName = "loginPhp";
    public  static $connection;
    private static $instance=null;
    
    private function __construct() {    
        self::$connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass,$this->dbName)
            or die("Could not connect to the database:<br />" . mysql_error());
    }
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
    public  function insertRecord($tbName , $param ){
        $column = array_keys( $param );
        $column = implode ( ",", $column );
        $value = array_values( $param );
        $value = implode ( ",", $value );
        $query = " INSERT INTO $tbName ($column) VALUES($value) ";
        $res = mysqli_query(self::$connection,$query); 
        return $res;
    }
    
    public  function insertMultipleValues($tbName , $colName,$multipleValues ){
        $column = array_values( $colName);
        $column = implode ( ",", $column );
        $query = " INSERT INTO $tbName ($column) VALUES $multipleValues ";
        $res = mysqli_query(self::$connection,$query); 
        return $res;
    }
    
    public  function updateTable($tbName , $set_command , $cond){
        $column = array_keys($set_command );
        $value = array_values($set_command );
        $set = " $column[0]=$value[0] ";
        for($i=1;$i<count($value);$i++){
            $set .= " , $column[$i] = $value[$i] ";
        }
        $key = array_keys($cond );
        $value = array_values($cond );
        $param = " $key[0] = $value[0] ";
        for($i=1;$i<count($value);$i++){
            $param .= " AND $key[$i] = $[$i] ";
        }
        $query = " UPDATE $tbName SET $set WHERE $param ";
        $res = mysqli_query(self::$connection,$query);
        return $res;
    }
    
    public  function selectTable($tbName , $select_columns , $cond){
        $column = implode ( ",", $select_columns );
        $key = array_keys($cond );
        $value = array_values($cond );
        $param = "";
        $param = " $key[0] = $value[0]";
        for($i=1;$i<count($value);$i++){
            $param .=  "AND $key[$i] = $value[$i]";
        }
        $query = " SELECT  $column FROM $tbName WHERE $param ";
        $res = mysqli_query(self::$connection,$query);
        return $res;
    }
    
    public  function deleteRecord($tbName , $cond){
        $key = array_keys($cond );
        $value = array_values($cond );
        $param = " $key[0] = $value[0] ";
        for($i=1;$i<count($value);$i++){
            $param .= " AND $key[$i] = $value[$i] ";
        }
        $query = " DELETE FROM $tbName WHERE $param ";
        $res = mysqli_query(self::$connection,$query); 
        return $res;
    }   
} 