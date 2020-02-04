<?php session_start() ;?>
<?php error_reporting(E_ALL) ;?>
<?php include "../../includes/db.php"; ?>
<?php include "../../includes/header.php"?>
<?php include "functions.php"; ?>
<?php include "userValidation.php";?>


<!--------------------------------------HANDLING POST-REQUEST------------------------------------------------------>
<?php

    $nameRes = $emailRes  = $numberRes = $genderRes= $ageRes = $stateRes  = $imgRes =  "";
    $temp = $name = $email = $number = $gender  = $age = $state  = $skill_command = $imgloc = "";
    $set_command = array();
    $skillRes=array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (!empty($_POST["name"])){
            if(!validate_name($_POST["name"]))
                $nameRes = "Only letters and white space allowed";  
             else{
                  $name = $_POST["name"];
                  $set_command["user_name"] = "'".$name."'";
             }
                     
        }
        
        if (!empty($_POST["email"])){
            if(!validate_email($_POST["email"]))
                $emailRes = "Invalid email format";       
             else{
                 $email = $_POST["email"];
                 $set_command["email"] ="'". $email."'";
             }
                
        }
        
        if (!empty($_POST["number"])){
            if(!validate_number($_POST["number"]))
                $numberRes = "Invalid Phone Number";       
             else{
                 $number = $_POST["number"];
                 $set_command["phone_number"] = "'".$number."'";
             }
                
        }
        if(empty($_POST["gender"])) {
            $genderRes = "Gender is required";
        } else{
            $gender=$_POST['gender'];
            $set_command["gender"] = "'".$gender."'";
        }
        

        if (!empty($_POST["age"])){
            if(validate_age($_POST["age"])){
                $age = $_POST["age"];
                $set_command["age"] = $age;
             }
             else
                $ageRes = "Age should be between 20 and 30";       
        }
        
        if(!empty($_POST["state"])){
            $state = $_POST['state'];
            $set_command["state"] = "'".$state."'";
        }
        
        if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0 ){
            $target_dir = "../../uploads/";
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = $_SESSION[user_id].'.'.end($temp);
            $_FILES["fileToUpload"]["name"] = $newfilename;
            
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $imgRes = "File is not an image.";
                $uploadOk = 0;
            }
            if ($_FILES["fileToUpload"]["size"] > 500000 && $uploadOk == 1) {
                $imgRes = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" && $uploadOk == 1 ) {
                $imgRes = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {

            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $set_command["images"] = "'"."/PHP/uploads/$newfilename"."'";
                } else {
                    $imgRes = "Sorry, there was an error uploading your file.";
                }
            }
        }
        
        
// ------------------------------------UPDATE USER INFORMATION -------------------------------------------------------------//
        
        $cond = array(
            "id" => $_SESSION[user_id],
        );

        $result = updateTable("MyUsers",$set_command, $cond );
        if(!$result)
            die("Query failed".mysqli_error($connection));


//------------------------------ INSERTING AND UPDATING THE SKILLS SET -------------------------------------------------------//

        if(!empty($_POST['skills'])){
            $skill_set = $_POST['skills'];
            $len=count($skill_set)-1;
            $cond=array(
                "user_id" => $_SESSION[user_id],
            );
            $result = deleteRecord("Pivot",$cond);
            if(!$result)
                die("Query failed".mysqli_error($connection));

            $query = "INSERT INTO Pivot(user_id,course_id) VALUES ";
            while($len>=1){
                array_push($skillRes,$skill_set[$len]);
                $skill_command .= "($_SESSION[user_id],$skill_set[$len]), ";
                $len--;
            }
            array_push($skillRes,$skill_set[0]);
            $skill_command .= " ($_SESSION[user_id],$skill_set[0]) ";
            $query .=  $skill_command;

            $result = mysqli_query($connection,$query);
            if(!$result)
                die("Query failed".mysqli_error($connection));
        }
        else{
            $cond=array(
                "user_id" => $_SESSION[user_id],
            );
            $result = deleteRecord("Pivot",$cond);
            if(!$result)
                die("Query failed".mysqli_error($connection));
        }


