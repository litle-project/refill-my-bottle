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
                    <img style="max-width:100%;" src="<?php echo base_url("media/station/".$data[0]['station_image']);?>" />
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h3><?php echo $data[0]['station_name'];?></h3>
                        <h4><?php echo $data[0]['station_address'];?></h4>
                    </div>
                    <div class="col-md-6">
                        <?php if(!empty($data[0]['station_tag'])){ 
                            $cats = explode(",", $data[0]['station_tag']);
                            foreach($cats as $cat) {
                                $cat = trim($cat);
                                $dataku = $cat;
                                $data1[] = $dataku;
                            }
                            for ($i=0; $i<count($data1); $i++) { ?>
                                <label style="background-color: #337ab7; padding: .2em .6em .3em; color: #fff; text-align: center; border-radius: .25em; margin-top: 20px; margin-right: 2px;" class="pull-right"><?php echo $data1[$i];?></label>
                            <?php }
                        }else{
                            echo "This Station Has Not Tag";
                        }?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr size="20px"></hr>
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>Station Description</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['station_desc'];?></h4>
                    </div>
                    <div class="form-group">
                        <h3>Opening Hours</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['station_open_hour']." - ".$data[0]['station_close_hour'];?></h4>
                    </div>
                    <div class="form-group">
                        <h3>Type Of Station</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['category_name'];?></h4>
                    </div>
                    <div class="form-group">
                        <h3>Refill Cost</h3>
                        <h4 class="control-label" style="text-align: left;"><?php echo $data[0]['cost'];?></h4>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>
