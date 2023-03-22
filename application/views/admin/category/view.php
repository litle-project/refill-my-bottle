<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url("category/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
				</div>
			
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
					<tr>
						<th>No</th>
						<th>Category Name</th>
						<th>Category Icon</th>
						<th>Category Description</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td><?php echo "<img src='".base_url()."media/category/".$data[$i]["category_icon"]."' height='80px' />";?></td>
							<td><?php echo word_limiter(strip_tags($data[$i]["category_desc"]),7);?></td>
							<!--<td><?php echo "<img src='".base_url()."media/category/".$data[$i]["category_image"]."' height='80px' />";?></td>-->
							<td>
								<a href="<?php echo site_url("category/detail/".$data[$i]["category_id"]."");?>" class="btn btn-sm default"><b>Details</b></a>
								<a href="<?php echo site_url("category/edit/".$data[$i]["category_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
								<a href="<?php echo site_url("category/delete/".$data[$i]["category_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["category_name"];?> from <?php echo $title;?> table? ')"><b>Delete</b></a>
							</td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
