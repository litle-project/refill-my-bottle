<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assets/img/logorefill/logoku.jpeg"/>
	<link rel="icon" href="<?php echo base_url();?>assets/img/logorefill/logoku.jpeg" sizes="32x32">
	<h1><title>RefillMyBottle - Change Password</title></h1>
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/site/css/dashboard2.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>  -->
	<script src="<?php echo base_url();?>assets/js/ckeditor/ckeditor.js"></script> 
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">	
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font.css"/>
	<link rel="icon" href="<?php echo base_url();?>assets/img/logorefill/logoku.jpeg" sizes="32x32">

	<!-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'> -->
	
	<!-- BEGIN THEME STYLES -->
	
	<link href="<?php echo base_url();?>assets/css/style-codelabs.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>

	<script>
		$(document).ready(function(){
			$(".changePass").click(function(){
				var pass1 = $(".pass1").val();
				var pass2 = $(".pass2").val();

				if(pass1.length<6){
					$(".errCon1").fadeIn(300);
					return false;
				} else if(pass1 != pass2){
					$(".errCon").fadeIn(300);
					return false;
				} else {
					return true;
				}

			});
		});
	</script>
	<script>
	$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Password Matching').css('color', 'green');
  } else 
    $('#message').html('Confrim Password Not Matching with password').css('color', 'red');
});


</script>
</head>
<body style="background-color:#404040; border-collapse:collapse; border-radius: 10px;">
	<div class="container"style="background-color:#404040;">
		<div class="row">
			<div class="col-sm-12" style="margin-top:80px;">
				<div class="row">
					<div class="col-sm-12 col-sm-offset-12">
			<div class="col-xs-12 text-center"style="background-color:#404040; ">
				<center><div style="alignment-baseline: central;">
							<center>
								<img width="200px" src="<?php echo base_url("media/config/logo_2x1.png");?>">
							</center>
						<br><br>
						</div></center>
			</div>
		</div>
		<div class="col-sm-12 col-sm-offset-12 bdr-ddd bdr-radius-5px mgtop20px">
			<div class="login box">
				<div class="box-header">
								Change Password
							</div>
							<div class="box-content">
			<div class="form-group">
				<form method="POST" action="<?php echo base_url();?>api/changePassword/changePasswordSubmit">
					<input type="hidden" name="MEMBER_ID" value="<?php echo @$_GET['id'];?>" />
					<input type="hidden" name="HASH" value="<?php echo @$_GET['hash'];?>" />

					<div class="col-xs-12 pd0px mgbottom10px mgtop10px">
						<p><b>New Password</b></p>
						<input type="password" class="form-control pass1" id="password" name="PASSWORD1" minlength="6" required />
						<p class="color-red font12px">&nbsp;<span class="ds-none errCon1">password must be more than 6 digits</span></p>
					</div>

					<div class="col-xs-12 pd0px mgbottom10px mgtop10px">
						<p><b>Confirm Password</b></p>
						<input type="password" class="form-control pass2" id="confirm_password" name="PASSWORD2" required />
						<span id='message'></span>
						<p class="color-red font12px">&nbsp;<span class="ds-none errCon">Confirm password must be the same as password</span></p>
					</div>
					<div class="col-xs-12 pd0px mgbottom20px mgtop10px">
						
						<button type="submit" class="btn btn-primary btn-block btn-lg" id="save" disabled><span>Change</span></button>
					</div>
				</form>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
	  // $("#save").prop("disabled", true);
	$('#password, #confirm_password').on('keyup', function () {

		if ($('#password').val() == $('#confirm_password').val()) {
     // $("#save").prop("disabled", false);
			$('#message').html('Password Matching').css('color', 'green');
		    $('#save').removeAttr('disabled');
  		}else{
		    $('#message').html('Confirm Password Not Matching with password').css('color', 'red');
		    $('#save').attr('disabled', 'disabled');
		}
	});

</script>
<script>
	$('#password').on('blur', function(){
	    if(this.value.length < 6){ // checks the password value length
	       alert('You have entered less than 5 characters for password');
	       // $(this).focus(); // focuses the current field.
	       // return false; // stops the execution.
		    $('#save').attr('disabled', 'disabled');
	    }else{
		    $('#save').removeAttr('disabled');
	    }
	});
</script>
</body>
</html>

				
                            