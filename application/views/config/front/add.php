<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>
				<form class="form-horizontal" action="<?php echo site_url("config/front_add") ?>" method="post">
				<div class="form-body">
							
					<div class="form-group">
						<label class="col-md-3 control-label">index_id</label>
						<div class="col-md-8">
							<textarea class="form-control" name="index_id" placeholder="index_id" value="" required></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">title</label>
						<div class="col-md-8">
							<textarea class="form-control" name="title" placeholder="title" value="" required></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">description</label>
						<div class="col-md-8">
							<textarea class="form-control" name="description" placeholder="description" value="" required></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">keyword</label>
						<div class="col-md-8">
							<textarea class="form-control" name="keyword" placeholder="keyword" value="" required></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">url</label>
						<div class="col-md-8">
							<textarea class="form-control" name="url" placeholder="url" value="" required></textarea>
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