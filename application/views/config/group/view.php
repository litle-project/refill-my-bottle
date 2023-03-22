<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
			<br/>
		</div>
	</div>
	<div class="col-md-12 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group">
						<button class="btn green" onclick="window.location.href='<?php echo site_url("config/group_add");?>'">
							<i class="fa fa-plus"></i> &nbsp;&nbsp;Add New
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
							<th>Group Manu Name</th>
							<th>Description</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach($data as $row){
						?>
							<tr class="gradeX">
								<td><?php echo $no;?></td>
								<td><i class="fa <?php echo $row['icon'];?>"></i> &nbsp;&nbsp; <?php echo $row['group_menu_name'];?></td>
								<td><?php echo $row['group_menu_desc'];?></td>
								<td><a href="<?php echo site_url("config/group_edit/".$row["group_menu_id"]."");?>"><button type="button"  class="btn btn-sm blue">Edit</button></a></td>
								<td><a href="<?php echo site_url("config/group_delete/".$row["group_menu_id"]."");?>" onclick="return confirm('Are you sure want to delete <?php echo $row['group_menu_name'];?> from menu group?');"><button type="button" class="btn btn-sm red">Delete</button></a></td>
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