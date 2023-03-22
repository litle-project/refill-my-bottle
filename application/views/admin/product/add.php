<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Product</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>

				<form action="<?php echo base_url().$this->uri->segment(1); ?>/add" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Name</label>
						<div class="col-md-8 col-sm-8">
							<?php
								echo form_input("product_name","","class='form-control' placeholder='Name' required");
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Category</label>
						<div class="col-md-8 col-sm-8">
							<?php
								echo form_dropdown("category_id",$printer,"","class='form-control' ");
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Description</label>
						<div class="col-md-8 col-sm-8">
							<?php
								echo form_textarea("product_desc","","class='form-control ckeditor' placeholder='Description'   ");
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Image (Primary)</label>
						<div class="col-md-8 col-sm-8">
							<?php
								echo form_upload("product_image","","class='form-control' placeholder='Image' required");
							?>
						</div>
					</div>
					<?php
						for($i=1;$i<=10;$i++){
					?>
					<div class="form-group" id='row1-<?php echo $i; ?>' style="display: none;">
						<label class="col-md-3 col-sm-3 control-label">Image <?php echo $i ?></label>
						<div class="col-md-8 col-sm-8">
							<input type="file" class="form-control" name="product_image<?php echo $i ?>" id="product_image<?php echo $i ?>" placeholder="Item Image">
						</div>
					</div>
					<?php
						}
					?>
					<p class="button-height inline-label">
						<input type="hidden" name="images" id="photos-1"><br>
						<center>
							<button type="button" id="addRow2-1" class="btn" row="1"><b>Add More Image</b></button>
							<button type="button"  class="btn yellow mnc2-1" id="cancel2-1" style=" display: none;"><b>Remove</b></button>
						</center>
					</p>
					<br/>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
							<!--
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
							-->
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
		var xx1 = 0;
		$('#photos-1').val(xx1);
		$('#addRow2-1').click(function(){
			$(".mnc2-1").fadeIn();
			$(this).attr('disabled','disabled');
			$(this).attr('disabled','disabled');
			row = $(this).attr('row');
			$("input#product_image"+row).attr("required",true);
			$('#row1-'+row).fadeIn(function(){
				row++;
				xx1=xx1+1;    
				$('#addRow2-1').attr('row',row);
				$('#addRow2-1').removeAttr('disabled');
				$('#photos-1').val(xx1);   
				//$('#admins1').val(x4);
			});	    
		});
		
		$('#cancel2-<?php echo $i; ?>').click(function(){
			row=$("#addRow2-1").attr('row');
			//alert (row);
			row=row-1;
			xx1=xx1-1;		
			$("input#product_image"+row).attr("required",false);
			$("input#photos-1").val(xx1);
			//$("input#admins1").val(x4);
			$('#row1-'+row).hide();
			if(row==1){
				$(".mnc2-<?php echo $i; ?>").hide();
			}
			$('#addRow2-1').removeAttr('disabled');
			$("#addRow2-1").attr('row',row);
		});
	});
</script>