<?php
	$row = $data[0];
?>
<br>
  <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box yellow">
                    <div class="portlet-title">
                            <div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							
                    </div>
                    <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php
                                    //echo form_open_multipart('');
                            ?>
                            <form action="" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
                                    <div class="form-body">
											<div class="form-group">
                                                    <label class="control-label col-md-3">Printer Name
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														<label class="control-label  ">
                                                            <?php
                                                                    echo $row["printer_name"];
                                                            ?>
                                                        </label>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">Printer Desc 
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														<label class="control-label">
                                                            <?php
                                                                    echo $row["printer_desc"];
                                                            ?>
                                                         </label>   
                                                    </div>
                                            </div>
                                                                                        
                                           
                                            </div>
											<div class="form-group">
                                                    <label class="control-label col-md-3">Printer Image
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-4">
														<label class="control-label ">
                                                            <?php
                                                                    echo "<img src='".base_url()."media/printer/".$row["printer_image"]."' width='350px'  />";
                                                            ?>
                                                        </label>    
                                                    </div>
                                            </div>
                                            		

											<div class="form-group">
                                                    <label class="control-label col-md-3">Cartridge Image
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-4">
														<label class="control-label ">
                                                            <?php
                                                                    echo "<img src='".base_url()."media/printer/".$row["printer_image_detail"]."' width='350px'  />";
                                                            ?>
                                                        </label>    
                                                    </div>
                                            </div>
											
											<div class="form-group">
                                                    <label class="control-label col-md-3">Printer Created
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-4">
														<label class="control-label ">
                                                            <?php
                                                                    echo $row["created_date"];
                                                            ?>
                                                        </label>    
                                                    </div>
                                            </div>
											
											<Br>
										</div>
                                            
										<div class="form-actions fluid">
												<div class="col-md-offset-3 col-md-9">
														<input type="button" value="Back" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" class="btn default" >
												</div>
										</div>
                            </form>
                            <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
            </div>
    </div>