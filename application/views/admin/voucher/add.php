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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Voucher</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("voucher_master/add") ?>" method="post" autocomplete="off" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="voucher_name" placeholder="eg: Get Free Refill Voucher" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Can Redeem When Point</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" class="form-control" name="point" placeholder="eg: 50 Point" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Available Until</label>
					<div class="col-md-6 col-sm-6" >
						<div class="input-group date form_datetime" >
							<input id="datepicker2" width="520" name="voucher_valid" class="form-control" placeholder="Discount Available" readonly required />
                		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Overview</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="overview"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">How To Use</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="how_to_use"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Terms and Condition</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="voucher_terms"></textarea>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Quantity</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" name="voucher_qty" min="1" class="form-control" required>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" name="voucher_image" class="form-control" required>
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

<script>
	CKEDITOR.replace( 'overview' );
	CKEDITOR.replace( 'how_to_use' );
	CKEDITOR.replace( 'voucher_terms' );
</script>

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