<?php include "../../includes/db.php" ?>
<?php
    

    
// ---------------------------- CRUD OPERATION -------------------------------//
    
function insertRecord($tbName , $param ){
    global $connection;
    $column = array_keys( $param );
    $column = implode ( ",", $column );
    $values = array_values( $param );
    $values= "'" . implode ( "','", $values ) . "'";
    $query = " INSERT INTO $tbName ($column) VALUES($values) ";
    $result = mysqli_query($connection,$query); 
    return $result;
}


function updateTable($tbName , $set_command , $cond){
    global $connection;
    $column = array_keys($set_command );
    $values = array_values($set_command );
    $set = " $column[0]=$values[0] ";
    for($i=1;$i<count($values);$i++)
        $set .= " , $column[$i] = $values[$i] ";
    
    $key = array_keys($cond );
    $value = array_values($cond );
    $param = " $key[0] = $value[0] ";
    for($i=1;$i<count($value);$i++)
        $param .= " AND $key[$i] = $value[$i] ";
    $query = " UPDATE $tbName SET $set WHERE $param ";

    $result = mysqli_query($connection,$query); 
    return $result;
}

function selectTable($tbName , $select_columns , $cond){
    global $connection;
    $column = implode ( ",", $select_columns );
    $key = array_keys($cond );
    $value = array_values($cond );
    $param = "$key[0] = $value[0] ";
    for($i=1;$i<count($value);$i++)
        $param .= " AND $key[$i]=$value[$i]";
    $query = " SELECT $column FROM $tbName WHERE $param ";
    $result = mysqli_query($connection,$query); 
    return $result;
}

function deleteRecord($tbName , $cond){
    global $connection;
    $key = array_keys($cond );
    $value = array_values($cond );
    $param = " $key[0] = $value[0] ";
    for($i=1;$i<count($value);$i++)
        $param .= " AND $key[$i] = $value[$i] ";
    $query = " DELETE FROM $tbName WHERE $param ";
    $result = mysqli_query($connection,$query); 
    return $result;
}




