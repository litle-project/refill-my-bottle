<?php
	$row=$data[0];
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
				<br/>

			<form action="<?php echo base_url().'category/update'; ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<input type="hidden" name="id" value="<?php echo $row['category_id']; ?>" />
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Category Name</label>
					<div class="col-md-6 col-sm-6">
						<?php
							echo form_input("category_name",$row['category_name'],"class='form-control' placeholder='Name' required");
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-3 control-label">Category Description</label>
					<div class="col-md-6 col-sm-6">
						<?php
							echo form_input("category_desc",$row['category_desc'],"class='form-control ckeditor' placeholder='Description' required");
						?>
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-md-3 control-label">Promo</label>
					<div class="col-md-4">
						<?php											
							echo form_dropdown("promo_id",$promo,$row['promo_id'],"class='form-control' ");
						?>
					</div>
				</div>-->
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3">
						Category Icon<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label">
							<button type="button" class="btn btn-sm blue" id="photo" style="font-weight: bold;">Change Image</button>
							<br/><br/>
							<div class="pt" style="display:none">
								<?php
									echo form_upload("category_icon","","id='photos' class='form-control'");
								?>
								<input type="hidden" value="0" name="photo_status" id="photo_status">
								<br/>
							</div>
							<img src="<?php echo base_url("media/category/".$row["category_icon"]."");?>" width="120px" style='border:4px solid #eee; '>
							<br/><br/>
						</label>    
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="control-label col-md-3">
						Category Icon Mobile<span class="required"></span>
					</label>
					<div class="col-md-4">
						<label class="control-label ">
							<button type="button" class="btn green" id="photo2">Change Image</button>
							<br/><br/>
							<div class="pt2" style="display:none">
							<?php
								echo form_upload("category_image","","id='photos2' class='form-control'");
							?>
							<input type="hidden" value="0" name="photo_status2" id="photo_status2">
							<br>
							</div>
							<img src="<?php echo base_url("media/category/".$row["category_image"]."");?>" width="120px" style='border:2px solid black; '>
							<br/><br/>
						</label>
					</div>
				</div> -->
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Submit</b></button>
						<button type="reset" class="btn default"  id="reset" onclick="window.history.back()"><b>Back</b></button>
						<!--
						<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
						-->
					</center>
				</div>
			</div>
			</form> 

			</div>
		</div>
	</div>
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