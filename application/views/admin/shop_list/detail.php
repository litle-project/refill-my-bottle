<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Shop Detail</a>
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
					<label class="col-md-4 col-sm-3 control-label"><b>Product Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['name_product'];?></label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Price :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['price'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Point Discount :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['point_discount'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Price After Discount :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['price_after_discount'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Available Until:</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['available_until'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Overview :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['overview'];?></label>
					</div>
				</div>
     			<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>How To Use :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['how_to_use'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Terms & Condition :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['t_n_c'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>URL web :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['url_web'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Product Image :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><img src="<?php echo base_url()."media/shop/".$data[0]["image"]; ?>"  height="200px" width="300px" /></label>
					</div>
				</div>
	               
					<?php 
					$no = 1; 
					foreach ($image as $key) {
						if (!empty($key['shop_image'])) {
					?>
	                <div class="form-group">
						<label class="col-md-4 col-sm-3 control-label"><b>Image <?php echo $no++?> :</b></label>
						<div class="col-md-8 col-sm-8">
							<label class="control-label"><img src="<?php echo base_url()."media/shop/".$key["shop_image"]; ?>"  height="200px" width="300px" /></label>
						</div>
					</div>
					<?php }} ?>
						
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
						</center>
					</div>
				</div>
			</form>

			</div>
		</div>
	</div>
</div>