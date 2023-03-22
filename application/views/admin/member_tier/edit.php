
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Tier List</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("member_tier/edit/".$data[0]['tier_id']."") ?>" method="post" enctype="multipart/form-data">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Tier Name</label>
						<div class="col-md-6 col-sm-6">
							<input type="text" class="form-control" name="tier_name" value="<?php echo $data[0]['tier_name']?>" placeholder="eg: Member Silver" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Tier Bottle</label>
						<div class="col-md-6 col-sm-6">
							<input type="number" class="form-control" name="tier_point" value="<?php echo $data[0]['tier_point']?>" placeholder="eg: 2000 btl" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Tier Reward</label>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" name="tier_reward" placeholder="Give this tier reward"><?php echo $data[0]['tier_reward']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-sm-3 control-label">Tier Terms and Condition</label>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" name="tier_terms" placeholder="Terms and Condition"><?php echo $data[0]['tier_terms']?></textarea>
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Tier Icon/Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" name="tier_image" class="form-control">
					</div>
				</div>
				</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn blue"><b>Submit</b></button>&nbsp;&nbsp;&nbsp;
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
			CKEDITOR.replace( 'tier_reward' );
			CKEDITOR.replace( 'tier_terms' );
	</script>
