<style type="text/css">
	.material-switch > input[type="checkbox"] {
    display: none;
    /*margin-left: 200px;   */
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch{
	margin-left: 390px;
	margin-top: 10px;
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}

.test2{
	margin-left: 775px;
	margin-top: -12px;
	position: sticky;
	display: none;
}

.test:hover .test2{
	display: block
}	
</style>

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
			
			<form class="form-horizontal" action="<?php echo site_url("station_master/edit/".$data[0]['station_id'].""); ?>"autocomplete="off" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Uniq Number</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="uniq_id" value="<?php echo $data[0]['uniq_id'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="station_name" value="<?php echo $data[0]['station_name'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Category Station</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="category_id">
							<?php foreach ($category as $row) {	 ?>
								<option <?php if ($row['category_id'] == $data[0]['category_id']) { echo "selected"; } ?> value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Type Station</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="type_id">
							<?php foreach ($type as $cow) {	 ?>
								<option <?php if ($cow['type_id'] == $data[0]['type_id']) { echo "selected"; } ?> value="<?php echo $cow['type_id'];?>"><?php echo $cow['name_type'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
					<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Type water</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="type_water_id">
							<?php foreach ($type_water as $low) {	 ?>
								<option <?php if ($low['type_water_id'] == $data[0]['type_water_id']) { echo "selected"; } ?> value="<?php echo $low['type_water_id'];?>"><?php echo $low['type_water_name'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Address</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" name="station_address" required><?php echo $data[0]['station_address'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Description</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="station_desc" ><?php echo $data[0]['station_desc'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Location</label>
					<div class="col-md-6 col-sm-6">
						<fieldset class="gllpLatlonPicker">
							<input type="text" placeholder="Search Your Location Here" class="gllpSearchField form-control">
							<!-- <br> -->
							<input type="button" class="gllpSearchButton btn btn-primary" value="search">
							<br/><br/>
							<div class="gllpMap">Google Maps</div>
							<br/>
								<input type="hidden" name="lat" class="gllpLatitude" value="<?php echo $data[0]['station_lat'];?>"/>
								<input type="hidden" name="long" class="gllpLongitude" value="<?php echo $data[0]['station_long'];?>"/>
								<input type="hidden" name="zoom" class="gllpZoom" value="8"/>
							<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
						</fieldset>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Phone</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="station_phone" value="<?php echo $data[0]['station_phone'];?>" >
					</div>
				</div>
				<div class="form-group">
					<div class="material-switch">
	                    <input id="point" name="use_point" type="checkbox" <?php if($data[0]['general_point'] == '0'){ echo "checked"; } ?> />
	                    <label for="point" class="label-primary"></label>
						<p style="margin-left: 50px; margin-top:-17px;">Give More Point If User Refill Here</p>
	                </div>
                </div>
				<div class="form-group"">
					<label class="col-md-4 col-sm-3 control-label">Refill Cost</label>
					<div class="col-md-5 col-sm-5">
						<input type="text" id="cost" class="form-control"  value="<?php echo $data[0]['cost'];?>" name="cost" min="0">
					</div>
					<label class="control-label"><b>Point</b> / Refill</label>
				</div>
				<div class="form-group" id="point_field" style="<?php if ($data[0]['general_point'] == '1') { echo "display:none"; } ?>">
					<label class="col-md-4 col-sm-3 control-label">Station Point</label>
					<div class="col-md-5 col-sm-5">
						<input type="number" class="form-control"  value="<?php echo $data[0]['station_point'];?>" name="station_point" min="1">
					</div>
					<label class="control-label"><b>Point</b> / Refill</label>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Open & Close Hours</label>
					<div class="col-md-3 col-sm-4">
						<div class="input-group clockpicker" data-align="top" data-autoclose="true">
						    <input type="text" name="open" class="form-control" value="<?php echo $data[0]['station_open_hour'];?>" style="width: 250px !important;" required>
						</div>
					</div>
					<div class="col-md-3 col-sm-3"">
						<div class="input-group clockpicker" data-align="top" data-autoclose="true">
						    <input type="text" name="close" class="form-control" value="<?php echo $data[0]['station_close_hour'];?>" style="width: 250px !important;" required>
						</div>
					</div>
				</div>
				<?php 
				$ceked = explode(',',$data[0]['opening_days']);
				// print_r($ceked);
				?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Open Day</label>
					<div class="col-md-6 col-sm-6">
						<input type="checkbox" id="check_1" 	onClick="ckChange(this)"	name="opening_days[]"  value="Daily" <?php in_array('Daily',$ceked) ? print "checked" : "" ?> >Daily<br/>
						<input type="checkbox" id="check_2"		onClick="ckChange(this)"	name="opening_days[]"  value="Monday" <?php in_array('Monday',$ceked) ? print "checked" : "" ?>>Monday<br/>
						<input type="checkbox" id="check_3"		onClick="ckChange(this)"	name="opening_days[]"  value="Tuesday"<?php in_array('Tuesday',$ceked) ? print "checked" : "" ?>>Tuesday<br/>
						<input type="checkbox" id="check_4"		onClick="ckChange(this)" 	name="opening_days[]"  value="Wednesday"<?php in_array('Wednesday',$ceked) ? print "checked" : "" ?>>Wednesday<br/>
						<input type="checkbox" id="check_5"		onClick="ckChange(this)"	name="opening_days[]"  value="Thursday"<?php in_array('Thursday',$ceked) ? print "checked" : "" ?>>Thursday<br/>
						<input type="checkbox" id="check_6"		onClick="ckChange(this)"	name="opening_days[]"  value="Friday"<?php in_array('Friday',$ceked) ? print "checked" : "" ?>>Friday<br/>
						<input type="checkbox" id="check_7"		onClick="ckChange(this)"	name="opening_days[]"  value="Saturday"<?php in_array('Saturday',$ceked) ? print "checked" : "" ?>>Saturday<br/>
						<input type="checkbox" id="check_8"		onClick="ckChange(this)"	name="opening_days[]"  value="Sunday"<?php in_array('Sunday',$ceked) ? print "checked" : "" ?>>Sunday<br/>
					</div>
				</div>



				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Facebook Page</label>
					<div class="col-md-5 col-sm-5">
						<input type="text" class="form-control" name="fb_id" value="<?php $data[0]['fb_id'];?>" placeholder="Your Facebook Page Link">
					</div>
					<div class="test"><i style="font-size:20px !important;" class="fa fa-question-circle"></i>
						<div class="test2"><img src="<?php echo base_url("assets/img/Capture.PNG")?>"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Website</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="website" value="<?php echo $data[0]['website']?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Image</label>
					<div class="col-md-6 col-sm-6">
					<img src="<?php echo base_url("media/station/".$data[0]["station_image"]);?>" width="400px" height="150px">
									<input type="hidden" name="photo_status" id="photo_status" value="0">
									<input type="button" value="Change Photo" class="btn blue-gradient" id="photo" style="font-weight: bold;">
									<p class="button-height inline-label pt" style="display:none">
										<?php echo form_upload("station_image","","id='photos'"); ?>
									</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Station Tag</label>
					<div class="col-md-6 col-sm-6">
            			<input id="tag" type="text" value="<?php echo $data[0]['station_tag'];?>" class="tags" name="station_tag" />
            			<span class="span">*Please Hold Button Enter If You Have Done With Your Tag</span>
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

	<!--  start jquery maps -->
	<script src="<?php echo base_url();?>js/jquery-2.1.1.min.js"></script>
	<!-- <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBem6H1KiKv7rBqyAAwdn0Xi9BB_FLOLNc"></script>
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
		// default: 'now'
	});
	</script>
	<!-- timepicker end -->
	<script>
		CKEDITOR.replace( 'station_desc' );
	</script>

	<script>
	$(document).ready(function(){
	    $('#point').change(function(){
	        if(this.checked)
	            $('#point_field').fadeIn('slow');
	        else
	            $('#point_field').fadeOut('slow');

	    });
	});
	</script>


	<!-- Station Tag  start -->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/tag/jquery.tagsinput.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/tag/jquery.tagsinput.js"></script>

	<script type="text/javascript">

		function onAddTag(tag) {
			alert("Added a tag: " + tag);
		}
		function onRemoveTag(tag) {
			alert("Removed a tag: " + tag);
		}

		function onChangeTag(input,tag) {
			alert("Changed a tag: " + tag);
		}

		$(function() {

			$('#tag').tagsInput({width:'auto'});

		});

	</script>

	<!-- end -->

	<!-- input mask auto coma for currency -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
	<script >
function ckChange(ckType){
    var ckName = document.getElementsByName(ckType.name);
    var checked = document.getElementById(ckType.id);

    if (checked.checked) {
      for(var i=0; i < ckName.length; i++){

          if(ckName[0].checked){
              ckName[1].disabled = true;
              ckName[2].disabled = true;
              ckName[3].disabled = true;
              ckName[4].disabled = true;
              ckName[5].disabled = true;
              ckName[6].disabled = true;
              ckName[7].disabled = true;
              ckName[1].checked = false;
              ckName[2].checked = false;
              ckName[3].checked = false;
              ckName[4].checked = false;
              ckName[5].checked = false;
              ckName[6].checked = false;
              ckName[7].checked = false;
          }else{
              ckName[i].disabled = false;
          }
      } 
    }
    else {
      for(var i=0; i < ckName.length; i++){
        ckName[i].disabled = false;
      } 
    }    
}
</script>
	<script>
		Inputmask.extendAliases({
		  pesos: {
		            prefix: "₱ ",
		            groupSeparator: ".",
		            alias: "numeric",
		            placeholder: "0",
		            autoGroup: !0,
		            digits: 2,
		            digitsOptional: !1,
		            clearMaskOnLostFocus: !1,
		        }
		});

		$(document).ready(function(){
		  
		  $("#cost").inputmask({ alias : "currency", prefix: '' });
		  
		});
	</script>

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
	<!-- end -->