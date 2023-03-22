<style type="text/css">
.daterangepicker{
    top: 289.418px !important;
    /*right: 461.312px !important;*/
    /*left: auto !important;*/
    /*display: block !important;*/
}

.daterangepicker.opensleft:after {
    right: 458px !important;
}

.daterangepicker.opensleft:before {
    right: 457px !important;
}
</style>

<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group">
						<div class="form-group">
							<label class="control-label"><b>Filter By</b></label>
							<select class="form-control" onchange="filter(this)">
								<option value="">---- Please Select ----</option>
								<option value="1">Station Name</option>
								<option value="2">Station Type</option>
								<option value="3">Range Date</option>
							</select>
						</div>
						<form action="<?php echo base_url('report_station/filter_date');?>" method="post" >
							<span id="filter_data">
								<div class="form-group" style="display: none" id="name">
									<label class="control-label"><b>Filter Name</b></label>
									<input type="text" disabled id="station_name" name="station_name" class="form-control" required />
								</div>
								<div class="form-group" style="display: none" id="type">
									<label class="control-label"><b>Filter Type</b></label>
									<select name="type" id="station_type" class="form-control" disabled required />
										<option value="">---- Please Select ----</option>
										<?php foreach($type as $key){ ?>
											<option value="<?php echo $key['type_id']?>"><?php echo $key['name_type']?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group" style="display: none" id="date">
									<label class="control-label"><b>Filter Date</b></label>
									<input type="text" id="station_date" disabled name="date" class="form-control" required />
								</div>
								<button type="submit" class="btn blue" style="margin-left: 105%; margin-top:-46%;">Submit</button>
								<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" style="margin-left: 150%; margin-top:-64.5%;"><b>Back</b></button>
							</span>
						</form>
					</div>
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown"><b>Tools</b> &nbsp;<i class="fa fa-caret-down"></i></button>
							<ul class="dropdown-menu pull-right">
								<li>
									<?php if (!empty($date1) && !empty($date2)) { ?>
										<a href="<?php echo base_url('report_station/filter_date?pdf=pdf&date1='.$date1.'&date2='.$date2.'');?>"><i class="fa fa-print"></i>&nbsp;&nbsp;Save as PDF</a>
									<?php }elseif(!empty($name)){ ?>
										<a href="<?php echo base_url('report_station/filter_date?pdf=pdf&name='.$name.'');?>"><i class="fa fa-print"></i>&nbsp;&nbsp;Save as PDF</a>
									<?php }elseif(!empty($station_type)){ ?>
										<a href="<?php echo base_url('report_station/filter_date?pdf=pdf&type='.$station_type.'');?>"><i class="fa fa-print"></i>&nbsp;&nbsp;Save as PDF</a>
									<?php } ?>
								</li>
							</ul>
						</div>
					</div>
			
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
					<tr>
						<th>No</th>
						<th>Station Name</th>
						<th>Station Category</th>
						<th>Station Type</th>
						<th>Total Transaction</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["station_name"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td><?php echo $data[$i]["name_type"];?></td>
							<td><?php echo $data[$i]["total"];?></td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--  start datepicker range -->
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
	$(function() {
	  $('input[name="date"]').daterangepicker({
	    opens: 'right'
	    // format: "dd-mm-yyyy"
	  }, function(start, end, label) {
	    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
	    // format:date("dd-mm-yyyy");
	  });
	});
</script>
<!-- datepicker range end -->

<!-- filter -->
<script type="text/javascript">

	function filter(oke) {
		if (oke.value == 1) {
			// alert('hello world');
			$('#station_name').removeAttr('disabled', 'disabled');
			$('#station_date').attr('disabled', 'disabled');
			$('#station_type').attr('disabled', 'disabled');
			$('#name').show();
			$('#type').css('display', 'none');
			$('#date').css('display', 'none');
		}else if(oke.value == 2){
			$('#type').show();
			$('#station_type').removeAttr('disabled', 'disabled');
			$('#name').css('display', 'none');
			$('#date').css('display', 'none');
		}else if(oke.value == 3){
			$('#date').show();
			$('#station_date').removeAttr('disabled', 'disabled');
			$('#type').css('display', 'none');
			$('#name').css('display', 'none');
		}else{
			$('#date').css('display', 'none');
			$('#type').css('display', 'none');
			$('#name').css('display', 'none');
		}
	}
	
</script>

