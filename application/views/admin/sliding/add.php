<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Sliding</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-7 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">

			<form action="<?php echo site_url("admin_sliding/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<br/>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Sliding Title</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="sliding_title" placeholder="Sliding Title" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Sliding Desc</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" name="sliding_desc" placeholder="Sliding Desc" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Sliding Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" class="form-control" name="sliding_image" placeholder="Sliding Image">
					</div>
				</div>
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn blue"><b>Submit</b></button>
						<button type="button" class="btn default"><b>Cancel</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>