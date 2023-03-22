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
							<th>Member Name</th>
							<th>Station</th>
							<th>Send On</th>
							<th>Feedback</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						$date 	 = explode(" ", $data[$i]['created_date']);
						$change  = date("d-m-Y", strtotime($date[0]));
						$content = substr($data[$i]['feedback_content'], 0, 50);
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["first_name"];?></td>
							<td><?php echo $data[$i]["station_name"];?></td>
							<td><?php echo $change;?></td>
							<td><?php echo $content."...";?></td>
							
					
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["feedback_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
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