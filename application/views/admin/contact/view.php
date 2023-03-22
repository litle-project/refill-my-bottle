<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-7">
		<div class="portlet box grey">
			<div class="portlet-body">
				<h3 class="pull-left"><strong><i>Contact Map</i></strong></h3>
				<a href="<?php echo site_url();?>admin_contact/edit/<?php echo $data[0]["content_id"];?>"><button class="btn blue pull-right" style="margin-top:5px;"><b>Edit</b></button></a>
				<br/><br/><br/>
				<?php echo $data[0]["content"];?>
				<hr/>
				<p class="pull-right" style="color:#666;"><i><b>Last updated : <?php echo $data[0]["updated_date"];?></b></i></p>
				<br/>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="portlet box grey">
			<div class="portlet-body">
				<h3 class="pull-left"><strong><i>Contact Content</i></strong></h3>
				<a href="<?php echo site_url();?>admin_contact/edit/<?php echo $data[1]["content_id"];?>"><button class="btn blue pull-right" style="margin-top:5px;"><b>Edit</b></button></a>
				<div style="padding:60px 10px 10px 10px;"><?php echo $data[1]["content"];?></div>
				<hr/>
				<p class="pull-right" style="color:#666;"><i><b>Last updated : <?php echo $data[1]["updated_date"];?></b></i></p>
				<br/>
			</div>
		</div>
	</div>
</div>