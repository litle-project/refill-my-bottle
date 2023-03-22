<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/date_picker">
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Voucher</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("voucher_master/edit/".$data[0]['voucher_id']."") ?>" method="post" autocomplete="off" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="voucher_name" value="<?php echo $data[0]['voucher_name'];?>" placeholder="eg: Get Free Refill Voucher" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Can Redeem When Point</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" class="form-control" name="point" value="<?php echo $data[0]['point']?>" placeholder="eg: 50 Point" required>
					</div>
				</div>
				<?php $date = date("d-m-Y", strtotime($data[0]['voucher_valid'])) ?>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Available Until</label>
					<div class="col-md-6 col-sm-6" >
						<div class="input-group date form_datetime" >
							<input id="datepicker2" width="520" name="voucher_valid" value="<?php echo $date?>" class="form-control" placeholder="Discount Available" readonly required />
                		</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Overview</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="overview"><?php echo $data[0]['overview']?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">How To Use</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="how_to_use"><?php echo $data[0]['how_to_use']?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Terms and Condition</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="voucher_terms"><?php echo $data[0]['voucher_terms']?></textarea>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Quantity</label>
					<div class="col-md-6 col-sm-6">
						<input type="number" name="voucher_qty" min="1" class="form-control" value="<?php echo $data[0]['voucher_qty']?>" required>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Voucher Image</label>
					<div class="col-md-6 col-sm-6">
						<img src="<?php echo base_url("media/voucher/".$data[0]["voucher_image"]);?>" width="580px" height="440px">
						<input type="hidden" name="photo_status" id="photo_status" value="0">
						<input type="button" value="Change Photo" class="btn blue-gradient" id="photo" style="font-weight: bold;">
						<p class="button-height inline-label pt" style="display:none">
							<?php echo form_upload("voucher_image","","id='photos'"); ?>
						</p>
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
	CKEDITOR.replace( 'overview' );
	CKEDITOR.replace( 'how_to_use' );
	CKEDITOR.replace( 'voucher_terms' );
</script>

<script src="<?php echo base_url();?>assets/js/date_picker/datepicker.js" type="text/javascript"></script>
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
<script>
	$(document).ready(function () {
	    $('#datepicker2').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd-mm-yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});
</script>