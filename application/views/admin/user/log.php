<script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-lg-12">
		<div class="tab-content">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box grey">
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="btn-group">
								<!--
									<button class="btn green" onclick="window.location.href='<?php echo site_url("motivation/add");?>'">
									Add New <i class="fa fa-plus"></i>
									</button>
								-->
								<!-- <button class="btn green" onclick="window.location.href='<?php echo site_url("admin_privileges/add");?>'">Add New<i class="fa fa-plus"></i>
									</button> -->
							</div>
							<div class="btn-group pull-right">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><b>Tools</b> &nbsp;<i class="fa fa-caret-down"></i>
								</button>
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
						<br/>

						<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th>No</th>
									<th>Action</th>
									<th>Action Date</th>
									<th>Action By</th>
									<th>IP Address</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach($user_group as $row){
								?>
								<tr class="gradeX">
									<td><?php echo $no;?></td>
									<td><?php echo $row['action'];?></td>
									<td><?php echo $row['creation_date'];?></td>
									<td><?php echo $row['admin_name'];?></td>
									<td><?php echo $row['ip_address'];?></td>
										</tr>
								<?php
									$no++;
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Action</th>
									<th>Action Date</th>
									<th>Action By</th>
									<th>IP Address</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>