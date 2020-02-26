<?php include APPROOT . '/views/inc/header.php';?>
    <style>
        .showTimes{
            margin: 8px;
            
        }
    </style>
    <section class="showTimes">
        <div class="row">
            <div class="col-md-4">
                    
            </div>
            <div class="col-md-8">
                <i class="fa fa-circle pull-right" style="color: orangered; font-size:13px;">FAST FILLING</i>
                <i class="fa fa-circle pull-right" style="color: green; font-size:13px;">AVAILABLE</i> 
               
            </div>
        </div>
        <?php foreach($data['hallDetails'] as $hall) : ?>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <a href="">
                        <h5 style="font-size: 18px; color:black;"><?php echo $hall->hall_name;?></h5>
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="">
                        <h5 style="font-size: 18px; color:black;">HII</h5>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        
        
    </section>
    