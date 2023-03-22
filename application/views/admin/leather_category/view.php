<?php
//echo "<pre>";
//print_r($data);
//echo "</pre>";

?>
<br>
<div class="col-md-12">
	<div class="portlet box yellow">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-edit"></i><?php echo $title;?>
			</div>
			<div class="tools">
				
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
			<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_leather_category/add");?>'"> Add New <i class="fa fa-plus"></i>
									</button>
			</div>
			
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
				<thead>
				<tr>
					<th>No</th>
					<th>Leather Category Name</th>
					<th>Leather Category Icon</th>
					<th>Leather Category Description</th>
					<!--<th>Category Icon Mobile</th>-->	
					<!--<th>Member Photo</th>-->
					<th>Actions</th>


				</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
								<td><?php echo $no;?></td>
								<td><?php echo $data[$i]["leather_category_name"];?></td>
								<td><?php echo "<img src='".base_url()."media/category/".$data[$i]["leather_category_icon"]."' height='80px' />";?></td>															
								<td><?php echo word_limiter(strip_tags($data[$i]["leather_category_desc"]),7);?></td>
								<!--<td><?php echo "<img src='".base_url()."media/category/".$data[$i]["leather_category_image"]."' height='80px' />";?></td>-->															
								<td>
									<a href="<?php echo site_url("admin_leather_category/edit/".$data[$i]["leather_category_id"]."");?>" class="btn green">Edit</a>
									<a href="<?php echo site_url("admin_leather_category/delete/".$data[$i]["leather_category_id"]."");?>" class="btn red" onclick="return confirm('Are you sure you want to delete ? ')">Delete</a>
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
	<!-- END EXAMPLE TABLE PORTLET-->
</div>
