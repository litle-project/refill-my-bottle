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
							<input type='hidden' name='id' value="<?php echo $row['store_id']; ?>" />
                                    <div class="form-body">
											<div class="form-group">
                                                    <label class="control-label col-md-3">Store Name
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("store_name",$row['store_name']," class='form-control' placeholder='Name' required");
															?>
                                                        
                                                    </div>
                                            </div>
											
											
											
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">Store Desc 
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-6">
														<label class="control-label">
                                                            <?php
																echo form_textarea("store_desc",$row['store_desc'],"class='form-control ckeditor' placeholder='Description' ");
															?>
                                                         </label>   
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">Store Address 
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-6">
														<label class="control-label">
                                                            <?php
																echo form_textarea("store_address",$row['store_address'],"class='form-control ' placeholder='Address' id='address' ");
															?>
                                                         </label>   
                                                    </div>
                                            </div>
                                          
                                           <div class="form-group">
                                                    <label class="control-label col-md-3">Store Phone
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("store_phone",$row['store_phone']," class='form-control' placeholder='Phone' ");
															?>
                                                        
                                                    </div>
                                            </div>
                                            
											<div class="form-group">
                                                    <label class="control-label col-md-3">Store Email
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("store_email",$row['store_email']," class='form-control' placeholder='Email' 
																");
															?>
                                                        
                                                    </div>
                                            </div>
											
											<div class="form-group">
                                                    <label class="control-label col-md-3">Store Fax
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("store_fax",$row['store_fax']," class='form-control' placeholder='Fax' 
																");
															?>
                                                        
                                                    </div>
                                            </div>
											
											<div class="form-group">
                                                    <label class="control-label col-md-3">Store Website
                                                    <span class="required">
                                                            
                                                    </span>
                                                    </label>
                                                    <div class="col-md-5">
														
                                                            <?php
																echo form_input("store_website",$row['store_website']," class='form-control' placeholder='Website' 
																");
															?>
                                                        
                                                    </div>
                                            </div>
											
											<div class="form-group">
													<label class="control-label col-md-3">Maps
													<span class="required">
															*
													</span> 
													</label>
													
												
													<div class="col-md-4">
														<label class="control-label ">
														
															<!--<input type="text" size=30  name="address" id="address" placeholder="Find Location"/>-->
															<input type="button"  id="addressButton" value="View Coordinate Maps" /><br><br>
															
														</label>	
														   <div id="map" style="width:600px; height:300px"></div>
														<label class="control-label  col-md-8">
															Lat : <input type="text" name="store_lat" id="lat" value="<?php echo $row['store_lat']; ?>" placeholder=" lat" required/>
															Lng : <input type="text" name="store_long" id="lng" value="<?php echo $row['store_long']; ?>" required  placeholder=" lng" />
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
			
			
			<!--  START DIV IMAGE FORM -->
				<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="<?php echo site_url("store/update_image/".$this->uri->segment(3)."") ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-4">
											<B>IMAGE FOR THIS STORE</B>
										</div>
									</div>
									
								<?php
									$no = 1;
									$count=count($row["image"] );
									
									foreach($row["image"] as $row3){  
										?>
										
          										<div class="form-group"> 
          											<label class="col-md-3 control-label">Image <?php echo $no; ?> <br> 675 x 450 </label>
          											<div class="col-md-8">
          												<img src="<?php echo base_url("media/store/".$row3["store_image_link"]);?>" height="250px">
          												<input type="hidden" name="photo_status<?php echo $no;?>" id="photo_status<?php echo $no;?>" value="0">
          												<input type="hidden" name="place_image_id<?php echo $no;?>" id="" value="<?php echo $row3["store_image_id"]; ?>">
														
          												<input type="button" value="Change Photo" class="btn blue" id="photo<?php echo $no; ?>">
          												<a href="<?php echo site_url("store/delete_image/".$row3["store_image_id"]."/".$row3["store_id"]."");?>" onclick="return confirm('Are You Sure Delte This Item???');">
          												<button type="button" class="btn red">Delete</button>
          											</a>
          												<br>
          												<br>
          												<p class="button-height inline-label pt<?php echo $no; ?>" style="display:none">
          													<?php
          														echo form_upload("item_thumb$no","","id='photos' class='form-control'");
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
                                                    <div class="form-group" id='row1-<?php echo $i; ?>' style="display: none;">
														<label class="col-md-3 control-label"> Image <?php echo $i; ?> <br> 675 x 450</label>
														<div class="col-md-4">
															<input type="file" class="form-control" name="place_image<?php echo $i ?>" placeholder="Place Image">
														</div>
													</div>
                                                    
                                                    
                                                    
                                                <?php
                                                }
                                            ?>
                                                                        
                                            <div class="form-group" >
												<label class="col-md-3 control-label"> </label>
												<div class="col-md-4">
												<button type="button" id="addRow2-1" class="btn blue" row="<?php echo $count; ?>">Add More Image</button>
												<button type="button"  class="btn  blue-gradient mnc2-1 " id="cancel2-1" style=" display: none;">Cancel</button>
												</div>
											</div>
                                            <p class="button-height inline-label">
                                              <input type="hidden" name="frist" value="<?php echo $count; ?>">
                                              <input type="hidden" name="images" id="photos-1" value ="<?php echo $count;?>"><br>                                              
                                            </p>
                                                                     
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn green">Update Image</button>
									<a href="<?php echo site_url($this->uri->segment(1)); ?>"><button type="button" class="btn default">Cancel</button></a>
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				<!--  END DIV IMAGE FORM -->
			
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
					
					
					<?php
		    for ($i=1; $i<=5; $i++){
		?>
		    xx<?php echo $i;?>=<?php echo $count; ?>;
		    $('#photos-<?php echo $i; ?>').val(xx<?php echo $i;?>);
		    $('#addRow2-<?php echo $i;?>').click(function(){
			    $(".mnc2-<?php echo $i;?>").fadeIn();
			    $(this).attr('disabled','disabled');
			    $(this).attr('disabled','disabled');
			    row = $(this).attr('row');
			    $("select#event_city_id"+row).attr("required",true);
                            $("input#event_city_lat"+row).attr("required",true);
                            $("input#event_city_lang"+row).attr("required",true);
                            
			    $('#row<?php echo $i;?>-'+row).fadeIn(function(){
				    row++;
				    xx<?php echo $i;?>=xx<?php echo $i;?>+1;
				    
				    
				    $('#addRow2-<?php echo $i;?>').attr('row',row);
				    $('#addRow2-<?php echo $i;?>').removeAttr('disabled');
				    $('#photos-<?php echo $i; ?>').val(xx<?php echo $i;?>);
				   
				    //$('#admins1').val(x4);
			    });		
				    
		    });
		    $('#cancel2-<?php echo $i; ?>').click(function(){
					row=$("#addRow2-<?php echo $i;?>").attr('row');
					//alert (row);
					row=row-1;
					xx<?php echo $i;?>=xx<?php echo $i;?>-1;
					
					$("select#event_city_id"+row).attr("required",false);
                                        $("input#event_city_lat"+row).attr("required",false);
                                        $("input#event_city_lang"+row).attr("required",false);
					$("input#photos-<?php echo $i; ?>").val(xx<?php echo $i;?>);
					//$("input#admins1").val(x4);
					$('#row<?php echo $i;?>-'+row).hide();
					if(row==<?php echo $count ?>)
					{
						$(".mnc2-<?php echo $i; ?>").hide();
					}
                                        $('#addRow2-<?php echo $i;?>').removeAttr('disabled');
					$("#addRow2-<?php echo $i;?>").attr('row',row);
					
			});
		    
		
		<?php
		    }
		?>
					
				});
			</script>		
    </div>
	
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCja0UUtJt9Q1SbygezXaGRUAYhechWCh0"></script>

	<script type="text/javascript">
	
	(function() {
 
    // Mendefinisikan variabel global
    var map, geocoder, marker, infowindow;
 
    window.onload = function() {
 
      // Membuat map baru
      var options = {  
        zoom: 11,  
        center: new google.maps.LatLng(-6.20810, 106.84571),  
        mapTypeId: google.maps.MapTypeId.ROADMAP  
      };  
 
      map = new google.maps.Map(document.getElementById('map'), options);
 
      // Mengambil referensi ke form HTML
      var form = document.getElementById('addressButton');
 
      // Menangkap event submit form
      form.onclick = function() {
        // Mendapatkan alamat dari input teks
        var address = document.getElementById('address').value;
		if(address=="") alert("Please Input Address !");
		else {
			$("#kordinat").slideDown();
			$("#kordinat_value").val("1");
		}
        // Membuat panggilan Geocoder 
        getCoordinates(address);
 
        // Menghindari form dari page submit
        return false;
 
      }
 
    }
 
    // Membuat sebuah fungsi yang mengembalikan koordinat alamat
    function getCoordinates(address) {
      // Mengecek apakah terdapat 'geocoded object'. Jika tidak maka buat satu.
      if(!geocoder) {
        geocoder = new google.maps.Geocoder();  
      }
 
      // Membuat objek GeocoderRequest
      var geocoderRequest = {
        address: address
      }
 
      // Membuat rekues Geocode 
      geocoder.geocode(geocoderRequest, function(results, status) {
 
        // Mengecek apakah ststus OK sebelum proses
        if (status == google.maps.GeocoderStatus.OK) {
 
          // Menengahkan peta pada lokasi 
          map.setCenter(results[0].geometry.location);
 
          // Mengecek apakah terdapat objek marker
          if (!marker) {
            // Membuat objek marker dan menambahkan ke peta
            marker = new google.maps.Marker({
              map: map
            });
          }
 
          // Menentukan posisi marker ke lokasi returned location
          marker.setPosition(results[0].geometry.location);
 
          // Mengecek apakah terdapat InfoWindow object
          if (!infowindow) {
            // Membuat InfoWindow baru
            infowindow = new google.maps.InfoWindow();
          }
 
          // membuat konten InfoWindow ke alamat
          // dan posisi yang ditemukan
          var content = '<strong>' + results[0].formatted_address + '</strong><br />';
          content += 'Lat: ' + results[0].geometry.location.lat() + '<br />';
          content += 'Lng: ' + results[0].geometry.location.lng();
			
		$("#lat").val(results[0].geometry.location.lat());
		$("#lng").val(results[0].geometry.location.lng());
			
          // Menambahkan konten ke InfoWindow
          infowindow.setContent(content);
 
          // Membuka InfoWindow
          infowindow.open(map, marker);
 
        } 
 
      });
 
    }
 
  })();
	
	
	
	
	
	</script>