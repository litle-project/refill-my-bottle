   <script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<br>
<div class="row">    
    <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box green">
                    <div class="portlet-title">
                            <div class="caption">
					<i class="fa fa-edit"></i><?php echo $title;?>
				</div>
				<!--<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>-->
                    </div>
                    <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
                                    <div class="form-body">
                                            
                                            <!--<div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    Your form validation is successful!
                                            </div>-->
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">HOME TITLE
                                                    <span class="required">
                                                            *
                                                    </span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input name="content_id" value="" type="hidden">
                                                        <input type="text" name="content_title" value="" data-required="1" class="form-control" required/>
                                                    </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">CONTENT
                                                    <span class="required">
                                                            *
                                                    </span>
                                                    </label>
                                                    <div class="col-md-8">
                                                            <textarea class="ckeditor form-control" name="content" rows="6" data-error-container="#editor2_error"></textarea>
                                                            
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="form-actions fluid">
                                            <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Save changes</button>
                                                    <button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_tips");?>'">Cancel</button>
                                            </div>
                                    </div>
                            </form>
                            <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
            </div>
    </div>
</div> 
<!--
<script>
$(document).ready(function(){
        
		<?php
		    for ($i=1; $i<=5; $i++){
		?>
		    xx<?php echo $i;?>=1;
		    $('#photos-<?php echo $i; ?>').val(xx<?php echo $i;?>);
		    $('#addRow2-<?php echo $i;?>').click(function(){
			    $(".mnc2-<?php echo $i;?>").fadeIn();
			    $(this).attr('disabled','disabled');
			    row = $(this).attr('row');
			    $("select#restaurant_city_id"+row).attr("required",true);
                            $("input#restaurant_city_lat"+row).attr("required",true);
                            $("input#restaurant_city_lang"+row).attr("required",true);
                            
			    $('#row<?php echo $i;?>-'+row).fadeIn(function(){
				    row++;
				    xx<?php echo $i;?>=xx<?php echo $i;?>+1;
				    
				    
				    $('#addRow2-<?php echo $i;?>').attr('row',row);
				    $('#addRow2-<?php echo $i;?>').removeAttr('disabled');
				    $('#photos-<?php echo $i; ?>').val(xx<?php echo $i;?>);
				   
				    //$('#admins1').val(x4);
			    });		
				    
		    });
		    $('#cancel2-<?php echo $i; ?>').click(function(){
					row=$("#addRow2-<?php echo $i;?>").attr('row');
					//alert (row);
					row=row-1;
					xx<?php echo $i;?>=xx<?php echo $i;?>-1;
					
					$("select#restaurant_city_id"+row).attr("required",false);
                                        $("input#restaurant_city_lat"+row).attr("required",false);
                                        $("input#restaurant_city_lang"+row).attr("required",false);
					$("input#photos-<?php echo $i; ?>").val(xx<?php echo $i;?>);
					//$("input#admins1").val(x4);
					$('#row<?php echo $i;?>-'+row).hide();
					if(row==2)
					{
						$(".mnc2-<?php echo $i; ?>").hide();
					}
                                        $('#addRow2-<?php echo $i;?>').removeAttr('disabled');
					$("#addRow2-<?php echo $i;?>").attr('row',row);
					
			});
		    
		
		<?php
		    }
		?>
		
    });
</script>

-->