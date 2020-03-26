<?php include APPROOT . '/views/inc/header.php';?>
<style>
    /* Style for the control nav */
    .control-nav li a:link,
    .control-nav li a:visited{
        padding-bottom: 15px;
        border-bottom: 2px solid transparent;
        transition: border-bottom 0.2s;
    }
    .control-nav li a:hover,
    .control-nav li a:active{
        padding-bottom: 15px;
        border-bottom: 2px solid #e67e22;
    }

    
    .active{
        padding-bottom: 11px;
        border-bottom: 2px solid #e67e22;
    }

</style>
<div class="row shadow-sm bg-light sticky-top mb-5" style="height: 40px;">
        <div class="col-9 mt-1 pl-4">
            <ul id="navigationBar" class="control-nav list-unstyled list-inline">
                <li class="list-inline-item mr-3"><a href="#" id="halls" class="text-dark" style="text-decoration: none;"><span class="fa fa-university"></span> HALLS</a></li>
                <li class="list-inline-item mr-3"><a href="#" id="movies" class="text-dark" style="text-decoration: none;"><span class="fa fa-television"></span> MOVIES</a></li>
                <li class="list-inline-item mr-3"><a href="#" id="timeSlots" class="text-dark" style="text-decoration: none;"><span class="fa fa-clock-o"></span> TIME-SLOTS</a></li>
                <li class="list-inline-item mr-3"><a href="#" id="users" class="text-dark" style="text-decoration: none;"><span class="fa fa-users"></span> USERS</a></li>
            </ul>
        </div>
        <div id="hallOperationButtons" class="col-3 text-right">  
            <button class="btn btn-success mr-3 mt-1" id="add"
            data-toggle="modal" style="height: 34px;width: 75px;"
            disabled><span class="fa fa-plus"></span> Add</button>
        </div>
</div>

<!-- HALL MODAL -->
<div class="modal" id="hallsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Hall Details</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="hallsForm" method="post">
                    <div class="form-group">
                        <label for="hallName">Hall Name: <sup>*</sup> </label>
                        <input type="text" name="hallName" id="hallName"placeholder="Hall Name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid':'';?>" value="<?php echo $data['name'];?>">
                        <span class="invalid-feedback"><?php echo $data['name_err'];?></span>
                    </div>
                    <div class="form-group">
                        <label for="noOfSeats">No of Seats</label>
                        <input type="number" name="noOfSeats" id="noOfSeats" min="1" placeholder="Number Of Seats" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="noOfRows">No of Rows</label>
                        <input type="number" name="noOfRows" id="noOfRows" min="1" placeholder="Number Of Rows" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="noOfCols">No of Columns</label>
                        <input type="number" name="noOfCols" id="noOfCols" min="1" placeholder="Number Of Columns" class="form-control">
                    </div>
                    <div class="text-right">
                        <input type="button" value="Add" class="btn btn-primary modalAddbutton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MOVIES MODAL -->
<div class="modal" id="moviesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Movie Details</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="moviesForm" method="post">
                    <div class="form-group">
                        <label for="movieName">Movie Name</label>
                        <input type="text" name="movieName" id="movieName" placeholder="Movie Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="releaseDate">Release Date</label>
                        <input type="text" name="releaseDate" id="releaseDate" min="1" placeholder="Release Date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" id="duration" placeholder="Duration" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="movieImage">Image</label>
                        <input type="number" name="movieImage" id="movieImage"  placeholder="Image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <input type="text" name="content" id="content"  placeholder="Content of Movie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" name="tags" id="tags" placeholder="Tags" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="number" name="status" id="status" min="0" max="1" placeholder="Status" class="form-control">
                    </div>
                    <div class="text-right">
                        <input type="button" value="Add" class="btn btn-primary modalAddbutton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- USERS MODAL -->
<div class="modal" id="usersModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User Details</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="usersForm" method="post">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" name="username" id="username" placeholder="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"placeholder="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword"placeholder="confirm password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="userImage">Image</label>
                        <input type="number" name="userImage" id="userImage" placeholder="Image" class="form-control">
                    </div>
                    <div class="text-right">
                        <input type="button" value="Add" class="btn btn-primary modalAddbutton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="dynamicContent" class="container-fluid">
        <h1 class="text-center">
            Welcome to Admin
        </h1>
</div>

<script>
    $('ul li').on( 'click', function(){
        method=$(this).children("a").attr('id');
        param='view';
        console.log(method);

        //switch to current section and make it as active class 
        $('ul li').removeClass('active');
        $(this).addClass('active');

        //make the Add button enabled and add the Modal name of current active tab as attribute to button 
        $('#add').removeAttr('disabled');
        $('#add').attr('data-target', '#'+method+'Modal');

        // bring the data of current active method using ajax call
        $.ajax({
                url:URLROOT+'/admins/'+method+'/'+param,
                method:'post',
                success:function(data){
                    $('#dynamicContent').html(data);  
                }
            });

    });


    //Submiting the modal form using ajax and updating the halls list
    $('.modalAddbutton').on('click',function(){
       $.ajax({
           url:URLROOT+'/admins/'+method+'/add',
           method:'post',
           data:$('#'+method+'Form').serialize(),
           success:function(data){
               if(data){
                   $('.close').click();
                    //Bringing back the updated hall list 
                    $.ajax({
                        url:URLROOT+'/admins/'+method+'/'+param,
                        method:'post',
                        success:function(data){
                            $('#dynamicContent').html(data);  
                        }
                    });
               }
           }
       });

    });
</script>

