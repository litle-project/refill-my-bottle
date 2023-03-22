<style type="text/css">
.daterangepicker{
    top: 289.418px !important;
    /*right: 461.312px !important;*/
    /*left: auto !important;*/
    /*display: block !important;*/
}

.daterangepicker.opensleft:after {
    right: 458px !important;
}

.daterangepicker.opensleft:before {
    right: 457px !important;
}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Promo</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("promo/edit/".$data[0]['promo_id']."") ?>" method="post" autocomplete="off" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Promo Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" class="form-control" name="promo_name" placeholder="Name of This Promo" value="<?php echo $data[0]['promo_name']?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">For Station</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="station_id">
							<?php foreach ($station as $row) {	 ?>
								<option value="<?php echo $row['station_id'];?>"><?php echo $row['station_name'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php 
					$date1 	 = date("m-d-Y", strtotime($data[0]['start_date']));
					$date2 	 = date("m-d-Y", strtotime($data[0]['end_date']));
					$array	 = array($date1 , $date2); 
					$expired = implode(" - ", $array);
				?>

				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Expired Promo</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="expired" class="form-control" value="<?php echo $expired;?>" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Minimum Transaction</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" id="price" name="transaction" class="form-control" value="<?php echo $data[0]['transaction'];?>" min="0" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Promo Description</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="promo_desc"><?php echo $data[0]['promo_desc'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Term and Condition</label>
					<div class="col-md-6 col-sm-6">
						<textarea name="terms"><?php echo $data[0]['terms']?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Promo Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" name="promo_image" class="form-control">
					</div>
				</div>
						<!-- <textarea name='station_tag' class="form-control" placeholder='Movie names'></textarea> -->


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

	<!--  start datepicker range -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script>
		$(function() {
		  $('input[name="expired"]').daterangepicker({
		    opens: 'right'
		    // format: "dd-mm-yyyy"
		  }, function(start, end, label) {
		    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		    // format:date("dd-mm-yyyy");
		  });
		});
	</script>
	<!-- datepicker range end -->

	<!-- text area editor -->
	<script>
			CKEDITOR.replace( 'promo_desc' );
			CKEDITOR.replace( 'terms' );
	</script>

		<!-- input mask auto coma for currency -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
	<script>
		$(document).ready(function(){
		  
		  $('#price').mask("#,##0.00", {reverse: true});
		  $('#discount_price').mask("#,##0.00", {reverse: true});
		  
		});
	</script>
	<!-- end -->