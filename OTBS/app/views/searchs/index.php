<?php $search=true;?>
<?php include APPROOT . '/views/inc/header.php';?>
<div class="jumbotron jumbotron-fud">
    <div class="row">
      <!-- 2 3 column divs, both offset by 3 -->
        <div class="col-md-8 offset-md-3">
            <input class="form-control" id="searchMovie" type="text" placeholder="Search for Movies" style="width:580px;" autocomplete="off">
        </div>
    </div>    
    <div class="container mt-2" id="results">
        
    </div>
</div>

<script>
    URLROOT = 'http://otbs.com';
    $("#searchMovie").keyup(function(){
        var txt = $('#searchMovie').val();
        console.log(txt);
        if(txt.length >0){
            $.ajax({
                url:URLROOT+'/searchs/searchMovie',
                method:'post',
                data:{
                    search:txt
                },
                success:function(data){
                    $('#results').html(data);  
                }
            });
        }
        else{
            $('#results').html('');
        }
    });
</script>
