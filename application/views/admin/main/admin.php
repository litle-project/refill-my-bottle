<h1><?php echo $title;?></h1>
<br/><br/>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat blue" href="#">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349"><?php echo $member[0]['total_member'];?></span>
                    </div>
                    <div class="desc"><b> Member Active </b></div>
                </div>
                <a class="more" href="<?php echo base_url('admin_member');?>">
                	<b>See Details</b>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat green" href="#">
                <div class="visual">
                    <i class="fa fa-home"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349"><?php echo $station[0]['total_station']?></span>
                    </div>
                    <div class="desc"><b> Station Active </b></div>
                </div>
                <a class="more" href="<?php echo base_url('station_master');?>">
                	<b>See Details</b>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat yellow" href="#">
                <div class="visual">
                    <i class="fa fa-feed"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349"><?php echo $feedback[0]['total_feedback']?></span>
                    </div>
                    <div class="desc"><b> Total Feedbacks </b></div>
                </div>
                <a class="more" href="<?php echo base_url('feedback');?>">
                	<b>See Details</b>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat red" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349"><?php echo $bottle[0]['total_saved']?></span>
                    </div>
                    <div class="desc"><b> Total Bottle Saved </b></div>
                </div>
                <div class="more">
                	<b>See Details</b>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-6 col-xs-12" style="padding:0 5px;">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div>


	</div>
</div>
			
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<style type="text/css">
#container {
	height: 400px; 
	min-width: 310px; 
}
</style>

<?php
	$data_best_sell = "[";
	if(!empty($best_station)){
		foreach ($best_station as $row) {
			$data_best_sell .= "{";
			$data_best_sell .= "name: '".$row["station_name"]."',";
			$data_best_sell .= "y: ".$row["total"];
			$data_best_sell .= "},";
		}
	}
	$data_best_sell .= "]";
?>

<script>
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Top 10 Station In a Month'
    },
    subtitle: {
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Best Station In This Month'
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                // format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    "series": [
        {
            "name": "Station",
            "colorByPoint": true,
            "data": <?php echo $data_best_sell;?>
        }
    ]
});
</script>