
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title>Login - CodeLabs</title>

	<!-- Javascript and Stylesheet -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/site/css/dashboard.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script> 
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12" style="margin-top:80px;">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<div>
															</div>
							<div class="login box">
								<div class="box-header">
									Login to Dashboard
								</div>
								<div class="box-content">
                                                                        																		<form action="http://cms.pistarlabs.net/index.php/login" method="post" accept-charset="utf-8">										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" name="username" value="" placeholder="Your Username" class="col-xs-12 form-control" />										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="password" value="" placeholder="Your Password" class="col-xs-12 form-control" />										</div>
										<label class="checkbox"><input type="checkbox" name="remember"> Keep me sign in</label>
										<input type="submit" name="__submit" value="Sign In" class="btn btn-primary btn-block btn-lg" />									</form>								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			</body>
</html>