<script>
	$(document).ready(function(){
		//alert("a");
		$("#submit").click(function(){
			var ps1=$("#pass1").val();
			var ps2=$("#pass2").val();
			if(ps1==ps2){
				return true;
			}else{
				alert("password not same");
				return false;
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
				$("#rest").val("");
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

						<form class="form-horizontal" action="<?php echo site_url("admin_user/add") ?>" method="post" enctype='multipart/form-data'>
						<div class="form-body">	
							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Username</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("username","","required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Password</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_password("password1","","id='pass1' required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Confirm Password</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_password("password2","","id='pass2' required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Name</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("name","","required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Email</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_input("email","","required class='form-control input full-width'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">Photo<br/><small>(300x300px)</small></label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_upload("photo","","required class='form-control'"); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-sm-3 control-label">User Group Privileges</label>
								<div class="col-md-6 col-sm-6">
									<?php echo form_dropdown("priv",$priv,"","required class='form-control' id='priv'"); ?>
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