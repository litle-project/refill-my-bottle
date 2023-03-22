<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    <body style="font-family: 'Ubuntu', sans-serif; src:url(https://fonts.google.com/specimen/Ubuntu?selection.family=Ubuntu)">
        <div class="container">
            <div class="row">
               <div class="col-md-12 item-photo">
                    <img style="max-width:100%;" src="<?php echo base_url("media/event/".$data[0]['event_image']);?>" />
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h3><?php echo $data[0]['event_name'];?></h3>
                        <h4><?php echo $data[0]['country_name'].", Province ".$data[0]['city_name']." ".$data[0]['area_name'];?></h4>
                    </div>
                     <div class="col-md-6">
                        
                                <label style="background-color: #738a8e; padding: .2em .6em .3em; color: #fff; text-align: center; border-radius: .25em; margin-top: 20px; margin-right: 2px;" class="pull-right"><?php echo $data[0]['category_name'];?></label>
                           
                    </div> 
                    <?php
                            $cacah = explode(" ", $data[0]['end_date']);
                            foreach($cacah as $cah) {
                                $cah = trim($cah);
                                $dicacah = $cah;
                                $meledak[] = $dicacah;
                            }

                            ?>
                </div>
                <div class="clearfix"></div>
                <hr size="20px"></hr>
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>Event Description</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['event_content'];?></h4>
                    </div>
                    <div class="form-group">
                        <h3>event periode</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['start_date']." - ".$meledak[0];?></h4>
                    </div>
                    
                </div>
            </div>
        </div>        
    </body>
</html>
