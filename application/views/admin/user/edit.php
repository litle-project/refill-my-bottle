<?php
	$row=$get_user[0];
?>

<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		<?php
			if($row["user_group_id"]>1):
			?>
				$("#res").fadeIn();
				$("#rest").attr("required","true");
			<?php
			endif;
		?>
		//alert("a");
		$("#submit").click(function(){
			var ps1=$("#pass1").val();
			var ps2=$("#pass2").val();
			var st = $("#pass_status").val();
			if (st==1) {
				if(ps1==ps2){
					return true;
				}else{
					alert("password not same");
					return false;
				}
			}
		});

		$("#pass").click(function(){
			var vala=$(this).attr("value");
			if(vala=="Change Password"){
				$(".ps1").fadeIn();
				$(this).val("Unchange Password");
				$("#pass1").attr("required",true);
				$("#pass2").attr("required",true);
				$("#pass_status").val("1");
			}else{
				$(".ps1").hide();
				$(this).val("Change Password");
				$("#pass1").attr("required",false);
				$("#pass2").attr("required",false);
				$("#pass_status").val("0");
			}
		});
		
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

		$("#priv").change(function(){
			//alert("a");
			var a=$(this).val();
			if(a>1){
				$("#res").fadeIn();
				$("#rest").attr("required","true");
				
			}else{
				$("#res").hide();
				$("#rest").attr("required","false");
			}
		});
	});
</script>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">User list</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-lg-7 col-md-7 col-sm-10">
		<br/>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box grey">
					<div class="portlet-body form">
						<br/>
						<form class="form-horizontal" action="<?php echo site_url("admin_user/edit/" . $row["admin_id"]) ?>" method="post" enctype='multipart/form-data'>
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Username</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("username",$row["admin_username"],"required class='form-control input full-width'"); ?>  
								</div>
							</div>

							<div class="form-group ps1" style="display:none">
								<label class="col-md-4 col-sm-3 control-label">Password</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_password("password1","","id='pass1' class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group ps1" style="display:none">
								<label class="col-md-4 col-sm-3 control-label">Confirm Password</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_password("password2","","id='pass2' class='form-control input full-width'"); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label"></label>
								<div class="col-md-6 col-sm-6">
									<input type="hidden" name="pass_status" id="pass_status" value="0">
									<input type="button" value="Change Password" class="btn blue-gradient" id="pass" style="font-weight: bold;">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Name</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("name",$row["admin_name"],"required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Email</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("email",$row["admin_email"],"required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Photo<br/><small>(300x300px)</small></label>
								<div class="col-md-6 col-sm-6">
									<img src="<?php echo base_url("media/user/".$row["admin_photo"]);?>" width="150px" height="150px">
									<input type="hidden" name="photo_status" id="photo_status" value="0">
									<input type="button" value="Change Photo" class="btn blue-gradient" id="photo" style="font-weight: bold;">
									<p class="button-height inline-label pt" style="display:none">
										<?php echo form_upload("photo","","id='photos'"); ?>
									</p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">User Group Privileges</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_dropdown("priv",$priv,$row["user_group_id"],"required id='priv' class='form-control'"); ?>
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
	</div>
</div>