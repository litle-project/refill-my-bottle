<br>
<?php
$row=$data[0];
//echo "<pre>";
//print_r($promo);
//echo "</pre>";
?>
<div class="row">
	<div class="col-md-12">
		<div class="tab-sliding">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="<?php echo base_url().'admin_leather_category/update'; ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<input type="hidden" name="id" value="<?php echo $row['leather_category_id']; ?>" />
								
								<div class="form-group">
									<label class="col-md-3 control-label">Category Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("leather_category_name",$row['leather_category_name'],"class='form-control' placeholder='Name' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Category Description</label>
									<div class="col-md-4">
										<?php
											echo form_input("leather_category_desc",$row['leather_category_desc'],"class='form-control ckeditor' placeholder='Description' required");
										?>
									</div>
								</div>
								
								<!--<div class="form-group">
									<label class="col-md-3 control-label">Promo</label>
									<div class="col-md-4">
										<?php											
											echo form_dropdown("promo_id",$promo,$row['promo_id'],"class='form-control' ");
										?>
									</div>
								</div>-->
								
								<div class="form-group">
										<label class="control-label col-md-3">Category Icon
										<span class="required">
												
										</span>
										</label>
										<div class="col-md-4">
											<label class="control-label ">
												<button type="button" class="btn green" id="photo">Change Image</button>
												
												<br>
												<br>
												<div class="pt" style="display:none">
												<?php
													echo form_upload("leather_category_icon","","id='photos' class='form-control'");
												?>
												<input type="hidden" value="0" name="photo_status" id="photo_status">
												<br>
												</div>
												<img src="<?php echo base_url("media/category/".$row["leather_category_icon"]."");?>" width="120px" style='border:2px solid black; '>
												<br>
												<br>
												
												
											</label>    
										</div>
								</div>
								
								<!--<div class="form-group">
										<label class="control-label col-md-3">Category Icon Mobile
										<span class="required">
												
										</span>
										</label>
										<div class="col-md-4">
											<label class="control-label ">
												<button type="button" class="btn green" id="photo2">Change Image</button>
												
												<br>
												<br>
												<div class="pt2" style="display:none">
												<?php
													echo form_upload("leather_category_image","","id='photos2' class='form-control'");
												?>
												<input type="hidden" value="0" name="photo_status2" id="photo_status2">
												<br>
												</div>
												<img src="<?php echo base_url("media/category/".$row["leather_category_image"]."");?>" width="120px" style='border:2px solid black; '>
												<br>
												<br>
												
												
											</label>    
										</div>
								</div>-->
															
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>&nbsp;&nbsp;&nbsp;
									<button type="reset" class="btn red"  id="reset" onclick="window.history.back()">Back</button>&nbsp;&nbsp;&nbsp;
									<!--
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
									-->
								</div>
							</div>
						</form> 
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
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
					
					$("#photo2").click(function(){
						
						//alert("aaa");
						var vala=$(this).html();
						//alert(vala);
						if(vala=="Change Image"){
							$(".pt2").fadeIn();
							$(this).html("Unchange Image");
							$("#photos2").attr("required",true);
							$("#photo_status2").val("1");
						}else{
							$(".pt2").hide();
							$(this).html("Change Image");
							$("#photos2").attr("required",false);
							$("#photo_status2").val("0");
						}
					});
				});
			</script>		