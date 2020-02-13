<?php session_start() ;?>
<?php 
    // Check user login or not
    if(!isset($_SESSION[user_id])){
        header('Location: login-form.php');
    }
?>
<?php error_reporting(E_ALL) ;?>
<?php include "users.php";?>

<!--------------------------HANDLING GET REQUEST--------------------------------------------------->
  
<?php  
    $newUser = new Users;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        $nameRes = $emailRes = $numberRes = $genderRes  = $ageRes = $stateRes = $imglocRes = "";
        $skillRes=array();       
        $select_columns = array("user_name","email","phone_number","gender","age","state","images ");
        $cond = array(
            "id" => $_SESSION[user_id],
        );
        $result = $newUser->selectTable("users",$select_columns,$cond);
        if(!$result->num_rows)
            die("Query failed to extract the user information".mysqli_error($connection));   
        $row = mysqli_fetch_assoc($result);
        $nameRes=$row[user_name];
        $emailRes=$row[email];
        $numberRes=$row[phone_number];
        $genderRes=$row[gender];
        $ageRes=$row[age];
        $stateRes=$row[state];
        $imglocRes=$row[images];
        
        $select_columns = array( " course_id " );
        $cond = array(
            "user_id" => $_SESSION[user_id],
        );
        $result = $newUser->selectTable("users_has_skills",$select_columns,$cond);
        if(!$result)
            die("Query failed to extract the user skills information".mysqli_error($connection));
        
        while($row = mysqli_fetch_assoc($result)){
            array_push($skillRes,$row[course_id]);
        }
    }
?>

<?php include "../../includes/header.php"?>

