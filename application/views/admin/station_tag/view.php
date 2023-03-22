<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
				</div>
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Tag Name</th>
							<th>Tag Desc</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
							$big = $data[$i]["tag_desc"];
							$small = substr($big, 0, 90);
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["tag_name"];?></td>
							<td><?php echo $data[$i]['tag_desc'];?></td>
							<td>
								<!-- <a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["tag_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a> -->
								<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["tag_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["tag_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["tag_name"];?> from product table? ')"><b>Delete</b></a>
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