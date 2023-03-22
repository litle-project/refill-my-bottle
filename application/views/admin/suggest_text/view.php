<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body form">

			<form action="<?php echo base_url('suggest/index/'.$data[0]['text_id']);?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<br/>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Suggest Title</label>
					<div class="col-md-8 col-sm-8">
						<input type="text" class="form-control" value="<?php echo $data[0]['text_title']?>" placeholder="eg: Congratulation!" name="text_title" required>
						</input>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Content<span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="text_content" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["text_content"];?></textarea>	
					</div>
				</div>


			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Save changes</b></button>
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("suggest");?>'"><b>Cancel</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>  