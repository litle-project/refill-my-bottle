<!DOCTYPE html>
<?php
	$this->db->select("logo");
	$this->db->select("loginimg");
	$query = $this->db->get("config")->result_array();
	$logo = $query[0]['logo'];
	$loginimg = $query[0]['loginimg'];
?>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title>Login Admin RefillMyBottle </title>

	<!-- Javascript and Stylesheet -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/site/css/dashboard.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script> 
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
        	  <?php if($this->session->flashdata('error')){?>
        	<script>
        		
        		alert("<?php echo $this->session->flashdata('error'); ?>")
        	</script>
        	 <?php }?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font.css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link href="<?php echo base_url();?>assets/css/style-codelabs.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link rel="icon" href="<?php echo base_url();?>assets/img/logorefill/logoku.jpeg" sizes="32x32">

</head>
<body style="background:#ececec url('<?php echo base_url("assets/site/img") . "/" . $loginimg?>');background-attachment:fixed;background-size:cover;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12" style="margin-top:80px;">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						<div style="alignment-baseline: central;">
							<center>
								<img width="200px" src="<?php echo base_url("media/config") . "/" . $logo?>">
							</center>
						<br><br>
						</div>
						<div class="login box">
							<div class="box-header">
								Sign in to your account
							</div>
							<div class="box-content">
                                <form action="<?php echo site_url("login_admin/login_check");?>" method="post" accept-charset="utf-8">					
                                <div class="form-group">
									<label for="username">Username</label>
									<input type="text" name="username" value="admin" placeholder="Your username" class="col-xs-12 form-control" required />
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="password" value="123456" placeholder="Your password" class="col-xs-12 form-control" required />
								</div>
								<label class="checkbox"><input type="checkbox" name="remember"><b><i>Keep me signed in</i></b></label>
								<input type="submit" name="__submit" value="Sign In" class="btn btn-primary btn-block btn-lg" />
                                </form>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>