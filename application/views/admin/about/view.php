<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

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
								<label class="col-md-4 col-sm-3 control-label">Photo<br/><small>Please input image on  min 440PX x 580PX - Max 1200PX x 1080PX  (W x H) Landscape </small></label>
								<div class="col-md-6 col-sm-6">
									<img src="<?php echo base_url("media/about/".$data[0]["image_utama"]);?>" width="580px" height="440px">
									<input type="hidden" name="photo_status" id="photo_status" value="0">
									<input type="button" value="Change Photo" class="btn blue-gradient" id="photo" style="font-weight: bold;">
									<p class="button-height inline-label pt" style="display:none">
										<?php echo form_upload("image_utama","","id='photos'"); ?>
									</p>
								</div>
							</div>
				<div class="form-group">
					<div style="margin-left: 150px">
						<label><h3>Section 1</h3></label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Title <span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<input name="content_id" value="<?php echo $data[0]["content_id"];?>" type="hidden">
						<input type="text" name="content_title_1" value="<?php echo $data[0]["content_title_1"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="content_1" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["content_1"];?></textarea>	
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
						<input type="text" name="content_title_2" value="<?php echo $data[0]["content_title_2"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="content_2" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["content_2"];?></textarea>	
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
						<input type="text" name="content_title_3" value="<?php echo $data[0]["content_title_3"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="content_3" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["content_3"];?></textarea>	
					</div>
				</div>


			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Save changes</b></button>
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_about");?>'"><b>Cancel</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>  
<script>
$("#photo").click(function(){
			//alert("aaa");
			var vala=$(this).attr("value");
			if(vala=="Change Photo"){
				$(".pt").fadeIn();
				$(this).val("Unchange Photo");
				$("#photos").attr("required",true);
				$("#photo_status").val("1");
			}else{
				$(".pt").hide();
				$(this).val("Change Photo");
				$("#photos").attr("required",false);
				$("#photo_status").val("0");
			}
		});
</script>
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