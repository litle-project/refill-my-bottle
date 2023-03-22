<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
			<br/>
		</div>
	</div>
	<div class="col-md-8 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>
				<form class="form-horizontal" action="<?php echo site_url("config/group_edit") ?>" method="post">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Group Menu Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="group_menu_name" placeholder="group_menu_name" value="<?php echo $data[0]["group_menu_name"]; ?>" required>
								<input type="hidden" class="form-control" name="group_menu_id" placeholder="group_menu_id" value="<?php echo $data[0]["group_menu_id"]; ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Group Menu Desc</label>
							<div class="col-md-6">
								<textarea class="form-control" name="group_menu_desc" placeholder="group_menu_desc" value="" required><?php echo $data[0]["group_menu_desc"]; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Group Menu Icon</label>
							<div class="col-md-6">
								<select class="form-control" name="icon" style="font-family:'FontAwesome','Weeblysleek';">
									<option value="">No Icon</option>
									<option value="fa-archive">&#xf187; &nbsp;&nbsp;Archive</option>
									<option value="fa-ambulance">&#xf0f9; &nbsp;&nbsp;Ambulance</option>
									<option value="fa-area-chart">&#xf1fe; &nbsp;&nbsp;Area Chart</option>
									<option value="fa-android">&#xf17b; &nbsp;&nbsp;Android</option>
									<option value="fa-apple">&#xf179; &nbsp;&nbsp;Apple</option>
									<option value="fa-automobile">&#xf1b9; &nbsp;&nbsp;Automobile</option>
									<option value="fa-balance-scale">&#xf24e; &nbsp;&nbsp;Balance Scale</option>
									<option value="fa-bank">&#xf19c; &nbsp;&nbsp;Bank</option>
									<option value="fa-bars">&#xf0c9; &nbsp;&nbsp;Bars</option>
									<option value="fa-bed">&#xf236; &nbsp;&nbsp;Bed</option>
									<option value="fa-bar-chart">&#xf080; &nbsp;&nbsp;Bar Chart</option>
									<option value="fa-bell">&#xf0f3; &nbsp;&nbsp;Bell</option>
									<option value="fa-bell-o">&#xf0a2; &nbsp;&nbsp;Bell Line</option>
									<option value="fa-bookmark">&#xf02e; &nbsp;&nbsp;Bookmark</option>
									<option value="fa-bookmark-o">&#xf097; &nbsp;&nbsp;Bookmark Line</option>
									<option value="fa-bullhorn">&#xf0a1; &nbsp;&nbsp;Bullhorn</option>
									<option value="fa-bicycle">&#xf206; &nbsp;&nbsp;Bicycle</option>
									<option value="fa-bitcoin">&#xf15a; &nbsp;&nbsp;Bitcoin</option>
									<option value="fa-book">&#xf02d; &nbsp;&nbsp;Book</option>
									<option value="fa-briefcase">&#xf0b1; &nbsp;&nbsp;Briefcase</option>
									<option value="fa-building">&#xf1ad; &nbsp;&nbsp;Building</option>
									<option value="fa-building-o">&#xf0f7; &nbsp;&nbsp;Building Line</option>
									<option value="fa-bullseye">&#xf140; &nbsp;&nbsp;Bullseye</option>
									<option value="fa-cab">&#xf1ba; &nbsp;&nbsp;Cab</option>
									<option value="fa-camera">&#xf030; &nbsp;&nbsp;Camera</option>
									<option value="fa-caculator">&#xf1ec; &nbsp;&nbsp;Calculator</option>
									<option value="fa-calendar">&#xf073; &nbsp;&nbsp;Calendar</option>
									<option value="fa-calendar-check-o">&#xf274; &nbsp;&nbsp;Calendar Check</option>
									<option value="fa-calendar-times-o">&#xf273; &nbsp;&nbsp;Calendar Times</option>
									<option value="fa-calendar-minus-o">&#xf272; &nbsp;&nbsp;Calendar Minus</option>
									<option value="fa-calendar-plus-o">&#xf271; &nbsp;&nbsp;Calendar Plus</option>
									<option value="fa-car">&#xf1b9; &nbsp;&nbsp;Car</option>
									<option value="fa-check">&#xf00c; &nbsp;&nbsp;Check</option>
									<option value="fa-check-square">&#xf14a; &nbsp;&nbsp;Check Square</option>
									<option value="fa-circle">&#xf111; &nbsp;&nbsp;Circle</option>
									<option value="fa-circle-o">&#xf10c; &nbsp;&nbsp;Circle Line</option>
									<option value="fa-cloud">&#xf0c2; &nbsp;&nbsp;Cloud</option>
									<option value="fa-cog">&#xf013; &nbsp;&nbsp;Cog</option>
									<option value="fa-cogs">&#xf085; &nbsp;&nbsp;Cogs</option>
									<option value="fa-comment">&#xf075; &nbsp;&nbsp;Comment</option>
									<option value="fa-commenting">&#xf27a; &nbsp;&nbsp;Commenting</option>
									<option value="fa-comments">&#xf086; &nbsp;&nbsp;Comments</option>
									<option value="fa-copy">&#xf0c5; &nbsp;&nbsp;Copy</option>
									<option value="fa-credit-card">&#xf09d; &nbsp;&nbsp;Credit Card</option>
									<option value="fa-database">&#xf1c0; &nbsp;&nbsp;Database</option>
									<option value="fa-desktop">&#xf108; &nbsp;&nbsp;Desktop</option>
									<option value="fa-diamond">&#xf219; &nbsp;&nbsp;Diamond</option>
									<option value="fa-download">&#xf019; &nbsp;&nbsp;Download</option>
									<option value="fa-edit">&#xf044; &nbsp;&nbsp;Edit</option>
									<option value="fa-envelope">&#xf0e0; &nbsp;&nbsp;Envelope</option>
									<option value="fa-envelope-o">&#xf003; &nbsp;&nbsp;Envelope Line</option>
									<option value="fa-external-link">&#xf08e; &nbsp;&nbsp;External Link</option>
									<option value="fa-file">&#xf15b; &nbsp;&nbsp;File</option>
									<option value="fa-file-o">&#xf016; &nbsp;&nbsp;File Line</option>
									<option value="fa-file-text">&#xf15c; &nbsp;&nbsp;File Text</option>
									<option value="fa-file-text-o">&#xf0f6; &nbsp;&nbsp;File Text Line</option>
									<option value="fa-folder-open">&#xf07c; &nbsp;&nbsp;Folder</option>
									<option value="fa-folder-open-o">&#xf115; &nbsp;&nbsp;Folder Line</option>
									<option value="fa-heart">&#xf004; &nbsp;&nbsp;Heart</option>
									<option value="fa-history">&#xf1da; &nbsp;&nbsp;History</option>
									<option value="fa-home">&#xf015; &nbsp;&nbsp;Home</option>
									<option value="fa-image">&#xf03e; &nbsp;&nbsp;Image</option>
									<option value="fa-inbox">&#xf01c; &nbsp;&nbsp;Inbox</option>
									<option value="fa-info-circle">&#xf05a; &nbsp;&nbsp;Info</option>
									<option value="fa-key">&#xf084; &nbsp;&nbsp;Key</option>
									<option value="fa-laptop">&#xf109; &nbsp;&nbsp;Laptop</option>
									<option value="fa-life-ring">&#xf1cd; &nbsp;&nbsp;Life Ring</option>
									<option value="fa-line-chart">&#xf201; &nbsp;&nbsp;Line Chart</option>
									<option value="fa-list">&#xf03a; &nbsp;&nbsp;List</option>
									<option value="fa-link">&#xf0c1; &nbsp;&nbsp;Link</option>
									<option value="fa-lock">&#xf023; &nbsp;&nbsp;Lock</option>
									<option value="fa-map-marker">&#xf041; &nbsp;&nbsp;Map Marker</option>
									<option value="fa-map-o">&#xf278; &nbsp;&nbsp;Map</option>
									<option value="fa-microphone">&#xf130; &nbsp;&nbsp;Microphone</option>
									<option value="fa-minus">&#xf146; &nbsp;&nbsp;Minus</option>
									<option value="fa-motorcycle">&#xf21c; &nbsp;&nbsp;Motorcycle</option>
									<option value="fa-paper-plane">&#xf1d8; &nbsp;&nbsp;Paper Plane</option>
									<option value="fa-phone-square">&#xf098; &nbsp;&nbsp;Phone</option>
									<option value="fa-pie-chart">&#xf200; &nbsp;&nbsp;Pie Chart</option>
									<option value="fa-plus-square">&#xf0fe; &nbsp;&nbsp;Plus</option>
									<option value="fa-print">&#xf02f; &nbsp;&nbsp;Print</option>
									<option value="fa-question-circle">&#xf059; &nbsp;&nbsp;Question</option>
									<option value="fa-rocket">&#xf135; &nbsp;&nbsp;Rocket</option>
									<option value="fa-save">&#xf0c7; &nbsp;&nbsp;Save</option>
									<option value="fa-search">&#xf002; &nbsp;&nbsp;Search</option>
									<option value="fa-server">&#xf233; &nbsp;&nbsp;Server</option>
									<option value="fa-shield">&#xf132; &nbsp;&nbsp;Shield</option>
									<option value="fa-shopping-basket">&#xf291; &nbsp;&nbsp;Shopping Basket</option>
									<option value="fa-shopping-cart">&#xf07a; &nbsp;&nbsp;Shopping Cart</option>
									<option value="fa-spinner">&#xf110; &nbsp;&nbsp;Spinner</option>
									<option value="fa-square">&#xf0c8; &nbsp;&nbsp;Square</option>
									<option value="fa-star">&#xf005; &nbsp;&nbsp;Star</option>
									<option value="fa-sticky-note">&#xf249; &nbsp;&nbsp;Sticky Note</option>
									<option value="fa-tachometer">&#xf0e4; &nbsp;&nbsp;Tachometer</option>
									<option value="fa-tags">&#xf02c; &nbsp;&nbsp;Tags</option>
									<option value="fa-trash">&#xf1f8; &nbsp;&nbsp;Trash</option>
									<option value="fa-user">&#xf007; &nbsp;&nbsp;User</option>
									<option value="fa-group">&#xf0c0; &nbsp;&nbsp;Users</option>
									<option value="fa-video-camera">&#xf03d; &nbsp;&nbsp;Video Camera</option>
									<option value="fa-warning">&#xf071; &nbsp;&nbsp;Warning</option>
									<option value="fa-wrench">&#xf0ad; &nbsp;&nbsp;Wrench</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn blue">Update</button>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_privileges");?>'">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>