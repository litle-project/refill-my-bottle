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
				<input type='hidden' name='id' value="<?php echo $row['leather_id']; ?>" />
                                <div class="form-body">
						<div class="form-group">
								<label class="control-label col-md-3">Leather Name
								<span class="required">
									
								</span>
								</label>
								<div class="col-md-5">
															    
										<?php
											echo form_input("leather_name",$row['leather_name']," class='form-control' placeholder='Name' required");
										?>
								    
								</div>
						</div>
						
											
						<div class="form-group">
							<label class="col-md-3 control-label">Category</label>
							<div class="col-md-6">
								<?php											
									echo form_dropdown("leather_category_id",$printer,$row["leather_category_id"],"class='form-control' ");
								?>
							</div>
						</div>
											
											
						<div class="form-group">
							<label class="control-label col-md-3">Leather Desc 
							<span class="required">
								
							</span>
							</label>
							<div class="col-md-6">
														    <label class="control-label">
								<?php
																    echo form_textarea("leather_desc",$row['leather_desc'],"class='form-control ckeditor' placeholder='Description' ");
															    ?>
							     </label>   
							</div>
						</div>
                                            
                                          
                                           
                                            
						<div class="form-group">
								<label class="control-label col-md-3">Leather Image
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
																	    echo form_upload("leather_image","","id='photos' class='form-control'");
																    ?>
																    <input type="hidden" value="0" name="photo_status" id="photo_status">
																    </div>
									<img src="<?php echo base_url("media/product/".$row["leather_image_list"]."");?>" width="200px" >
																    <br>
																    <br>
																    
																    
								    </label>    
								</div>
						</div>
											
											
                                            											
						<div class="form-group">
								<label class="control-label col-md-3">Leather Created
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
		    <div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="<?php echo site_url("admin_leather/update_leather_image/".$this->uri->segment(3)."") ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							<h3>Image</h3>
								<?php
								$no = 1;
								$count=count($get_image);
                
									foreach($get_image as $row3){
										?>
										
          										<div class="form-group">
          											<label class="col-md-3 control-label">Leather Image</label>
          											<div class="col-md-4">
          												<img src="<?php echo base_url("media/product/low/".$row3["leather_image_link"]);?>" height="150px">
          												<input type="hidden" name="photo_status<?php echo $no;?>" id="photo_status<?php echo $no;?>" value="0">
          												<input type="hidden" name="leather_image_id<?php echo $no;?>" id="" value="<?php echo $row3["leather_image_id"]; ?>">
          												<input type="button" value="Change Photo" class="btn blue" id="photo<?php echo $no; ?>">
          												<a href="<?php echo site_url("admin_leather/delete1/".$row3["leather_image_id"]."/".$row3["leather_id"]."");?>" onclick="return confirm('Are You Sure Delte This Leather???');">
          												<button type="button" class="btn red">Delete</button>
          											</a>
          												<br>
          												<br>
          												<p class="button-height inline-label pt<?php echo $no; ?>" style="display:none">
          													<?php
          														echo form_upload("leather_thumb$no","","id='photos'");
          													?>
          												</p>
          											
          											</div>
          										</div>
											
												<script>
													$(document).ready(function(){
														
														$("#photo<?php echo $no;?>").click(function(){
															    //alert("aaa");
															var vala=$(this).attr("value");
															if(vala=="Change Photo"){
																$(".pt<?php echo $no;?>").fadeIn();
																$(this).val("Unchange Photo");
																$("#photos<?php echo $no;?>").attr("required",true);
																$("#photo_status<?php echo $no;?>").val("1");
															}else{
																$(".pt<?php echo $no;?>").hide();
																$(this).val("Change Photo");
																$("#photos<?php echo $no;?>").attr("required",false);
																$("#photo_status<?php echo $no;?>").val("0");
															}
														});
													
													});
											      </script>
										<?php
										$no++;
									}
								?>
								<?php
									$count=1+$count;
									for($i=$count;$i<=10;$i++){
								?>
										<div class="form-group" id='row-<?php echo $i; ?>' style="display: none;">
											<label class="col-md-3 control-label">Leather Image</label>
											<div class="col-md-4">
												<input type="file" class="form-control" name="leather_image<?php echo $i ?>" placeholder="Leather Image">
											</div>
										</div>
									    
									    
									    
								<?php
									}
								?>
                                                                        
                                            
                                            <p class="button-height inline-label">
                                              <input type="hidden" name="frist" value="<?php echo $count; ?>">
                                              <input type="hidden" name="images" id="photos2" value ="<?php echo $count;?>"><br>
                                              <button type="button" id="addRow" class="btn" row="<?php echo $count; ?>">Add More Image</button>
                                              <button type="button"  class="button blue-gradient mnc2 " id="cancel2" style=" display: none;">Cancel</button>
                                              
                                            </p>
                                                                     
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>
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
					
						var y = $('#photos2').val();
		var yy =  parseInt($('#photos2').val());
		$('#addRow').click(function(){
			$(".mnc2").fadeIn();
			$(this).attr('disabled','disabled');
			$(this).attr('disabled','disabled');
			row = $(this).attr('row');
			$("select#event_city_id"+row).attr("required",true);
			$("input#event_city_lat"+row).attr("required",true);
			$("input#event_city_lang"+row).attr("required",true);
			
			$('#row-'+row).fadeIn(function(){
				row++;
				yy=yy+1;
				
				
				$('#addRow').attr('row',row);
				$('#addRow').removeAttr('disabled');
				$('#photos2').val(yy);
			       
				//$('#admins1').val(x4);
			});		
				
		});
		$('#cancel2').click(function(){
				row=$("#addRow").attr('row');
				//alert (row);
				row=row-1;
				yy=yy-1;
				//alert (y);
				//$("select#event_city_id"+row).attr("required",false);
				//$("input#event_city_lat"+row).attr("required",false);
				//$("input#event_city_lang"+row).attr("required",false);
				$("input#photos2").val(yy);
				//$("input#admins1").val(x4);
				$('#row-'+row).hide();
				if(row==y)
				{
					$(".mnc2").hide();
				}
				$('#addRow').removeAttr('disabled');
				$("#addRow").attr('row',row);
				
		});							
				});
			</script>		
    </div>