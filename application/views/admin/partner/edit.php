<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">FAQs</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("admin_partner/edit/".$data[0]['partner_id'].""); ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Partner Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="partner_name" value="<?php echo $data[0]['partner_name'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Partner Description</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" name="partner_description" required><?php echo $data[0]['partner_description'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Partner Image</label>
					<div class="col-md-6 col-sm-6">
						<img src="<?php echo base_url("media/partner/".$data[0]["partner_image"]);?>" width="200px" height="200px">
									<input type="hidden" name="photo_status" id="photo_status" value="0">
									<input type="button" value="Change Photo" class="btn blue-gradient" id="photo" style="font-weight: bold;">
									<p class="button-height inline-label pt" style="display:none">
										<?php echo form_upload("partner_image","","id='photos'"); ?>
									</p>
						<b>File type :</b> JPG, JPEG, PNG
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Web URL</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="partner_url" value="<?php echo $data[0]['partner_url'];?>" required>
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
$("#photo").click(function(){
			//alert("aaa");
			var vala=$(this).attr("value");
			if(vala=="Change Photo"){
				$(".pt").fadeIn();
				$(this).val("Unchange Photo");
				$("#photos").attr("required",true);
				$("#photo_status").val("1");
			}else{
				$(".pt").hide();
				$(this).val("Change Photo");
				$("#photos").attr("required",false);
				$("#photo_status").val("0");
			}
		});
</script>