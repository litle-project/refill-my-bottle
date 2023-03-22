
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title>Menu - MyDynEd Dashboard</title>

	<!-- Javascript and Stylesheet -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/site/css/dashboard.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script> 
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		
		
		
	
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- BEGIN THEME STYLES -->
	
	<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END THEME STYLES -->
	
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#dashboard">Dashboard</a>
			</div>
			<!-- <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>
					<li><a href="#dashboard/assessment">Assessment</a></li>
					<li><a href="#">Solutions</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">View Site</a></li>
				</ul>
			</div> --><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container-fluid">

		<div class="row">
			<div class="col-xs-12 col-lg-2">
				
				<div class="box">
					<div class="box-content">
						
                                                <strong>Administrator</strong><br>
                                                					</div>
				</div>
				
				
					<div class="page-sidebar-wrapper">
						
						<div class="box">
							<div class="box-content">
								<img src="http://icons.iconarchive.com/icons/double-j-design/origami-colored-pencil/256/blue-user-icon.png" class="img-polaroid" style="float: left; margin-right: 10px; height: 50px; width: 45px;">
								
								<strong>Administrator</strong><br>
								MyDynEd                                                
								<br>
								<a href="#logout">Logout</a>
							</div>
						</div>
						
						
						
						
					<div class="page-sidebar navbar-collapse collapse">
						<!-- BEGIN SIDEBAR MENU -->
						<ul class="page-sidebar-menu">
							
							<li class="sidebar-toggler-wrapper" style="display:none;">
								<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
								<div class="sidebar-toggler hidden-phone">
								</div>
								<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
							</li>
							
							<li class="start active ">
								<a href="index.html">
								<i class="fa fa-home"></i>
								<span class="title">
									Dashboard
								</span>
								<span class="selected">
								</span>
								</a>
							</li>
							<li class="">
								<a href="index_horizontal_menu.html">
								<i class="fa fa-briefcase"></i>
								<span class="title">
									Dashboard 2
								</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
								<i class="fa fa-cogs"></i>
								<span class="title">
									Layouts
								</span>
								<span class="arrow ">
								</span>
								</a>
								<ul class="sub-menu">
									<li>
										<a href="layout_session_timeout.html">
										<span class="badge badge-roundless badge-important">
											new
										</span>
										Session Timeout</a>
									</li>
									<li>
										<a href="layout_idle_timeout.html">
										<span class="badge badge-roundless badge-important">
											new
										</span>
										User Idle Timeout</a>
									</li>
									<li>
										<a href="layout_language_bar.html">
										Language Switch Bar</a>
									</li>
									<li>
										<a href="layout_horizontal_sidebar_menu.html">
										Horizontal & Sidebar Menu</a>
									</li>
									
								</ul>
							</li>
							
							<li class="">
								<a href="javascript:;">
								<i class="fa fa-user"></i>
								<span class="title">
									Login Options
								</span>
								<span class="arrow ">
								</span>
								</a>
								<ul class="sub-menu">
									<li>
										<a href="login.html">
										Login Form 1</a>
									</li>
									<li>
										<a href="login_soft.html">
										Login Form 2</a>
									</li>
								</ul>
							</li>
							
						</ul>
						<!-- END SIDEBAR MENU -->
					</div>
	</div>
				

				<div class="footer">
					&copy; 2014 DynEd International. All Rights reserved. Elapsed time 0.0399 secs with 2.39MB MB

				</div>

			</div>
			<div class="col-xs-12 col-lg-10">
				
								<div class="box">
	<div class="box-header">
		Menu
	</div>
	<div class="box-content">
		<ul class="nav nav-tabs">
			<li class="active"> <a href="#menu">Menu</a></li>
			<li><a href="#menu/list_menu/1">Role Menu</a></li>
		</ul>
		<a href="#menu/add" class="btn btn-success btn-sm pull-right" style="margin-bottom: 10px; margin-top: 10px;">Add New</a>
		
						
		<table></table>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				<tr>
					<th>
						#
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						1
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				<tr>
					<td>
						2
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				<tr>
					<td>
						3
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		
		
		
		
	</div>
</div>			</div>
		</div>

		

	</div>

	<!-- Javascript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function confirm_delete() {
			return confirm("Are you sure you want to delete this entry?");
		}
	</script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
	<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script>
<![endif]-->

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<!--<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<script src="assets/scripts/app.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   
});
</script>
        </body>
</html>
