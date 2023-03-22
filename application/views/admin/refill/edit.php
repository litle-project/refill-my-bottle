<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Refill Expired</a>
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

			<form action="<?php echo site_url("refil_exp/edit/".$data[0]['time_id']);?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Expired Time</label>
					<div class="col-md-5 col-sm-6">
						<input type="number" min="0" max="24" value="<?php echo $data[0]['time'];?>" name="time" class="form-control" required>
					</div>
						<span>
							/ Hours
						</span>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Reason Update</label>
					<div class="col-md-6 col-sm-6">
						<textarea rows="6" class="form-control" placeholder="Max 500 Char!" name="reason" required><?php echo $data[0]['reason'];?></textarea>
					</div>
				</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Submit</b></button>
						<button type="reset" class="btn default"  id="reset" onclick="window.history.back()"><b>Back</b></button>
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