<!--------------------------------------------FORM DETAILS------------------------------------------------------->
    <section class="profile-features">
    <div class="row">
        <form id="forms" method="post"  class="profile-credentials" enctype="multipart/form-data">
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="name">Name</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="name" id="name" placeholder="Your Name" title="Name can have only letters and spaces" required pattern = "[a-zA-Z ]{3,}" value=<?php echo $nameRes?>>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="email">Email</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="email" name="email" id="email" placeholder="Your Email" title="xyz@xyz.xyz" required pattern ="[a-zA-Z]{3,}[a-zA-Z0-9]*@[a-zA-Z]{3,}\.[a-zA-Z]{2,}" value=<?php echo $emailRes?>>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="number">Phone number</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="number" id="number" placeholder="Your Phone number" title="xxx-xxx-xxxx" required pattern = "^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$" value=<?php echo $numberRes?>>
                </div>
            </div>
    
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="gender">Gender</label>                                
                </div>
                <div class="col span-2-of-3 gender-list" id = "genders">
                    <input type="radio" name="gender"  value="Male" 
                        <?php 
                            if($genderRes =='Male') {
                                echo 'checked';
                            }
                        ?> > Male<br>

                    <input type="radio" name="gender" value="Female" 
                        <?php 
                            if($genderRes =='Female') {
                                echo 'checked';
                            }
                        ?> > Female<br>

                    <input type="radio" name="gender" value="Other" 
                        <?php 
                            if($genderRes =='Other') {
                                echo 'checked';
                            }
                        ?> > Other  
                </div>
            </div>
    
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="age">Age</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="number" name="age" id="age" min = '20' max = '30' placeholder=" Age " value=<?php echo $ageRes?>>
                </div>
            </div>
        
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="state">State</label>                                
                </div>
                <div class="col span-2-of-3">
                    <select name="state" class="states">
                        <option value="" selected>Choose</option>
                        <option value="Andhra Pradesh" <?php if($stateRes =='Andhra Pradesh')echo 'selected';?>>Andhra Pradesh</option>
                        <option value="Arunachal Pradesh" <?php if($stateRes =='Arunachal Pradesh')echo 'selected';?>>Arunach Pradesh</option>
                        <option value="Assam"<?php if($stateRes =='Assam')echo 'selected';?>>Assam</option>
                        <option value="Bihar"<?php if($stateRes =='Bihar')echo 'selected';?>>Bihar</option>
                        <option value="Chattisgarh"<?php if($stateRes =='Chattisgarh')echo 'selected';?>>Chattisgarh</option>
                        <option value="Goa" <?php if($stateRes =='Goa')echo 'selected';?>>Goa</option>
                        <option value="Gujarat"<?php if($stateRes =='Gujarat')echo 'selected';?>>Gujarat</option>
                        <option value="Haryana"<?php if($stateRes =='Haryana')echo 'selected';?>>Haryana</option>    
                        <option value="Himachal Pradesh"<?php if($stateRes =='Himachal Pradesh')echo 'selected';?>>Himachal Pradesh</option>   
                        <option value="Jharkhand"<?php if($stateRes =='Jharkhand')echo 'selected';?>>Jharkhand</option>    
                        <option value="Karnataka"<?php if($stateRes =='Karnataka')echo 'selected';?>>Karnataka</option>
                        <option value="Kerala"<?php if($stateRes =='Kerala')echo 'selected';?>>Kerala</option>    
                        <option value="Madhya Pradesh"<?php if($stateRes =='Madhya Pradesh')echo 'selected';?>>Madhya Pradesh</option>
                        <option value="Maharastra"<?php if($stateRes =='Maharastra')echo 'selected';?>>Maharastra</option>
                        <option value="Manipur"<?php if($stateRes =='Manipur')echo 'selected';?>>Manipur</option>
                        <option value="Meghalaya"<?php if($stateRes =='Meghalaya')echo 'selected';?>>Meghalaya</option>    
                        <option value="Mizoram"<?php if($stateRes =='Mizoram')echo 'selected';?>>Mizoram</option>    
                        <option value="Nagaland"<?php if($stateRes =='Nagaland')echo 'selected';?>>Nagaland</option>
                        <option value="Odisha"<?php if($stateRes =='Odisha')echo 'selected';?>>Odisha</option>
                        <option value="Punjab"<?php if($stateRes =='Punjab')echo 'selected';?>>Punjab</option>
                        <option value="Rajasthan"<?php if($stateRes =='Rajasthan')echo 'selected';?>>Rajasthan</option>
                        <option value="Sikkim"<?php if($stateRes =='Sikkim')echo 'selected';?>>Sikkim</option>    
                        <option value="Tamil Nadu"<?php if($stateRes =='Tamil Nadu')echo 'selected';?>>Tamil Nadu</option>    
                        <option value="Telangana"<?php if($stateRes =='Telangana')echo 'selected';?>>Telangana</option>    
                        <option value="Tripura"<?php if($stateRes =='Tripura')echo 'selected';?>>Tripura</option>    
                        <option value="Uttarakhand"<?php if($stateRes =='Uttarakhand')echo 'selected';?>>Uttarakhand</option>    
                        <option value="Uttar Pradesh"<?php if($stateRes =='Uttar Pradesh')echo 'selected';?>>Uttar Pradesh</option>
                        <option value="West Bengal"<?php if($stateRes =='West Bengal')echo 'selected';?>>West Bengal</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="skills">Skills</label>
                </div>
                <div class="col span-2-of-3 skill-set">
                    <input type="checkbox" name="skills[]" id="skills[]" value="1" <?php if(in_array(1,$skillRes)) echo 'checked'?>>C &nbsp;
                    <input type="checkbox" name="skills[]" id="skills[]" value="2" <?php if(in_array(2,$skillRes)) echo 'checked' ?>>C++ &nbsp;
                    <input type="checkbox" name="skills[]" id="skills[]" value="4" <?php if(in_array(4,$skillRes)) echo 'checked' ?>>PHP &nbsp;
                    <input type="checkbox" name="skills[]" id="skills[]" value="5" <?php if(in_array(5,$skillRes)) echo 'checked' ?>>Java Sript &nbsp;
                </div>
            </div>
            <div >
                <img src='<?php echo ($imglocRes==NULL) ? "/JS/resources/images/profile-pic.png" : $imglocRes;?>' alt="profile-pic" class="profile-picture">
                <input type="file" name="fileToUpload" id="fileToUpload"  class="document"> 
                <!-- <p class="docRes"><?php echo $imgRes?></p> -->
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label>&nbsp;</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="button" name="do-submit" value="Save" class="btn">
                </div>
            </div>
        </form>
    </div>
    </section>
    <h4>Updated Successfully</h4>
    <script>
        $(document).ready(function(){
            $(".btn").click(function(){
                if(validation()){
                    $.ajax({
                        url:'profileAPICall.php?class=users&method=updateTable',
                        type:'POST',
                        data: $("#forms").serialize(),
                        success:function(response){
                            $('h4').show();
                            setTimeout(() => {
                               $('h4').hide();
                            }, 2000);
                        },
                        error:function( response ) {
                            console.log(response);
                        }
                    });
                }
            });
        });    
        function validation(){
            $name = document.getElementById("name");
            $email = document.getElementById("email");
            $number = document.getElementById("number");
            $age = document.getElementById("age");
            $gender = document.getElementById("gender");
            nameReg = /^[a-zA-Z ]{3,}$/;
            emailReg = /[a-zA-Z]{3,}[a-zA-Z0-9]*@[a-zA-Z]{3,}\.[a-zA-Z]{2,}/;
            numberReg = /^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$/;
            
            if ($name.value === '' || $email.value === '' || $number.value === '' || $age.value === '' || undefined === $("input[name='gender']:checked"). val() || '' === $('.states').val()) {
                alert("Please fill all required fields...!!!!!!");
                return false;
            } else if (!($name.value.match(nameReg))) {
                alert("Invalid Name...!!!!!!");
                return false;
            } else if (!($email.value.match(emailReg))) {
                alert("Invalid Email...!!!!!!");
                return false;
            } else if (!($number.value.match(numberReg))) {
                alert("Invalid Contact...!!!!!!");
                return false;
            } else if ($age.value<20 || $age.value>30) {
                alert("Invalid Age...!!!!!!");
                return false;
            } else{
                return true;
            }
        }
    </script>
    
<?php include "../../includes/footer.php"?>