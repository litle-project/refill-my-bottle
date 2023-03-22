<br>
<div class="row">
	<div class="col-md-12">
		<div class="tab-sliding">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<br>
						<form action="<?php echo base_url().$this->uri->segment(1); ?>/save" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Store Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("store_name","","class='form-control' placeholder='Name' required");
										?>
									</div>
								</div>
																
								
								<div class="form-group">
									<label class="col-md-3 control-label">Store Description</label>
									<div class="col-md-7">
										<?php
											echo form_textarea("store_desc","","class='form-control ckeditor' placeholder='Description'   ");
										?>
									</div>
								</div>
																
								
								<div class="form-group">
									<label class="col-md-3 control-label">Store Address</label>
									<div class="col-md-4">
										<?php
											echo form_textarea("store_address","","class='form-control' placeholder='Address'  id='address'  ");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Store Phone</label>
									<div class="col-md-4">
										<?php
											echo form_input("store_phone","","class='form-control' placeholder='Phone number' ");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Store Email</label>
									<div class="col-md-4">
										<?php
											echo form_input("store_email","","class='form-control' placeholder='Email' ");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Store Fax</label>
									<div class="col-md-4">
										<?php
											echo form_input("store_fax","","class='form-control' placeholder='Fax' ");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Store Website</label>
									<div class="col-md-4">
										<?php
											echo form_input("store_website","","class='form-control' placeholder='Website' ");
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
												Lat : <input type="text" name="store_lat" id="lat" placeholder=" lat" required/>
												Lng : <input type="text" name="store_long" id="lng" required  placeholder=" lng" />
											</label>
										</div>
								</div>
								
								<hr>
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-4">
											<B>IMAGE FOR STORE</B>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Image 1 </label>
										<div class="col-md-4">
											<input type="file" class="form-control" name="place_image1" placeholder="Item Image">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Image 2 </label>
										<div class="col-md-4">
											<input type="file" class="form-control" name="place_image2" placeholder="Item Image">
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="col-md-3 control-label">Image 3 </label>
										<div class="col-md-4">
											<input type="file" class="form-control" name="place_image3" placeholder="Item Image">
										</div>
									</div>
									<?php
										for($i=4;$i<=10;$i++){
											?>
											<div class="form-group" id='row1-<?php echo $i; ?>' style="display: none;">
												<label class="col-md-3 control-label">Image <?php echo $i ?></label>
												<div class="col-md-4">
													<input type="file" class="form-control" name="place_image<?php echo $i ?>" placeholder="Item Image">
												</div>
											</div>
											
											
											
										<?php
										}
									?>
									
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-4">
											<p class="button-height inline-label">
											  <input type="hidden" name="images" id="photos-1"><br>
											  <button type="button" id="addRow2-1" class="btn" row="4">Add More Image</button>
											  <button type="button"  class="button blue-gradient mnc2-1 " id="cancel2-1" style=" display: none;">Cancel</button>
											  
											</p>
										</div>
									</div>
																
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn green">Submit</button>&nbsp;&nbsp;&nbsp;
									<button type="reset" class="btn black" onclick="window.history.back();"  id="reset">Back</button>&nbsp;&nbsp;&nbsp;
									<!--
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
									-->
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>				



<script>
$(document).ready(function(){
        
		<?php
		    for ($i=1; $i<=5; $i++){
		?>
		    xx<?php echo $i;?>=3;
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
					if(row==4)
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

<script type="text/javascript" 
	src="http://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCja0UUtJt9Q1SbygezXaGRUAYhechWCh0"></script>

	<script type="text/javascript">
	
	(function() {
 
    // Mendefinisikan variabel global
    var map, geocoder, marker, infowindow;
 
    window.onload = function() {
 
      // Membuat map baru
      var options = {  
        zoom: 10,  
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