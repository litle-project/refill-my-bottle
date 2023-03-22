<br>
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
						<?php
							$row = $get_data[0];
						?>
						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								
								<div class="form-group">
									<label class="col-md-3 control-label">Member No</label>
									<div class="col-md-4">
										<?php
											echo form_input("member_no",$row["member_no"],"class='form-control' placeholder='Member No' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Member Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("member_name",$row["member_name"],"class='form-control' placeholder='Member Name' required");
										?>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Member Gender</label>
									<div class="col-md-4">
										<?php
											$gender=array("" => "Please Select","M"=>"Male","F"=>"Female");
											echo form_dropdown("member_gender",$gender,$row["member_gender"],"class='form-control' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Member DOB</label>
									<div class="col-md-4">
										<script>
											$(document).ready(function(){
												$( "#dob" ).datepicker({
													dateFormat : 'yy-mm-dd',
													changeMonth: true,
													changeYear: true,
													maxDate:0,
												});
											});
										</script>
										<?php
											echo form_input("member_dob",$row["member_dob"],"class='form-control' id='dob' placeholder='Member DOB' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Member Email</label>
									<div class="col-md-4">
										<?php
											echo form_input("member_email",$row["member_email"],"class='form-control' placeholder='Member Email' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Member Telp</label>
									<div class="col-md-4">
										<?php
											echo form_input("member_telp",$row["member_telp"],"class='form-control' placeholder='Member Telp' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Member Address</label>
									<div class="col-md-4">
										<?php
											echo form_textarea("member_address",$row["member_address"],"class='form-control' placeholder='Member Address' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Member Photo</label>
									<div class="col-md-4">
										<img src="<?php echo base_url("media/member/low/".$row["member_photo"]."");;?>" width="200px">
										<br>
										<br>
										
										<button type="button" class="btn green" id="photo">Change Image</button>
										
										<br>
										<br>
										<div class="pt" style="display:none">
										<?php
											echo form_upload("member_photo","","id='photos' class='form-control'");
										?>
										<input type="hidden" value="0" name="photo_status" id="photo_status">
										</div>
									</div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>&nbsp;&nbsp;&nbsp;
									<button type="reset" class="btn red"  id="reset">Reset</button>&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
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

<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
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
	});
</script>		