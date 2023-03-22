<?php
		$row = $data[0];
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
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
                            <form action="<?php echo base_url().$this->uri->segment(1).'/update'; ?>" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
							<input type='hidden' name='id' value="<?php echo $row['printer_id']; ?>" />
                                    <div class="form-body">
											<div class="form-group">
                                                    <label class="control-label col-md-3">Printer Name
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("printer_name",$row['printer_name']," class='form-control' placeholder='Name' required");
															?>
                                                        
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">Printer Desc 
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-6">
														<label class="control-label">
                                                            <?php
																echo form_textarea("printer_desc",$row['printer_desc'],"class='form-control ckeditor' placeholder='Description' ");
															?>
                                                         </label>   
                                                    </div>
                                            </div>
                                            
                                          
                                           
                                            
											<div class="form-group">
                                                    <label class="control-label col-md-3">Printer Image
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-4">
														<label class="control-label ">
															<button type="button" class="btn green" id="photo">Change Image</button>
															
															<br>
															<br>
															<div class="pt" style="display:none">
															<?php
																echo form_upload("printer_image","","id='photos' class='form-control'");
															?>
															<input type="hidden" value="0" name="photo_status" id="photo_status">
															</div>
                                                            <img src="<?php echo base_url("media/printer/".$row["printer_image"]."");?>" width="350px" >
															<br>
															<br>
															
															
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
															<button type="button" class="btn green" id="photo2">Change Image</button>
															
															<br>
															<br>
															<div class="pt2" style="display:none">
															<?php
																echo form_upload("printer_image_detail","","id='photos2' class='form-control'");
															?>
															<input type="hidden" value="0" name="photo_status2" id="photo_status2">
															</div>
                                                            <img src="<?php echo base_url("media/printer/".$row["printer_image_detail"]."");?>" width="350px" >
															<br>
															<br>
															
															
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
														<input type="submit" value="Update" class="btn green" >&nbsp &nbsp
														<input type="button" value="Back" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" class="btn default" >
												</div>
										</div>
                            </form>
                            <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
            </div>
			<script>
				$(document).ready(function(){
					$("#photo").click(function(){
						
						//alert("aaa");
						var vala=$(this).html();
						//alert(vala);
						if(vala=="Change Image"){
							$(".pt").fadeIn();
							$(this).html("Unchange Image");
							$("#photos").attr("required",true);
							$("#photo_status").val("1");
						}else{
							$(".pt").hide();
							$(this).html("Change Image");
							$("#photos").attr("required",false);
							$("#photo_status").val("0");
						}
					});
					
					$("#photo2").click(function(){
						
						//alert("aaa");
						var vala=$(this).html();
						//alert(vala);
						if(vala=="Change Image"){
							$(".pt2").fadeIn();
							$(this).html("Unchange Image");
							$("#photos2").attr("required",true);
							$("#photo_status2").val("1");
						}else{
							$(".pt2").hide();
							$(this).html("Change Image");
							$("#photos2").attr("required",false);
							$("#photo_status2").val("0");
						}
					});
				});
			</script>		
    </div>