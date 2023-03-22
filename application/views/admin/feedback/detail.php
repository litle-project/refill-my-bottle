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
			
			<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Member Name : </b></label>
					<label class="control-label"><?php echo $data[0]['first_name'];?></label>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Station Name : </b></label>
					<label class="control-label"><?php echo $data[0]['station_name'];?></label>
				</div>
				<?php $date_end = explode(" ", $data[0]['created_date']); ?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Send Date : </b></label>
					<label class="control-label"><?php echo date("d-m-Y", strtotime($date_end[0]));?></label>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Event Content : </b></label>
					<div class="col-md-7">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['feedback_content'];?></label>
					</div>
				</div>
				
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>