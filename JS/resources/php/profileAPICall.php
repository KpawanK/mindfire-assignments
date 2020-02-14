<?php session_start();?>
<?php
class profileAPICall{
    private $obj;
    public function includeClass( $className, $methodName ) {
        $fileName = $className . '.php';
        include $fileName;
        $obj = new $className();
        $set_command = array(
            "user_name" => "'".$_POST['name']."'",
            "email" => "'".$_POST['email']."'",
            "phone_number" => "'".$_POST['number']."'",
            "gender" => "'".$_POST['gender']."'",
            "age" => $_POST['age'],
            "state" => "'".$_POST['state']."'"
        );
        $cond=array(
            "id" => $_SESSION['user_id'],
        );
        $res = $obj->$methodName("users" , $set_command , $cond);
        
        $skill_command = '';
        $cond=array(
            "user_id" => $_SESSION['user_id'],
        );
        if(!empty($_POST['skills'])) {
            $skill_set = $_POST['skills'];
            $len = count($skill_set)-1;
            $res = $obj->deleteRecord("users_has_skills" , $cond);

            if(!$res) {
                echo "Query failed to delete the skill records";
                die;
            }
            while($len >= 1){
                $skill_command .= "($_SESSION[user_id],$skill_set[$len]), ";
                $len--;
            }

            $skill_command .= " ($_SESSION[user_id],$skill_set[0]) ";
            $col_name = array("user_id","course_id");
            $res = $obj->insertMultipleValues("users_has_skills",$col_name,$skill_command);
            if(!$res) {
                echo "Query failed to insert the skill records";
                die;
            }

        } else {
            $res = $obj->deleteRecord("users_has_skills" , $cond);
            if(!$res) {
                echo "Query failed to delete the skill records";
                die;
            }
        }
        exit;
    }
}

$api = new profileAPICall();
$className = $_GET["class"];
$methodName = $_GET["method"];
$api->includeClass( $className, $methodName );
