<br>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><?php echo $control;?></a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>
				<form action="<?php echo base_url().$this->uri->segment(1); ?>/import" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<!-- <form action="<?php echo site_url($this->uri->segment(1));?>/import" method="POST" class="form-horizontal" enctype='multipart/form-data'> -->
					<div class="form-body">
					
						<div class="form-group">
							<label class="col-md-3 control-label">File Ms.excel</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="import"  >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">How to Use?</label>
							<div class="col-md-4">
								<label class="col-md-8 control-label"><span style="color: red">Click image to use this template</span></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Sample Ms. excel</label>
							<div class="col-md-4">
								<a href="<?php echo base_url("assets/file/".$excel_sample);?>"><img width="740px" src="<?php echo base_url("assets/file/".$image_sample); ?>"></a>
							</div>
						</div>
					</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green" name="submit"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
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