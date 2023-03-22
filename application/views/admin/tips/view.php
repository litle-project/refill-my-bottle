<br>
<div class="row"> 
<div class="col-md-12">
					<!--<div class="note note-success">
						<p>
							 There are many ways to get your data into DataTables, and if you are working with seriously large databases, you might want to consider using the server-side options that DataTables provides. Basically all of the paging, filtering, sorting etc that DataTables does can be handed off to a server and DataTables is just an events and display module. The server side part of this example can be seen in <code>demo/table_ajax.php</code>.
						</p>
						<p>
							 To learn more please check out <a href="http://www.datatables.net/release-datatables/examples/data_sources/server_side.html" target="_blank">ajax datatable sample</a>.
						</p>
					</div>-->
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							<!--<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>
							</div>-->
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
                                                                    
								</div>
								<!--<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">Print</a>
										</li>
										<li>
											<a href="#">Save as PDF</a>
										</li>
										<li>
											<a href="#">Export to Excel</a>
										</li>
									</ul>
								</div>-->
							</div>
							<div class="table-toolbar">
							<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_tips/add");?>'"> Add New <i class="fa fa-plus"></i>
													</button>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
							<thead>
							<tr>
								<th>No</th>
								<th>Contanct</th>
								<th>CONTENT</th>
								<th>Last Update</th>
								<th>Operation</th>
							</tr>
							</thead>
							<tbody>
                                                            <?php
								$no=1;
								for($i=0; $i <count($data) ; $i++){
								    ?>
									<tr class="gradeX">
									    <td><?php echo $no; ?></td>
									    <td><?php echo $data[$i]["content_title"];?></td>
									    <td><?php echo word_limiter(strip_tags($data[$i]["content"]),5);?></td>
									    <td><?php echo $data[$i]["updated_date"];?></td>
									    <td>
										<a href="<?php echo site_url();?>admin_tips/edit/<?php echo $data[$i]["content_id"];?>"><button type="button" class="btn blue">Edit</button></a>
										<a href="<?php echo site_url();?>admin_tips/delete/<?php echo $data[$i]["content_id"];?>"><button type="button" class="btn red">Delete</button></a>
										
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
</div>