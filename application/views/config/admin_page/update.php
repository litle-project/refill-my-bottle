<?php //print_r($data);?>
<script>
	$(document).ready(function(){
		$("#photo").click(function(){
			//alert("aaa");
			var vala=$(this).attr("value");
			if(vala=="Change Logo"){
				$(".pt").fadeIn();
				$(this).val("Unchange Logo");
				$("#photos").attr("required",true);
				$("#photo_status").val("1");
			}else{
				$(".pt").hide();
				$(this).val("Change Logo");
				$("#photos").attr("required",false);
				$("#photo_status").val("0");
			}
		});
		$("#loginbg").click(function(){
			//alert("aaa");
			var vala=$(this).attr("value");
			if(vala=="Change Background"){
				$(".pt2").fadeIn();
				$(this).val("Unchange Background");
				$("#loginimg").attr("required",true);
				$("#loginimg_status").val("1");
			}else{
				$(".pt2").hide();
				$(this).val("Change Background");
				$("#loginimg").attr("required",false);
				$("#loginimg_status").val("0");
			}
		});
	});
</script>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
	</div>
	<div class="col-md-10 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
			<form class="form-horizontal" action="<?php echo site_url("config/admin_page")?>" method="post" enctype='multipart/form-data'>
				<br/>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-4 control-label">Web Title</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="web_title" placeholder="web_title" value="<?php echo $data[0]["web_title"];?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Web Name</label>
						<div class="col-md-6">
							<textarea class="form-control" name="web_name" placeholder="" value="" required><?php echo $data[0]["web_name"];?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Web Url</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="web_url" placeholder="web_url" value="<?php echo $data[0]["web_url"];?>" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Logo</label>
						<div class="col-md-6">
                            <img src="<?php echo base_url("media/config/".$data[0]["logo"]);?>"  height="30px" style="background-color:#333;">
                            <input type="hidden" name="logoold" id="logoold" value="<?php echo $data[0]["logo"]; ?>">
                            <input type="hidden" name="photo_status" id="photo_status" value="0">
                            <input type="button" value="Change Logo" class="btn btn-sm default" id="photo">
                            <p class="button-height inline-label pt" style="display:none">
                            <?php
                                echo form_upload("logo","","id='photos' class='form-control'");
                            ?>
                            </p>
                        </div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Footer Desc</label>
						<div class="col-md-6">
							<textarea class="form-control" name="footer_desc" placeholder="footer_desc" value="" required><?php echo $data[0]["footer_desc"];?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Web Desc</label>
						<div class="col-md-6">
							<textarea class="form-control" name="web_desc" placeholder="web_desc" value="" required><?php echo $data[0]["web_desc"];?></textarea>
						</div>
					</div>
								
					<div class="form-group">
						<label class="col-md-4 control-label">Columns for frontend content</label>
						<div class="col-md-6">
							<?php
								$type=array("home_1"=>"Two Columns","home_2"=>"Three Columns");
                                echo form_dropdown("type",$type,$data[0]["type"],"required id='group' class='form-control'");
                        	?>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-sm-4 col-xs-12 control-label">Admin Panel Color Scheme</label>
						<div class="col-sm-3 col-xs-6">
							<p><input type="radio" name="theme" value="blue.css"
								<?php if($data[0]["theme"]=="blue.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Dark Blue</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#253342;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#2c3e50;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#00BCD4;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="purple.css"
								<?php if($data[0]["theme"]=="purple.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Purple and Green</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#412D5F;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#523f6d;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#a3b745;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="salmon.css"
								<?php if($data[0]["theme"]=="salmon.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Salmon</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#3A222A;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#52323D;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#BF5C5C;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="red.css"
								<?php if($data[0]["theme"]=="red.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Dark Red</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#610F0F;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#9C1616;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#E48522;"></i>
							<br/><br/>
						</div>
						<div class="col-sm-3 col-xs-6">
							<p><input type="radio" name="theme" value="dark.css"
								<?php if($data[0]["theme"]=="dark.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Dark Gold</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#272727;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#73706A;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#A08F5D;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="yellow.css"
								<?php if($data[0]["theme"]=="yellow.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Black and Yellow</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#1D1D1D;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#272727;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#E6A234;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="grey.css"
								<?php if($data[0]["theme"]=="grey.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Light Grey</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#464646;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#E8E8E8;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#F5F5F5;"></i>
							<br/><br/>
							<p><input type="radio" name="theme" value="lightblue.css"
								<?php if($data[0]["theme"]=="lightblue.css"){ echo "checked"; } ?>><b> &nbsp;&nbsp;Light Blue</b></p>
							<i class="fa fa-square" style="font-size:30px;color:#00BCD4;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#E8E8E8;"></i>
							<i class="fa fa-square" style="font-size:30px;color:#F5F5F5;"></i>
							<br/><br/>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-md-4 control-label">Login Screen Background</label>
						<div class="col-md-6">
							<img src="<?php echo base_url("assets/site/img/".$data[0]["loginimg"]);?>"  height="100px" style="background-color:#333;">
							<input type="hidden" name="loginimgold" id="loginimgold" value="<?php echo $data[0]["loginimg"]; ?>">
							<input type="hidden" name="loginimg_status" id="loginimg_status" value="0">
							<input type="button" value="Change Background" class="btn btn-sm default" id="loginbg">
							<p class="button-height inline-label pt2" style="display:none">
                            <?php
                                echo form_upload("loginimg","","id='loginimg' class='form-control'");
                            ?>
                            </p>
						</div>
					</div>		
				</div>
				<div class="form-actions fluid">
					<div class="col-lg-12">
						<center>
							<button type="submit" class="btn blue">Submit</button>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_privileges");?>'">Cancel</button>
						</center>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>			