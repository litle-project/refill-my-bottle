<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Tier List</a>
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
			<form class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Tier Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['tier_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Tier Bottle :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['tier_point'];?> Times</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Tier Reward :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['tier_reward'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Tier Terms and condition :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label" style="text-align: left;"><?php echo $data[0]['tier_terms'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Tier Logo/Image :</b></label>
					<div class="col-md-6 col-sm-6">
						<img class="control-label" src="<?php echo base_url('media/member_tier/'.$data[0]['tier_image']);?>" style="height: 100px; width: 90px;"></img>
					</div>
				</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<!-- <button type="submit" class="btn blue"><b>Submit</b></button>&nbsp;&nbsp;&nbsp; -->
						<!-- <button type="reset" class="btn red"  id="reset"><b>Reset</b></button>&nbsp;&nbsp;&nbsp; -->
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form>

			</div>
		</div>
	</div>
</div>