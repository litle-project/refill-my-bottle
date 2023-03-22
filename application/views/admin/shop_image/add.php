<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="<?php echo site_url($this->uri->segment(1));?>">SHOP DETAIL IMAGE</a>
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
			
			<form class="form-horizontal" action="<?php echo site_url("olshop_image/add"); ?>" method="post" enctype="multipart/form-data">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">ID SHOP DETAIL</label>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" name="id_shop_detail">
						<?php foreach ($data as $key) { ?>
							<option value="<?php echo $key['id_shop_detail'];?>"><?php echo $key['title_product']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label">Name Image</label>
					<div class="col-md-6 col-sm-6">
						<input type="file" class="form-control" name="name_image"  required>
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
<!-- <script type="text/javascript">
	function check_page(){
			var page = $('#page').val();
		  	$.ajax({
			   	type: "post",
			   	url: "<?php echo base_url().'splash/check';?>",
			   	cache: false,    
			   	data:'page='+page,
			   	success: function(response){ 			    
				     if(response=='true'){
				      $('#checkEmail').css('border', '2px green solid'); 
				      $('#infoEmail').css('display', "none");
				      $('#submit').show();

				     }else{
				      $('#checkEmail').css('border', '2px red solid');
				      $('#infoEmail').css('display', "block");
				      $('#submit').hide();

				    } 		     
				},
			   	error: function(){      
			   		alert('Error while request..');
		  		}
			});
		}
</script> -->