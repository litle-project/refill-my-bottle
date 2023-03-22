<script src="<?php echo base_url();?>template/js/libs/jquery-1.10.2.min.js"></script>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Shop List Detail</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("olshop_detail/edit/".$data[0]['id_shop_detail']."") ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
					<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">ID SHOP</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="id_shop">
						<?php foreach ($ct as $key) { ?>
							<option value="<?php echo $key['id_shop'];?>" <?php  
								echo "selected";
							?>><?php echo $key['name_product'];?></option>
						<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">TITLE PRODUCT</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="title_product" value="<?php echo $data[0]['title_product']?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Overview <span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="overview" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["overview"];?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						How To Use <span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="how_to_use" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["how_to_use"];?></textarea>	
					</div>
				</div>
				<br/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Terms and Condition <span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<textarea class="ckeditor form-control" name="t_n_c" rows="6" data-error-container="#editor2_error"><?php echo $data[0]["t_n_c"];?></textarea>	
					</div>
				</div><div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						URL Web <span class="required"> *</span>
					</label>
					<div class="col-md-8 col-sm-8">
						<input name="id_shop_detail" value="<?php echo $data[0]["id_shop_detail"];?>" type="hidden">
						<input type="text" name="url_web" value="<?php echo $data[0]["url_web"];?>" data-required="1" class="form-control" required/>
					</div>
				</div>
				<br/>
				
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