<?php
for($i=0;$i<count($data);$i++){
?>

           
                <div class="ls-layer" style="slidedirection: right; slidedelay: 5000; durationin: 1500; durationout: 1500;">
                        
                         <img src="<?php echo  base_url(); ?>media/sliding/<?php echo $data[$i]["sliding_image"] ;?>" class="ls-bg" alt="<?php echo $data[$i]["sliding_title"] ;?>"> 
                           
                </div>
   
<?php 
        }
?> 