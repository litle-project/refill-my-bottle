<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

<h1><?php echo $title;?></h1>
<br/>
<div class="col-md-12">
	<div class="portlet box grey">
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="btn-group">
					<!--
						<button class="btn green" onclick="window.location.href='<?php echo site_url("motivation/add");?>'">
						Add New <i class="fa fa-plus"></i>
						</button>
					-->
					<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_user/add");?>'">
						<i class="fa fa-plus"></i> &nbsp;&nbsp;<b>Add New</b>
					</button>
				</div>

				<div class="btn-group pull-right">
					<button class="btn dropdown-toggle" data-toggle="dropdown"><b>Tools</b> &nbsp;<i class="fa fa-caret-down"></i></button>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="#"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Save as PDF</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export to Excel</a>
						</li>
					</ul>
				</div>
			</div>
			<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Photo</th>
						<th>Privileges</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach($get_user as $row){
					?>
					<tr class="gradeX">
						<td><?php echo $no;?></td>
						<td><?php echo $row["admin_name"];?></td>
						<td><?php echo $row["admin_username"];?></td>
						<td><?php echo $row["admin_email"];?></td>
						<td><img src="<?php echo base_url("media/user/".$row["admin_photo"]);?>" width="80px" height="80px"></td>
						<td><?php echo $row["user_group_name"];?></td>
						<td>
							<button class="btn btn-sm blue" onclick="window.location.href='<?php echo site_url("admin_user/edit/".$row["admin_id"]);?>'"><b>Edit</b></button>
						</td>
						<td>
							<button class="btn btn-sm red" onclick="del_confirm('Are you sure to delete <?php echo $row["admin_name"];?> from users?','<?php echo site_url("admin_user/delete/".$row["admin_id"]);?>')"><b>Delete</b></button>
						</td>
					</tr>
					<?php
						$no++;
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Photo</th>
						<th>Privileges</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<script>
	function del_confirm(msg,url){
		if(confirm(msg)){
			window.location.href=url
		}else{
			false;
		}
	}
</script>