<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Category</a>
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
				<br/>

				<form action="<?php echo base_url().'category/save'; ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Category Name</label>
						<div class="col-md-6 col-sm-6">
							<?php
								echo form_input("category_name","","class='form-control' placeholder='Name' required");
							?>
						</div> 
					</div> 	 
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Category Description</label>
						<div class="col-md-6 col-sm-6">
							<?php
								echo form_input("category_desc","","class='form-control' placeholder='Description' required");
							?>
						</div> 
					</div>
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Category Icon</label>
						<div class="col-md-6 col-sm-6">
							<?php
								echo form_upload("category_icon","","class='form-control' placeholder='Image' required");
							?>
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn blue"><b>Submit</b></button>
							<button type="reset" class="btn red"  id="reset" onclick="window.history.back()"><b>Back</b></button>
							<!--
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
							-->
						</center>
					</div>
				</div>
				</form> 

			</div>
		</div>
	</div>
</div>			