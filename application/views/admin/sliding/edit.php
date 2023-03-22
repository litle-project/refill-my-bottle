<!--<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
-->
<script>

	$(document).ready(function(){

		$("#photo").click(function(){

                        //alert("aaa");

			var vala=$(this).attr("value");

			if(vala=="Change Photo"){

				$(".pt").fadeIn();

				$(this).val("Unchange Photo");

				$("#photos").attr("required",true);

				$("#photo_status").val("1");

			}else{

				$(".pt").hide();

				$(this).val("Change Photo");

				$("#photos").attr("required",false);

				$("#photo_status").val("0");

			}

		});

	});

</script>
<br>
<div class="row">

	<div class="col-md-12">

		<div class="tab-sliding">

			<div class="tab-pane active" id="tab_0">

				<div class="portlet box blue">

					<div class="portlet-title">

						<div class="caption">

							<i class="fa fa-reorder"></i><?php echo $title;?>

						</div>

						

					</div>

					<div class="portlet-body form">

						<!-- BEGIN FORM-->

						<?php

							$row=$get_data[0];

						?>

						

						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>

							<div class="form-body">

							

								<div class="form-group">

									<label class="col-md-3 control-label">Sliding Title</label>

									<div class="col-md-4">

										<input type="text" class="form-control" name="sliding_title" placeholder="Sliding Title" value="<?php echo $row["sliding_title"];?>" required>

									</div>

								</div>

								

								<div class="form-group">

									<label class="col-md-3 control-label">Sliding Desc</label>

									<div class="col-md-4">

										<textarea class="form-control" name="sliding_desc" placeholder="Sliding Desc" required><?php echo $row["sliding_desc"];?></textarea>

									</div>

								</div>

								

							

								

								<div class="form-group">

									<label class="col-md-3 control-label">Sliding Image</label>

									<div class="col-md-4">

                                                                                <img src="<?php echo base_url("media/sliding/".$row["sliding_image"]);?>" width="150px" height="150px">

                                                                                <input type="hidden" name="photo_status" id="photo_status" value="0">

                                                                                <input type="button" value="Change Photo" class="button blue-gradient" id="photo">

                                                                                <p class="button-height inline-label pt" style="display:none">

                                                                                        <?php

                                                                                                echo form_upload("photo","","id='photos'");

                                                                                        ?>

                                                                                </p>

                                                                        </div>

								</div>

								

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

				</div>

			</div>

		</div>

	</div>

</div>				