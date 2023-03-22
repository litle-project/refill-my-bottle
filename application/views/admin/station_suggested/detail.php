<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Station</a>
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
					<label class="col-md-4 col-sm-3 control-label"><b>Suggested by :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['first_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['station_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Type :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['name_type'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Category :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['category_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Country :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['country_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>City :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['city_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Location (In Address) :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['location'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Email :</b></label>
					<div class="col-md-6 col-sm-6">
						<?php if (!empty($data[0]['email'])) { ?>
							<label class="control-label"><?php echo $data[0]['email'];?></label>
						<?php }else{ ?>
							<label class="control-label"><?php echo $data[0]['member_email'];?></label>
						<?php } ?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Image :</b></label>
					<div class="col-md-6 col-sm-6">
						<?php foreach ($image as $key) { ?>
							<br><img src="<?php echo base_url("media/station/suggested/".$key["suggest_image"]."");?>" height="100%" width="500px"></br>
						<?php }?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Location :</b></label>
					<div class="col-md-6 col-sm-6">
						<fieldset class="gllpLatlonPicker">
							<br/>
							<div class="gllpMap">Google Maps</div>
							<br/>
								<input type="hidden" name="lat" class="gllpLatitude" value="<?php echo $data[0]['suggest_lat'];?>"/>
								<input type="hidden" name="long" class="gllpLongitude" value="<?php echo $data[0]['suggest_long'];?>"/>
								<input type="hidden" name="zoom" class="gllpZoom" value="8"/>
						</fieldset>
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
	<!-- <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyDNopaHfVPZ-wS_gwdyM3GmYWvTzKy-pT0"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBem6H1KiKv7rBqyAAwdn0Xi9BB_FLOLNc"></script>
	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo base_url();?>js/jquery-gmaps-latlon-picker.js"></script>
	<!-- end jquery maps -->