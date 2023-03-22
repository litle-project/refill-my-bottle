<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body form">

			<form action="" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<br/>
				
				<div class="form-group">
					<div style="margin-left: 150px">
						<label><h3>Section 1</h3></label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Title<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<input name="tns_id" value="<?php echo $data[0]["tns_id"];?>" type="hidden">
						<input type="text" name="tns_title_1" value="<?php echo $data[0]["tns_title_1"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="tns_1" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["tns_1"];?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<div style="margin-left: 150px">
						<label><h3>Section 2</h3></label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Title<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" name="tns_title_2" value="<?php echo $data[0]["tns_title_2"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="tns_2" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["tns_2"];?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<div style="margin-left: 150px">
						<label><h3>Section 3</h3></label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Title<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" name="tns_title_3" value="<?php echo $data[0]["tns_title_3"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="tns_3" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["tns_3"];?></textarea>	
					</div>
				</div>


			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Save changes</b></button>
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_tns");?>'"><b>Cancel</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
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