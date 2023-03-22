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
							<th>id shop</th>
							<th>id shop detail</th>
							<th>title product</th>
							<th>URL web</th>
							<!-- <th>Partner URL</th> -->
							<!-- <th>Partner Image</th> -->
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
							<td><?php echo $data[$i]["id_shop"];?></td>
							<td><?php echo $data[$i]["id_shop_detail"];?></td>
							<td><?php echo $data[$i]["title_product"];?></td>
							<td><?php echo $data[$i]["url_web"];?></td>
							<!-- <td><?php echo $data[$i]["partner_url"];?></td> -->
							<!-- <td><img src="<?php echo base_url()."media/partner/".$data[$i]["partner_image"]; ?>"  height="80px" /></td> -->
							<!--<td><img src="<?php //echo base_url("media/member/low/".$data[$i]["member_image"]."");?>" width="100px"></td>-->
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["id_shop_detail"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["id_shop_detail"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["title_product"];?> from shop detail table? ')"><b>Delete</b></a>
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