<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Member List</a>
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
					<label class="col-md-4 col-sm-3 control-label"><b>Member id :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['member_id'];?></label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>member email :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['member_email'];?></label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>key :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['key_activated'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>status :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['status'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>fb id:</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['facebook_id'];?></label>
					</div>
				</div>
			<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>google id:</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['google_id'];?></label>
					</div>
				</div>
			<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Business Type :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0][''];?></label>
					</div>
				</div> -->

				<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Store Location :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['store_logo'];?></label>
					</div>
				</div> -->
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