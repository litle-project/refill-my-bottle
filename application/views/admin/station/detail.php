<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
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
					<label class="col-md-4 col-sm-3 control-label"><b>Station Uniq Number :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['uniq_name']."-".sprintf('%07d',$data[0]['uniq_id']);?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['station_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Facebook :</b></label>
					<div class="col-md-6 col-sm-6">
						<?php if (!empty($data[0]['fb_id'])) { ?>
							<label class="control-label"><?php echo $data[0]['fb_id'];?></label>
						<?php }else{ ?>
							<label class="control-label">This Station Hasn't Facebook</label>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Website :</b></label>
					<div class="col-md-6 col-sm-6">
						<?php if (!empty($data[0]['website'])) { ?>
							<label class="control-label"><?php echo $data[0]['website'];?></label>
						<?php }else{ ?>
							<label class="control-label">This Station Hasn't Website</label>
						<?php } ?>
					</div>
				</div>
					<?php	
						$empty = 0;
						if (!empty($rate)) {
						 	foreach ($rate as $key) {
					 			$empty += $key['rating'];
						 	}
						 	$result = $empty/count($rate);
						}
					?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Rate : </b></label>
					<div class="col-md-6 col-sm-6">
						<div class="rating-block">
							<h2 style="margin-left: 20px;" class="bold padding-bottom-7"><?php if (!empty($result)) { echo $result; ?><small> / 5</small></h2>
								<?php } else { ?> 
									<div class="col-md-6 col-sm-6" style="margin-top: -15px !important;">
										<label class="control-label" style="color: black; margin-left: -55px;"><?php echo "This Station Has No Ratings Yet";?></label>
									</div> 
								<?php } ?>
								
								<!-- 1 star -->
								<?php if (!empty($result) && $result > 0 && $result < 2) { ?>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>

								<!-- 2 star -->
								<?php }elseif(!empty($result) && $result > 1 && $result < 3){ ?>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>

								<!-- 3 star -->
								<?php }elseif(!empty($result) && $result > 2 && $result < 4){ ?>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>

								<!-- 4 star -->
								<?php }elseif (!empty($result) && $result > 3 && $result < 5) { ?>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>

								<!-- 5 star -->
								<?php }elseif (!empty($result) && $result > 4 && $result < 6) { ?>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>
									<label style="background-color: #fff; border: 1px solid #ccc; padding: .2em .6em .3em; color: #f0ad4e; text-align: center; border-radius: .25em;" class="control-label">
									  <i class="fa fa-star"></i>
									</label>

								<!-- other -->
								<?php }else{ echo ""; }?>
							</div>
					</div>
				</div>
				<?php
					for ($i=0; $i<count($category) ; $i++) { 
						if ($data[0]['category_id'] == $category[$i]['category_id']) {
							$category_station = $category[$i]['category_name'];
						}
					}
					for ($s=0; $s<count($type) ; $s++) { 
						if ($data[0]['type_id'] == $type[$s]['type_id']) {
							$tos= $type[$s]['name_type'];
						}
					}
				?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Category :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $category_station;?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Type :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $tos;?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Address :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['station_address'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Desc :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label" style="text-align: center;"><?php echo $data[0]['station_desc'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Location :</b></label>
					<div class="col-md-6 col-sm-6">
						<fieldset class="gllpLatlonPicker">
							<br/>
							<div class="gllpMap">Google Maps</div>
							<br/>
								<input type="hidden" name="lat" class="gllpLatitude" value="<?php echo $data[0]['station_lat'];?>"/>
								<input type="hidden" name="long" class="gllpLongitude" value="<?php echo $data[0]['station_long'];?>"/>
								<input type="hidden" name="zoom" class="gllpZoom" value="8"/>
						</fieldset>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Phone :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['station_phone'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Point :</b></label>
					<div class="col-md-5 col-sm-5">
						<label class="control-label"><?php echo $data[0]['station_point'];?> Point / Refill</label>
					</div>
					<!-- <label class="control-label"><b>Point</b> / Refill</label> -->
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Refill Cost :</b></label>
					<div class="col-md-5 col-sm-5">
						<label class="control-label"><?php echo $data[0]['cost'];?> Cost / Refill</label>
					</div>
					<!-- <label class="control-label"><b>Point</b> / Refill</label> -->
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Open & Close Hours :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['station_open_hour'];?></label> <b>-</b>
						<label class="control-label"><?php echo $data[0]['station_close_hour'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Image :</b></label>
					<div class="col-md-6 col-sm-6">
						<img class="control-label" src="<?php echo base_url('media/station/'.$data[0]['station_image']);?>" style="height: 200px; width: 200px;"></img>
					</div>
				</div>
				<?php 
					foreach ($data as $row) {
						$cats = explode(",", $row['station_tag']);
						foreach($cats as $cat) {
						    $cat = trim($cat);
						    $dataku = $cat;
						    $data1[] = $dataku;
						}
					}
				?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Tag :</b></label>
					<div class="col-md-6 col-sm-6">
						<?php for ($i=0; $i<count($data1); $i++) { ?>
							<label style="background-color: #337ab7; padding: .2em .6em .3em; color: #fff; text-align: center; border-radius: .25em; margin-top: 3px;" class="control-label"><?php echo $data1[$i];?></label>
						<?php }?>
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
	<!-- <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
<!-- 	<script src="http://maps.google.com/maps/api/js?key=AIzaSyDNopaHfVPZ-wS_gwdyM3GmYWvTzKy-pT0"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBem6H1KiKv7rBqyAAwdn0Xi9BB_FLOLNc"></script>
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
	<!-- timepicker end