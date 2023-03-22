<?php
	$row = $data[0];
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Category</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-7 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">

			<form action="" method="post" id="form_sample_3" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">
							Category Name<span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label">
								<?php
									echo $row["category_name"];
								?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">
							Category Desc <span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label">
								<?php
									echo $row["category_desc"];
								?>
							 </label>   
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">
							Category Icon<span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label">
								<?php
									echo "<img src='".base_url()."media/category/".$row["category_icon"]."' width='120px' style='border:2px solid transparent; '/>";
								?>
							</label>    
						</div>
					</div>		
							
					<!--<div class="form-group">
						<label class="control-label col-md-3">
							Category Icon Mobile<span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label ">
								<?php
									echo "<img src='".base_url()."media/category/".$row["category_image"]."' width='120px' style='border:2px solid black; '/>";
								?>
							</label>    
						</div>
					</div>											                                          
				   
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">
							Promo<span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label ">
								<?php
									if($row["promo_id"]){
										echo $row["promo_name"]."<br>";
										echo "<img src='".base_url()."media/promo/".$row["promo_image"]."' width='150px' style='border:2px solid black; '/>";
									}else{
										echo "Tidak ada promo";
									}
								?>
							</label>    
						</div>
					</div>-->
																		
					<div class="form-group">
						<label class="control-label col-md-3">
							Category Created<span class="required"></span>
						</label>
						<div class="col-md-4">
							<label class="control-label ">
								<?php
									echo $row["category_date"];
								?>
							</label>    
						</div>
					</div>
					<br/>
				</div>	
				<div class="form-actions fluid">
					<div class="col-md-offset-3 col-md-9">
						<input type="button" value="Back" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" class="btn default" style="font-weight: bold;">
					</div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>