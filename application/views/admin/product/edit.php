<?php
	$row = $data[0];
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Product</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-7 col-sm-8">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<div class="form-body">
					<h3><i><b>Product Content</b></i></h3>
					<br/>

					<form action="<?php echo base_url().$this->uri->segment(1).'/update'; ?>" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
					<input type='hidden' name='id' value="<?php echo $row['product_id']; ?>" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">
								Product Name<span class="required"></span>
							</label>
							<div class="col-md-6">
							<?php
								echo form_input("product_name",$row['product_name']," class='form-control' placeholder='Name' required");
							?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Category</label>
							<div class="col-md-6">
							<?php
								echo form_dropdown("category_id",$printer,$row["category_id"],"class='form-control' ");
							?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">
								Product Desc<span class="required"></span>
							</label>
							<div class="col-md-8">
								<label class="control-label">
								<?php
									echo form_textarea("product_desc",$row['product_desc'],"class='form-control ckeditor' placeholder='Description' ");
								?>
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">
								Product Image<span class="required"></span>
							</label>
							<div class="col-md-4">
								<label class="control-label ">
									<button type="button" class="btn btn-sm blue" id="photo" style="font-weight:bold;">Change Image</button>
									<br/><br/>
									<div class="pt" style="display:none">
									<?php
										echo form_upload("product_image","","id='photos' class='form-control'");
									?>
										<input type="hidden" value="0" name="photo_status" id="photo_status">
									</div>
									<img src="<?php echo base_url("media/product/".$row["product_image_list"]."");?>" width="200px" >
									<br><br>
							</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">
								Product Created<span class="required"></span>
							</label>
							<div class="col-md-4">
								<label class="control-label ">
								<?php
									echo $row["created_date"];
								?>
								</label>
							</div>
						</div>
						<br/>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-12">
							<center>
								<button class="btn green" type="submit"><b>Update</b></button>
								<button class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
							</center>
						</div>
					</div>
					</form>

				</div>
			</div>
		</div>
	</div>

	<div class="col-md-5 col-sm-4">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<form action="<?php echo site_url("admin_product/update_product_image/".$this->uri->segment(3)."") ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<h3><i><b>Add More Image</b></i></h3>
					<br/>
					<?php
						$no = 1;
						$count=count($get_image);
						foreach($get_image as $row3){
					?>
					<div class="form-group">
						<label class="col-md-3 control-label">Product Image</label>
						<div class="col-md-4">
							<img src="<?php echo base_url("media/product/low/".$row3["product_image_link"]);?>" height="150px">
							<input type="hidden" name="photo_status<?php echo $no;?>" id="photo_status<?php echo $no;?>" value="0">
							<input type="hidden" name="product_image_id<?php echo $no;?>" id="" value="<?php echo $row3["product_image_id"]; ?>">
							<input type="button" value="Change Photo" class="btn blue" id="photo<?php echo $no; ?>">
							<a href="<?php echo site_url("admin_product/delete1/".$row3["product_image_id"]."/".$row3["product_id"]."");?>" onclick="return confirm('Are You Sure Delte This Product???');">
							<button type="button" class="btn red"><b>Delete</b></button>
							</a>
							<br/><br/>
							<p class="button-height inline-label pt<?php echo $no; ?>" style="display:none">
								<?php
									echo form_upload("product_thumb$no","","id='photos'");
								?>
							</p>
						</div>
					</div>

					<script>
						$(document).ready(function(){
							$("#photo<?php echo $no;?>").click(function(){
								//alert("aaa");
								var vala=$(this).attr("value");
								if(vala=="Change Photo"){
									$(".pt<?php echo $no;?>").fadeIn();
									$(this).val("Unchange Photo");
									$("#photos<?php echo $no;?>").attr("required",true);
									$("#photo_status<?php echo $no;?>").val("1");
								}else{
									$(".pt<?php echo $no;?>").hide();
									$(this).val("Change Photo");
									$("#photos<?php echo $no;?>").attr("required",false);
									$("#photo_status<?php echo $no;?>").val("0");
								}
							});
						});
					</script>
					<?php
							$no++;
						}
						
						$count=1+$count;
						for($i=$count;$i<=10;$i++){
					?>
					<div class="form-group" id='row-<?php echo $i; ?>' style="display: none;">
						<div class="col-md-12">
							<label>Product Image</label>
							<input type="file" class="form-control" name="product_image<?php echo $i ?>" placeholder="Product Image">
						</div>
					</div>    
					<?php
						}
					?>
					<p class="button-height inline-label">
						<input type="hidden" name="frist" value="<?php echo $count; ?>">
						<input type="hidden" name="images" id="photos2" value ="<?php echo $count;?>"><br>
						<center>
							<button type="button" id="addRow" class="btn" row="<?php echo $count; ?>"><b>Add More Image</b></button>
							<button type="button"  class="btn yellow mnc2 " id="cancel2" style=" display: none;"><b>Remove</b></button>
						</center>
					</p>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn green"><b>Upload</b></button>
						<button type="button" class="btn default"><b>Cancel</b></button>
					</div>
				</div>
				</form>

			</div>
		</div>
		<script>
			$(document).ready(function(){
				$("#photo").click(function(){
					//alert("aaa");
					var vala=$(this).html();
					//alert(vala);
					if(vala=="Change Image"){
						$(".pt").fadeIn();
						$(this).html("Unchange Image");
						$("#photos").attr("required",true);
						$("#photo_status").val("1");
					}else{
						$(".pt").hide();
						$(this).html("Change Image");
						$("#photos").attr("required",false);
						$("#photo_status").val("0");
					}
				});
				
				var y = $('#photos2').val();
				var yy =  parseInt($('#photos2').val());
				$('#addRow').click(function(){
					$(".mnc2").fadeIn();
					$(this).attr('disabled','disabled');
					$(this).attr('disabled','disabled');
					row = $(this).attr('row');
					$("select#event_city_id"+row).attr("required",true);
					$("input#event_city_lat"+row).attr("required",true);
					$("input#event_city_lang"+row).attr("required",true);

					$('#row-'+row).fadeIn(function(){
						row++;
						yy=yy+1;
						$('#addRow').attr('row',row);
						$('#addRow').removeAttr('disabled');
						$('#photos2').val(yy);
						//$('#admins1').val(x4);
					});
				});
			
				$('#cancel2').click(function(){
					row=$("#addRow").attr('row');
					//alert (row);
					row=row-1;
					yy=yy-1;
					//alert (y);
					//$("select#event_city_id"+row).attr("required",false);
					//$("input#event_city_lat"+row).attr("required",false);
					//$("input#event_city_lang"+row).attr("required",false);
					$("input#photos2").val(yy);
					//$("input#admins1").val(x4);
					$('#row-'+row).hide();
					if(row==y)
					{
						$(".mnc2").hide();
					}
					$('#addRow').removeAttr('disabled');
					$("#addRow").attr('row',row);
				});
			});
		</script>
	</div>
</div>