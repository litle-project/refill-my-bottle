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
			<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"> Add New <i class="fa fa-plus"></i>
									</button>
			</div>
			
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
				<thead>
				<tr>
					<th>No</th>
					<th>Store</th>
					<th>Address</th>
					<th>Store Image</th>
					
					<!--<th>Member Photo</th>-->
					<th>Details</th>


				</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
								<td><?php echo $no;?></td>
								<td><?php echo $data[$i]["store_name"];?></td>
								<td><?php echo $data[$i]["store_address"];?></td>
								<td><img src="<?php echo base_url(); ?>media/store/<?php echo $data[$i]["image"][0]["store_image_link"];?>"  height="80px" /></td>
								
								<!--<td><img src="<?php //echo base_url("media/member/low/".$data[$i]["member_image"]."");?>" width="100px"></td>-->
								<td>								
								<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["store_id"]."");?>" class="btn green">Edit</a>
								<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["store_id"]."");?>" class="btn red" onclick="return confirm('Are you sure you want to delete ? ')">Delete</a>
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
