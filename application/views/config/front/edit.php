<?php //print_r($data);?>

<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
		<form class="form-horizontal" action="<?php echo site_url("config/front_edit") ?>" method="post">
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">index_id</label>
									<div class="col-md-4">
										<input type="text" value="<?php echo $data["0"]["index_id"] ?>" disabled>
										<textarea class="form-control" style="display:none;" name="index_id" placeholder="index_id" value="" required><?php echo $data["0"]["index_id"] ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">title</label>
									<div class="col-md-4">
										<textarea class="form-control" name="title" placeholder="title" value="" required><?php echo $data["0"]["title"] ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">description</label>
									<div class="col-md-4">
										<textarea class="form-control" name="description" placeholder="description" value="" required><?php echo $data["0"]["description"] ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">keyword</label>
									<div class="col-md-4">
										<textarea class="form-control" name="keyword" placeholder="keyword" value="" required><?php echo $data["0"]["keyword"] ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">url</label>
									<div class="col-md-4">
										<textarea class="form-control" name="url" placeholder="url" value="" required><?php echo $data["0"]["url"] ?></textarea>
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
	</div>
</div>				