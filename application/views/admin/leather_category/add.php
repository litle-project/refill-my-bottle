<br>
<?php
//echo "<pre>";
//print_r($promo);
//echo "</pre>";
?>
<div class="row">
	<div class="col-md-12">
		<div class="tab-sliding">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="<?php echo base_url().'admin_leather_category/save'; ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Category Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("leather_category_name","","class='form-control' placeholder='Name' required");
										?>
									</div> 
								</div> 
								 
								<div class="form-group">
									<label class="col-md-3 control-label">Category Description</label>
									<div class="col-md-4">
										<?php
											echo form_input("leather_category_desc","","class='form-control' placeholder='Description' required");
										?>
									</div> 
								</div>
								
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Category Icon</label>
									<div class="col-md-4">
										<?php
											echo form_upload("leather_category_icon","","class='form-control' placeholder='Image' required");
										?>
									</div>
								</div>
								
								
															
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>&nbsp;&nbsp;&nbsp;
									<button type="reset" class="btn red"  id="reset" onclick="window.history.back()">Back</button>&nbsp;&nbsp;&nbsp;
									<!--
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
									-->
								</div>
							</div>
						</form> 
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>				