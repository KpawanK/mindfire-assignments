<?php include APPROOT . '/views/inc/header.php';?>
<style>
    body{
        background-color: #f2f2f2;
    }
    .layout{
        background-color: white;
        margin-left:auto;
        margin-right:auto;
    }
    .seat{
        min-width: 27px;
        margin: 3px;
        text-align: center;
    }
    .seat:hover{
        background-color: deepskyblue;
        color:white;
    }
    
    
    .boundary{
        border: 1px solid black;
        border-radius: 5px;
    }
    .wrapSeats{
        display: block;
        width: max-content;
        margin: 2rem auto
    }
</style>
<div class="layout">
    <div class="wrapSeats">
    <?php 
        $seat=0;
        $r=65;
        for($row=0 ; $row < $data['seatInfo']->hall_no_rows ; $row++){
            echo "<div class='seat d-inline-block'>".chr($r+$row)."</div> ";
            for($col=0 ; $col < $data['seatInfo']->hall_no_cols ; $col++):?>
            <a href="#" style="text-decoration: none;font-size:12px;color:gray;">
                <div class="d-inline-block seat boundary">
                    <?php echo $seat+1;?>
                </div>
            </a>
                <?php $seat++;   
            endfor;?>
            <br> 

        <?php }
    ?>
    </div>
    <div>
        <p style="text-align: center;">All eyes this way please!</p> 
    </div>
</div>