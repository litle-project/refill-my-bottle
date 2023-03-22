<div style="padding-left: 5%">
	<center>
		<h3>Report Station For <?php echo date('F Y');?></h3>
		<table border="1" style="border-collapse: collapse;">
			<thead>
				<tr>
					<th style="padding: 5px">No</th>
					<th style="padding: 5px">Station Name</th>
					<th style="padding: 5px">Station Category</th>
					<th style="padding: 5px">Station Type</th>
					<th style="padding: 5px">Total Transaction</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				for($i=0; $i <count($data) ; $i++){
			?>
				<tr class="gradeX">
					<td style="padding: 5px"><?php echo $no;?></td>
					<td style="padding: 5px"><?php echo $data[$i]["station_name"];?></td>
					<td style="padding: 5px"><?php echo $data[$i]["category_name"];?></td>
					<td style="padding: 5px"><?php echo $data[$i]["name_type"];?></td>
					<td style="padding: 5px"><?php echo $data[$i]["total"];?></td>
				</tr>
			<?php
					$no++;
				}
			?>
			</tbody>
			<tfoot>
				<tr>
					<th style="padding: 5px">No</th>
					<th style="padding: 5px">Station Name</th>
					<th style="padding: 5px">Station Category</th>
					<th style="padding: 5px">Station Type</th>
					<th style="padding: 5px">Total Transaction</th>
				</tr>
			</tfoot>
		</table>
	</center>
</div>
