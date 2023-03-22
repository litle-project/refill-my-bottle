<h1><?php echo $title;?></h1>
<br/>
<div class="row">
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
						<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_privileges/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;<b>Add New</b>
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
							<th>User Group</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Privileges</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach($user_group as $row){
						?>
							<tr class="gradeX">
								<td> <?php echo $no;?> </td>
								<td> <?php echo $row['user_group_name'];?> </td>

								<?php
									if($row["user_group_id"]){
								?>
								<td>
									<a href="<?php echo site_url("admin_privileges/edit/".$row["user_group_id"]."");?>"><button type="button"  class="btn btn-sm blue"><b>Edit</b></button></a>
								</td>
								<td>
									<a href="<?php echo site_url("admin_privileges/delete/".$row["user_group_id"]."");?>" onclick="return confirm('Are you sure want to delete <?php echo $row["user_group_name"];?> from table privileges?');"><button type="button" class="btn btn-sm red"><b>Delete</b></button></a>
								</td>
								<td>
									<a href="<?php echo site_url("admin_privileges/privileges/".$row["user_group_id"]."");?>"><button type="button" class="btn btn-sm green"><b>Privileges</b></button></a>
								</td>
								<?php
									}else{
								?>
								<td></td>
								<td></td>
								<td></td>
								<?php
									}
								?>
							</tr>
						<?php
								$no++;
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>User Group</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Privileges</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>