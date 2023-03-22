<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Station</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("station_tag/add") ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Tag Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="tag_name" placeholder="Tag of Station" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Tag Description</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="tag_desc" placeholder="max 500 char!"></textarea>
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

	<!--  start jquery maps -->
	<script src="<?php echo base_url();?>js/jquery-2.1.1.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyDNopaHfVPZ-wS_gwdyM3GmYWvTzKy-pT0"></script>
	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo base_url();?>js/jquery-gmaps-latlon-picker.js"></script>
	<!-- end jquery maps -->

	<!-- timepicker start -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/time/bootstrap-clockpicker.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>js/time/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/time/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/time/highlight.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/time/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript">
	$('.clockpicker').clockpicker()
		.find('input').change(function(){
			console.log(this.value);
		});
	var input = $('#single-input').clockpicker({
		placement: 'bottom',
		// align: 'left',
		autoclose: true,
		default: 'now'
	});
	</script>
	<!-- timepicker end -->
	<script>
		CKEDITOR.replace( 'tag_desc' );
	</script>