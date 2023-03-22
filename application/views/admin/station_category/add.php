<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Category Station</a>
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
			<form class="form-horizontal" action="<?php echo site_url("station_category/add") ?>" method="post" enctype="multipart/form-data">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Category Name</label>
						<div class="col-md-6 col-sm-6">
							<input type="text" class="form-control" name="category_name" placeholder="Eg: Cafe, Tea Station, or etc" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Category Description</label>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" name="category_desc" placeholder="Max 500 Char!" required></textarea>
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