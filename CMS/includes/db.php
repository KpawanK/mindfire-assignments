<?php

   $db['db_host'] = "localhost";
   $db['db_user'] = "root";
   $db['db_pass'] = "Mfsi@6500";
   $db['db_name'] = "CMS";

   foreach( $db as $key => $value) {
        define(strtoupper($key) , $value);
   }

    $connection = mysqli_connect(DB_HOST , DB_USER , DB_PASS , DB_NAME);
    // if( $connection ) {
    //     echo "We are connected";
    // }


























?>