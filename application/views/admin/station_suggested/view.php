<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<!-- <div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
				</div> -->
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Suggest By</th>
							<th>Station Name</th>
							<th>Station Type</th>
							<th>Station Category</th>
							<!-- <th>Member Photo</th> -->
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
							<td><?php echo $data[$i]["first_name"];?></td>
							<td><?php echo $data[$i]["station_name"];?></td>
							<td><?php echo $data[$i]["name_type"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<!-- <td> <img src="<?php echo base_url("media/station/suggested/".$data[$i][0]["suggest_image"]."");?>"></td> -->
							<!-- <td><img src="<?php echo base_url()."media/partner/".$data[$i]["station_id"]; ?>"  height="80px" /></td> -->
							<!--<td><img src="<?php //echo base_url("media/member/low/".$data[$i]["member_image"]."");?>" width="100px"></td>-->
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["suggest_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<!-- <a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["suggest_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a> -->
							<!-- <a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["suggest_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["first_name"];?> from product table? ')"><b>Delete</b></a> -->
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