<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

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
					<button class="btn green" onclick="window.location.href='<?php echo site_url("config/front_add");?>'">
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
							<th>index_id</th>
							<th>title</th>
							<th>description</th>
							<th>keyword</th>
							<th>url</th>
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
							<td><?php echo $row["index_id"];?></td>
							<td><?php echo $row["title"];?></td>
							<td><?php echo $row["description"];?></td>
							<td><?php echo $row["keyword"];?></td>
							<td><?php echo $row["url"];?></td>
							<td>
								<input type="button" value="Edit" class="btn btn-sm blue" onclick="window.location.href='<?php echo site_url("config/front_edit/".$row["index_id"]);?>'">
							</td>
							<td>
								<input type="button" value="Delete" class="btn btn-sm red" onclick="del_confirm('Are you sure want to delete <?php echo $row["title"];?> from this table?','<?php echo site_url("config/front_delete/".$row["index_id"]);?>')">
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
							<th>index_id</th>
							<th>title</th>
							<th>description</th>
							<th>keyword</th>
							<th>url</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</tfoot>	
				</table>
			</div>
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