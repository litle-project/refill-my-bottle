<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Splash Screen</a>
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
					<label class="col-md-4 col-sm-3 control-label"><b>Splash Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['splash_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Image :</b></label>
					<div class="col-md-6 col-sm-6">
						<img class="control-label" src="<?php echo base_url('media/apps/splash/'.$data[0]['splash_image']);?>" style="height: 200px; width: 200px;"></img>
					</div>
				</div>
	
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Splash Content :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['splash_content'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Splash page :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['splash_page'];?></label>
					</div>
				</div>

				
				
				
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<!-- <button type="submit" class="btn blue"><b>Submit</b></button>&nbsp;&nbsp;&nbsp; -->
						<!-- <button type="reset" class="btn red"  id="reset"><b>Reset</b></button>&nbsp;&nbsp;&nbsp; -->
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>

	<!--  start jquery maps -->
	<script src="<?php echo base_url();?>js/jquery-2.1.1.min.js"></script>
	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo base_url();?>js/jquery-gmaps-latlon-picker.js"></script>
	<!-- end jquery maps -->

	<!-- timepicker start -->
	<script type="text/javascript" src="<?php echo base_url();?>js/wickedpicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/wickedpicker.css">
	
	<script type="text/javascript">
		var timepickers = $('.timepicker').wickedpicker(); console.log(timepickers.wickedpicker('time', 1)); //JS console: time of timepicker-two
	</script>