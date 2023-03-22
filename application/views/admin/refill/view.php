   <h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
					<tr>
						<th>No</th>
						<th>Expired Time</th>
						<th>Reason</th>
						<th>Change by</th>
						<th>Change on</th>
						<!--<th>Category Icon Mobile</th>-->
						<!--<th>Member Photo</th>-->
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						$date = explode(" ", $data[$i]['update_date']);
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["time"];?> Hours</td>
							<td><?php echo $data[$i]["reason"];?></td>
							<td><?php echo $data[$i]["admin_username"];?></td>
							<td><?php echo date("d-m-Y", strtotime($date[0]));?></td>
							<td>
								<a href="<?php echo site_url("refil_exp/edit/".$data[$i]["time_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
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
