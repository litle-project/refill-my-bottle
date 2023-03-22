<br>
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
						<br>
						<form action="<?php echo base_url().$this->uri->segment(1); ?>/save" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Printer Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("printer_name","","class='form-control' placeholder='Name' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Printer Description</label>
									<div class="col-md-6">
										<?php
											echo form_textarea("printer_desc","","class='form-control ckeditor' placeholder='Description'   ");
										?>
									</div>
								</div>
																
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Printer Image</label>
									<div class="col-md-4">
										<?php
											echo form_upload("printer_image","","class='form-control' placeholder='Image' ");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Cartridge Image</label>
									<div class="col-md-4">
										<?php
											echo form_upload("printer_image_detail","","class='form-control' placeholder='Image' ");
										?>
									</div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn green">Submit</button>&nbsp;&nbsp;&nbsp;
									<button type="reset" class="btn black" onclick="window.history.back();"  id="reset">Back</button>&nbsp;&nbsp;&nbsp;
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