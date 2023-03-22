<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
					<button class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/import");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Import Excel</b></button>
				</div>
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Station Name</th>
							<th>Station Phone</th>
							<th>Open Hour</th>
							<th>Close Hour</th>
							<th>Uniq Number</th>
							<!-- <th>Member Photo</th> -->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					

						$empty = 0;
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						
						// if (!empty($rating)) {
						// 	foreach ($rating as $key) {
						// 		if($key['station_id'] == $data[$i]['station_id']){
						// 			$empty += $key['rating'];
							
						// 		}
						// 	}
						// }
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["station_name"];?></td>
							<td><?php echo $data[$i]["station_phone"];?></td>
							<td><?php echo $data[$i]["station_open_hour"];?></td>
							<td><?php echo $data[$i]["station_close_hour"];?></td>
							<td><?php echo $data[$i]["uniq_id"];?></td>
							
					
							<!-- <td><img src="<?php echo base_url()."media/partner/".$data[$i]["station_id"]; ?>"  height="80px" /></td> -->
							<!--<td><img src="<?php //echo base_url("media/member/low/".$data[$i]["member_image"]."");?>" width="100px"></td>-->
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["station_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["station_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["station_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["station_name"];?> from product table? ')"><b>Delete</b></a>
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