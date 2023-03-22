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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Country List</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("area/add") ?>" method="post" enctype="multipart/form-data">
				<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Country</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="country_id" id="country" >
						<?php foreach ($country as $key) { ?>

							<option value="<?php echo $key['country_id']; ?>" id="<?php echo $key['country_id'];?>"><?php echo $key['country_name']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">City</label>
					<div class="col-md-6 col-sm-6">
						<select name="city_id" class="form-control" id="city">
							<option value="">--- Please Select City ---</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Area Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="area_name" placeholder="eg: Kota Bandung" required>
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
	$('#country').change(function() {
			var country =  $('#country').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'area/cek_city/'?>"+country,
			    success: function(response){ 
		    		$('#city').empty().append(response);
				},
			    error: function(){
			    	alert('Error while request..');
			   	}
		   }); 

		});

</script>