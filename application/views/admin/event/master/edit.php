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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Event Master</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("event_master/edit/".$data[0]['event_id']); ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event Title</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="event_name" value="<?php echo $data[0]['event_name'];?>" placeholder="Eg: Celebrate New Station" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event Start Date</label>
					<div class="col-md-6 col-sm-6">
						<div class="input-group date form_datetime">
							<input id="datepicker1" width="520" name="start_date" value="<?php echo date("d-m-Y", strtotime($data[0]['start_date']));?>" class="form-control" placeholder="Select Event Start Date" readonly required /> 
                		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event End Date</label>
					<div class="col-md-6 col-sm-6" >
						<div class="input-group date form_datetime" >
							<input id="datepicker2" width="520" name="end_date" value="<?php echo date("d-m-Y", strtotime($data[0]['end_date']));?>" class="form-control" placeholder="Select Event End Date" readonly required />
                		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event Category</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="category_id">
					<?php foreach ($category as $row) { ?>
							<option <?php if($row['category_id'] == $data[0]['category_id']){ echo "selected"; } ?> value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
					<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event Content</label>
					<div class="col-md-6 col-sm-6">
						<!-- <textarea class="form-control ck_editor" name="category_description" placeholder="Describe this category" required></textarea> -->
						<textarea name="event_content"><?php echo $data[0]['event_content'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" class="form-control" name="event_image" placeholder="Eg: Celebrate New Station">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event For Country</label>
					<div class="col-md-6 col-sm-6">
						<select name="country" class="form-control" id="country" required>
							<?php foreach ($country as $negara) { ?>
							<option <?php if($data[0]['country'] == $negara['country_id']){ echo "selected"; }?> value="<?php echo $negara['country_id'];?>"><?php echo $negara['country_name'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event For City</label>
					<div class="col-md-6 col-sm-6">
						<select name="city" class="form-control" id="city">
							<option value="<?php echo $data[0]['city']?>"></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Event For Area</label>
					<div class="col-md-6 col-sm-6">
						<select name="area" class="form-control" id="area">
							<option value="<?php echo $data[0]['area'];?>"></option>
						</select>
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

<!-- DATEPICKER START -->
<script src="<?php echo base_url();?>assets/js/date_picker/datepicker.js" type="text/javascript"></script>


<script>
	$(document).ready(function () {
	    $('#datepicker1').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd-mm-yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});

	$(document).ready(function () {
	    $('#datepicker2').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd-mm-yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});
</script>
<!-- END -->

<script>
	CKEDITOR.replace( 'event_content' );
</script>

<!-- show and hide city & state -->
<script>
	$('#country').change(function() {
			var country =  $('#country').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'event_master/cek_city/'?>"+country,
			    success: function(response){ 
		    		$('#city').empty().append(response);
				},
			    error: function(){
			    	alert('Error while request..');
			   	}
		   }); 

		});

		$('#city').change(function() {
			var city =  $('#city').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'event_master/cek_area/'?>"+city,
			    success: function(response){ 
		    		$('#area').empty().append(response);
				},
			    error: function(){
			    	alert('Error while request..');
			   	}
		   }); 

		});
</script>

<!-- end -->