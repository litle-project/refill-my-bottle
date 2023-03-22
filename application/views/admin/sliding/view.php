<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group">
						<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_sliding/add");?>'">
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
				
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Sliding Title</th>
							<th>Sliding Desc</th>
							
							<th>Sliding Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach($get_data as $row){
						?>
						<tr class="odd gradeX">
							<td> <?php echo $no; ?> </td>
							<td> <?php echo $row["sliding_title"]; ?> </td>
							<td> <?php echo $row["sliding_desc"]; ?> </td>
							<td>
								<img width="50px" src="<?php echo base_url("media/sliding/" . $row["sliding_image"]);?>">
							</td>
							<td>
								<a href="<?php echo site_url("admin_sliding/edit/".$row["sliding_id"]."");?>"><b>Edit</b></a>
							</td>
							<td>
								<a href="<?php echo site_url("admin_sliding/delete/".$row["sliding_id"]."");?>"><b>Delete</b></a>
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