//--------------------------------- EXTRACTING THE USER INFORMATION-------------------//
        
        $select_column = array("user_name","email","phone_number","gender","age","state","images ");
        $cond=array(
            "id" =>$_SESSION[user_id],
        );
        $result = selectTable("MyUsers",$select_column,$cond);
        if(!$result->num_rows)
            die("Query failed".mysqli_error($connection));   
        
        
        $row = mysqli_fetch_assoc($result);
        $name=$row[user_name];
        $email=$row[email];
        $number=$row[phone_number];
        $gender=$row[gender];
        $age=$row[age];
        $state=$row[state];
        $imgloc=$row[images];

    }

?>

<!--------------------------HANDLING GET REQUEST--------------------------------------------------->

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        $name = $email = $number = $gender  = $age = $state = $imgloc = "";
        $skillRes=array();       
        $select_columns = array("user_name","email","phone_number","gender","age","state","images ");
        $cond = array(
            "id" => $_SESSION[user_id],
        );
        $result=selectTable("MyUsers",$select_columns,$cond);
        
        if(!$result->num_rows)
            die("Query failed".mysqli_error($connection));   
        $row = mysqli_fetch_assoc($result);
        $name=$row[user_name];
        $email=$row[email];
        $number=$row[phone_number];
        $gender=$row[gender];
        $age=$row[age];
        $state=$row[state];
        $imgloc=$row[images];
        
        $select_columns = array( " course_id " );
        $cond = array(
            "user_id" => $_SESSION[user_id],
        );
        $result = selectTable("Pivot",$select_columns,$cond);
        if(!$result)
            die("Query failed".mysqli_error($connection));
        
        while($row = mysqli_fetch_assoc($result)){
            array_push($skillRes,$row[course_id]);
        }

    }
?>


<?php include "/PHP/includes/header.php" ?>

