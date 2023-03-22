<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/date_picker">
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="<?php echo site_url($this->uri->segment(1));?>">Shop List</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
			<br/>
			
			<form class="form-horizontal" autocomplete="off" action="<?php echo site_url("olshop/add"); ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Product Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="name_product" placeholder="This Product Name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Point To Discount</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" id="page" class="form-control" name="point_discount" min="0" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Price</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" id="price" class="form-control" name="price" min="1" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Price after Discount</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" id="discount_price" class="form-control" name="price_after_discount" min="1" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Available Until</label>
					<div class="col-md-6 col-sm-6" >
						<div class="input-group date form_datetime" >
							<input id="datepicker2" width="520" name="available_until" class="form-control" placeholder="Discount Available" readonly required />
                		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Overview <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="overview" rows="6" data-error-container="#editor2_error"></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						How To Use <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="how_to_use" rows="6" data-error-container="#editor2_error"></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Terms and Condition <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="t_n_c" rows="6" data-error-container="#editor2_error"></textarea>	
					</div>
				</div><div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						URL Web <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="url_web"  data-required="1" class="form-control" required/>
					</div>
				</div>
				<br/>
				
				<div class="form-group">
					<div id="sec_1" class="section">
					<label class="col-md-3 col-sm-3 control-label"> 
						Image <span class="required"> (Primary)</span>

					</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" class="form-control" name="image"  required>
				 <span class="required"> Please input image on  min 500PX x 500PX (W x H)  </span>
					</div>
				</div>
			</div>
			<?php for($i=1;$i<=4;$i++){
			 ?>
				<div class="form-group" id='row1-<?php echo $i; ?>' style="display: none;">
					<!-- <h3 class="form-section"></h3> -->
					<div class="form-group">
                        <label class="control-label col-md-3">Image <?php echo $i;?></label>
                        <div class="col-md-6 col-sm-6">
                        	<input type="file" class="form-control" style="width: 518px !important; margin-left: 7px !important;" name="<?php echo "name_image".$i."";?>">
                        </div>
                    </div>
				</div>
			<?php } ?>
			<input type="hidden" name="products" id="photos-1">
			<center>
				<button type="button" id="addRow2-1" class="btn" row="1"><b>Add More Images</b></button>
				<button type="button"  class="btn yellow mnc2-1" id="cancel2-1" style=" display: none;"><b>Remove</b></button>
			</center>
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn blue"><b>Submit</b></button>&nbsp;&nbsp;&nbsp;
						<button type="reset" class="btn red"  id="reset"><b>Reset</b></button>&nbsp;&nbsp;&nbsp;
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		<?php
		    for ($i=0; $i<=4; $i++){
		?>
		var xx<?php echo $i; ?> = 0;
		$('#photos-<?php echo $i; ?>').val(xx<?php echo $i; ?>);
		$('#addRow2-<?php echo $i; ?>').click(function(){
			$(".mnc2-<?php echo $i; ?>").fadeIn();
			$(this).attr('disabled','disabled');
			row = $(this).attr('row');
			$("input#package_id"+row).attr("required",true);
			$("input#package_detail_qty"+row).attr("required",true);
			$('#row<?php echo $i; ?>-'+row).fadeIn(function(){
				row++;
				xx<?php echo $i; ?>=xx<?php echo $i; ?>+1;    
				$('#addRow2-<?php echo $i; ?>').attr('row',row);
				$('#addRow2-<?php echo $i; ?>').removeAttr('disabled');
				$('#photos-<?php echo $i; ?>').val(xx<?php echo $i; ?>);   
				//$('#admins1').val(x4);
			});	    
		});
		
		$('#cancel2-<?php echo $i; ?>').click(function(){
			row=$("#addRow2-<?php echo $i; ?>").attr('row');
			//alert (row);
			row=row-1;
			xx<?php echo $i; ?>=xx<?php echo $i; ?>-1;		
			$("input#package_id"+row).attr("required",false);
			$("input#package_detail_qty"+row).attr("required",false);
			$("input#photos-<?php echo $i; ?>").val(xx<?php echo $i; ?>);
			//$("input#admins1").val(x4);
			$('#row<?php echo $i; ?>-'+row).hide();
			if(row==2){
				$(".mnc2-<?php echo $i; ?>").hide();
			}
			$('#addRow2-<?php echo $i; ?>').removeAttr('disabled');
			$("#addRow2-<?php echo $i; ?>").attr('row',row);
		});

		<?php
		    }
		?>
	});
</script>

<!-- Date Picker Available -->
<script src="<?php echo base_url();?>assets/js/date_picker/datepicker.js" type="text/javascript"></script>

<script>
	$(document).ready(function () {
	    $('#datepicker2').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd-mm-yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});
</script>

<!-- input mask auto coma for currency -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script>
	$(document).ready(function(){
	  
	  $('#price').mask("#,##0.00", {reverse: true});
	  $('#discount_price').mask("#,##0.00", {reverse: true});
	  
	});
</script>
<!-- end -->