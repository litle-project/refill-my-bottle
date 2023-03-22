
<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/date_picker">
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			
			<form class="form-horizontal" autocomplete="off" action="<?php echo site_url("olshop/edit/".$data[0]['id_shop'].""); ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Product Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="name_product" value="<?php echo $data[0]["name_product"]?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Point To Discount</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" id="page" class="form-control" name="point_discount" min="0" value="<?php echo $data[0]['point_discount']?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Price of Product</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" id="price" class="form-control" value="<?php echo $data[0]["price"]?>" name="price" min="1" required>
					</div>
				</div>
					<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Point After Discount</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" id="discount_price" class="form-control" name="price_after_discount" value="<?php echo $data[0]["price_after_discount"]?>" min="1" required>
					</div>
				</div>
				<?php $date = date("d-m-Y", strtotime($data[0]['available_until'])); ?>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Available Until</label>
					<div class="col-md-6 col-sm-6" >
						<div class="input-group date form_datetime" >
							<input id="datepicker2" width="520" name="available_until" value="<?php echo $date;?>" class="form-control" placeholder="Discount Available" readonly required />
	            		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Overview <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="overview" rows="6" data-error-container="#editor2_error"><?php echo $data[0]['overview']?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						How To Use <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="how_to_use" rows="6" data-error-container="#editor2_error"><?php echo $data[0]['how_to_use']?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Terms and Condition <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="ckeditor form-control" name="t_n_c" rows="6" data-error-container="#editor2_error"><?php echo $data[0]['t_n_c']?></textarea>	
					</div>
				</div><div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						URL Web <span class="required"> *</span>
					</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="url_web" value="<?php echo $data[0]['url_web']?>"  data-required="1" class="form-control" required/>
					</div>
				</div>

				<div class="form-group">
					<div id="sec_1" class="section">
						<label class="col-md-3 col-sm-3 control-label"> 
							Image <span class="required">(Primary)</span>
						</label>
						<div class="col-md-6 col-sm-6">
							<input type="file" class="form-control" name="image">
						</div>
					</div>
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