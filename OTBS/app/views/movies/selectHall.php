<?php include APPROOT . '/views/inc/header.php';?>
    <style>
        body{
            background-color: #f2f2f2;
        }
        .showTimes{
            background-color: white;
            margin: 20px;
            padding: 10px;
            border: 1px solid white;
            border-radius: 3px;
        }
        .timings li{
            border: 0.5px solid grey;
            border-radius: 4px;
            display: inline-block;
            padding: 8px;
            color: green;
            font-size: 15px;
            
        }
        .timings li a{
            color: green;
            text-decoration: none;
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
                    <ul style="list-style: none; color:black;">
                        <li>
                            <a href="" style="color: black;">
                                <b><?php echo $hall->hall_name;?></b>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 mt-3">
                    <ul class="timings">
                        <?php 
                            $timings = explode("," , $hall->timings);
                            foreach( $timings as $timing) : ?>
                                <li class="mr-2">
                                    <a href="">
                                        <?php echo $timing ;?>
                                    </a>
                                </li>
                            <?php endforeach;
                        ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    