<!--------------------------------------------FORM DETAILS------------------------------------------------------->
    <section class="profile-features">
    <div class="row">
        <form method="post" class="profile-credentials" enctype="multipart/form-data">
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="name">Name</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="name" id="name" placeholder="Your Name" value=<?php echo $name?>>
                    <?php echo $nameRes?>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="email">Email</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="email" name="email" id="email" placeholder="Your Email" value=<?php echo $email?>>
                    <?php echo $emailRes?>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="number">Phone number</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="number" id="number" placeholder="Your Phone number" value=<?php echo $number?>>
                    <?php echo $numberRes?>
                </div>
            </div>
    
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="gender">Gender</label>                                
                </div>
                <div class="col span-2-of-3 gender-list">
                    <input type="radio" name="gender" value="Male" <?php 
                        if($gender =='Male') echo 'checked';?>> Male<br>
                            <input type="radio" name="gender" value="Female" <?php 
                        if($gender =='Female') echo 'checked';?>> Female<br>
                            <input type="radio" name="gender" value="Other" <?php 
                        if($gender =='Other') echo 'checked';?>> Other  
                </div>
            </div>
    
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="age">Age</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="age" id="age" placeholder="Your Age Please" value=<?php echo $age?>>
                    <?php echo $ageRes?>
                </div>
            </div>
        
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="state">State</label>                                
                </div>
                <div class="col span-2-of-3">
                    <select name="state">
                        <option value="" selected>Choose</option>
                        <option value="Andhra Pradesh" <?php if($state =='Andhra Pradesh')echo 'selected';?>>Andhra Pradesh</option>
                        <option value="Arunachal Pradesh" <?php if($state =='Arunachal Pradesh')echo 'selected';?>>Arunach Pradesh</option>
                        <option value="Assam"<?php if($state =='Assam')echo 'selected';?>>Assam</option>
                        <option value="Bihar"<?php if($state =='Bihar')echo 'selected';?>>Bihar</option>
                        <option value="Chattisgarh"<?php if($state =='Chattisgarh')echo 'selected';?>>Chattisgarh</option>
                        <option value="Goa" <?php if($state =='Goa')echo 'selected';?>>Goa</option>
                        <option value="Gujarat"<?php if($state =='Gujarat')echo 'selected';?>>Gujarat</option>
                        <option value="Haryana"<?php if($state =='Haryana')echo 'selected';?>>Haryana</option>    
                        <option value="Himachal Pradesh"<?php if($state =='Himachal Pradesh')echo 'selected';?>>Himachal Pradesh</option>   
                        <option value="Jharkhand"<?php if($state =='Jharkhand')echo 'selected';?>>Jharkhand</option>    
                        <option value="Karnataka"<?php if($state =='Karnataka')echo 'selected';?>>Karnataka</option>
                        <option value="Kerala"<?php if($state =='Kerala')echo 'selected';?>>Kerala</option>    
                        <option value="Madhya Pradesh"<?php if($state =='Madhya Pradesh')echo 'selected';?>>Madhya Pradesh</option>
                        <option value="Maharastra"<?php if($state =='Maharastra')echo 'selected';?>>Maharastra</option>
                        <option value="Manipur"<?php if($state =='Manipur')echo 'selected';?>>Manipur</option>
                        <option value="Meghalaya"<?php if($state =='Meghalaya')echo 'selected';?>>Meghalaya</option>    
                        <option value="Mizoram"<?php if($state =='Mizoram')echo 'selected';?>>Mizoram</option>    
                        <option value="Nagaland"<?php if($state =='Nagaland')echo 'selected';?>>Nagaland</option>
                        <option value="Odisha"<?php if($state =='Odisha')echo 'selected';?>>Odisha</option>
                        <option value="Punjab"<?php if($state =='Punjab')echo 'selected';?>>Punjab</option>
                        <option value="Rajasthan"<?php if($state =='Rajasthan')echo 'selected';?>>Rajasthan</option>
                        <option value="Sikkim"<?php if($state =='Sikkim')echo 'selected';?>>Sikkim</option>    
                        <option value="Tamil Nadu"<?php if($state =='Tamil Nadu')echo 'selected';?>>Tamil Nadu</option>    
                        <option value="Telangana"<?php if($state =='Telangana')echo 'selected';?>>Telangana</option>    
                        <option value="Tripura"<?php if($state =='Tripura')echo 'selected';?>>Tripura</option>    
                        <option value="Uttarakhand"<?php if($state =='Uttarakhand')echo 'selected';?>>Uttarakhand</option>    
                        <option value="Uttar Pradesh"<?php if($state =='Uttar Pradesh')echo 'selected';?>>Uttar Pradesh</option>
                        <option value="West Bengal"<?php if($state =='West Bengal')echo 'selected';?>>West Bengal</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="skills">Skills</label>
                </div>
                <div class="col span-2-of-3 skill-set">
                    <input type="checkbox" name="skills[]" value="1" <?php if(in_array(1,$skillRes)) echo 'checked'?>>C &nbsp;
                    <input type="checkbox" name="skills[]" value="2" <?php if(in_array(2,$skillRes)) echo 'checked' ?>>C++ &nbsp;
                    <input type="checkbox" name="skills[]" value="3" <?php if(in_array(3,$skillRes)) echo 'checked' ?>>Java &nbsp;
                    <input type="checkbox" name="skills[]" value="4" <?php if(in_array(4,$skillRes)) echo 'checked' ?>>PHP &nbsp;
                    <input type="checkbox" name="skills[]" value="5" <?php if(in_array(5,$skillRes)) echo 'checked' ?>>Java Sript &nbsp;
                </div>
            </div>
            <div >
                <img src='<?php echo ($imgloc==NULL) ? "/PHP/resources/images/profile-pic.png" : $imgloc;?>' alt="profile-pic" class="profile-picture">
                <input type="file" name="fileToUpload" id="fileToUpload"  class="document"> 
                <p class="docRes"><?php echo $imgRes?></p>
            </div>
            <!--
            <div>
                <h4 class="resume-heading">Choose resume</h4>
                <input type="file" name="resumeToUpload" id="resumeToUpload" accept=".pdf" class="resume"> 
            </div>
            -->
            <div class="row">
                <div class="col span-1-of-3">
                    <label>&nbsp;</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="submit" name="do-submit" value="Save" class="btn">
                </div>
            </div>
        </form>
    </div>
    </section>
    
<?php include "../../includes/footer.php"?>
<?php mysqli_close($connection);  ?>