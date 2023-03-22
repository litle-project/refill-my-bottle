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
							<th>Voucher Name</th>
							<th>Redeem Point</th>
							<th>Voucher image</th>
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
							<td><?php echo $data[$i]["voucher_name"];?></td>
							<td><?php echo $data[$i]["point"];?></td>
							<td><img src="<?php echo base_url("media/voucher/".$data[$i]["voucher_image"]."");?>" width="200px" height="70px"></td>
							
					
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["voucher_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["voucher_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["voucher_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["voucher_name"];?> from Voucher table? ')"><b>Delete</b></a>
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