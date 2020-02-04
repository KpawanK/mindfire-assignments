<?php
class APICall{
    private $obj;
    public function includeClass( $className, $methodName ) {
        $fileName = $className . '.php';
        include $fileName;
        $obj = new $className();
        $res = $obj->$methodName($_POST["username"],$_POST["password"]);
        echo $res;
        exit;
    }
}

$api = new APICall();
$className = $_GET["class"];
$methodName = $_GET["method"];
$api->includeClass( $className, $methodName );

