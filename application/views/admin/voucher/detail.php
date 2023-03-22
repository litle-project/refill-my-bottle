<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
			
			<form class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Voucher Name : </b></label>
					<label class="control-label"><?php echo $data[0]['voucher_name'];?></label>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Can Redeem When Point : </b></label>
					<label class="control-label"><?php echo $data[0]['point'];?> Point</label>
				</div>
				<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Available Until : </b></label>
					<label class="control-label"><?php echo date("d-m-Y", strtotime($data[0]['voucher_valid']));?></label>
				</div> -->
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Overview : </b></label>
					<div class="col-md-7">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['overview'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>How To Use : </b></label>
					<div class="col-md-7">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['how_to_use'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Terms and Condition : </b></label>
					<div class="col-md-7">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['voucher_terms'];?></label>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Voucher Quantity : </b></label>
					<label class="control-label"><?php echo $data[0]['voucher_qty'];?> PCS</label>
				</div> -->
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Event Image : </b></label>
					<label class="control-label"><img class="img img-responsive" width="300" height="300" src="<?php echo base_url("media/voucher/".$data[0]['voucher_image']."");?>"></label>
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

<!-- DATEPICKER START -->
<script src="<?php echo base_url();?>assets/js/date_picker/datepicker.js" type="text/javascript"></script>


<script>
	$(document).ready(function () {
	    $('#datepicker1').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd/mm/yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});

	$(document).ready(function () {
	    $('#datepicker2').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd/mm/yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});
</script>
<!-- END -->

<script>
	CKEDITOR.replace( 'event_content' );
</script>

