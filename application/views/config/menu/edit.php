<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
			<br/>
		</div>
	</div>
	<div class="col-md-12 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>
				<form class="form-horizontal" action="<?php echo site_url("config/menu_edit") ?>" method="post">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Name</label>
						<div class="col-md-4">
							<input type="hidden" name="menu_id"  value="<?php echo $data[0]["menu_id"] ;?>" >
							<textarea class="form-control" name="menu_name" placeholder="menu_name" value="" required><?php echo $data[0]["menu_name"] ;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Description</label>
						<div class="col-md-4">
							<textarea class="form-control" name="menu_desc" placeholder="title" value=""><?php echo $data[0]["menu_desc"] ;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Group Menu</label>
						<div class="col-md-4">
							<?php
                                echo form_dropdown("group_menu_id",$group,$data[0]["group_menu_id"],"required id='group' class='form-control'");
                            ?>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">Menu URL</label>
						<div class="col-md-4">
							<textarea class="form-control" name="menu_url" placeholder="menu_url" value="" required><?php echo $data[0]["menu_url"] ;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Menu View</label>
						<div class="col-md-4">
							<input type="checkbox" checked="checked" name="menu_view" disabled="disabled">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Add</label>
						<div class="col-md-4">
							<?php
								$menu_add=$data[0]["menu_add"];
								$add="";
								if($menu_add=="1"){
									$add='checked="checked"';
								}
							?>
							<input type="checkbox" <?php echo $add; ?> name="menu_add" value="1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Edit</label>
						<div class="col-md-4">
							<?php
								$menu_add=$data[0]["menu_edit"];
								$add="";
								if($menu_add=="1"){
									$add='checked="checked"';
								}
							?>
							<input type="checkbox" <?php echo $add; ?> name="menu_edit" value="1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Delete</label>
						<div class="col-md-4">
							<?php
								$menu_add=$data[0]["menu_delete"];
								$add="";
								if($menu_add=="1"){
									$add='checked="checked"';
								}
							?>
							<input type="checkbox" <?php echo $add; ?> name="menu_delete" value="1">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">Menu Other</label>
						<div class="col-md-4">
							<?php
								$menu_add=$data[0]["menu_other"];
								$add="";
								if($menu_add=="1"){
									$add='checked="checked"';
								}
							?>
							<input type="checkbox" <?php echo $add; ?> name="menu_other" value="1">
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue">Submit</button>
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_privileges");?>'">Cancel</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>