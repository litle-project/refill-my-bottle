<?php
	$menu=$this->privileges->user_priv();
	
	$sql = "select * from group_menu a
			inner join menu b on b.group_menu_id=a.group_menu_id
			where b.menu_url = '".$this->uri->segment(1)."'
			";
	$query = $this->db->query($sql);
	$cek = $query->row_array();
	
	
	if($this->uri->segment(1)=="admin"){
		 $cek["group_menu_name"] = "";
	}
	//print_r("<pre>");
	//print_r($menu);
	//print_r("<pre>");
?>
<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<br/>
		<ul class="page-sidebar-menu">
			<li class="welcomeside">
				<img src="<?php echo base_url();?>media/user/<?php echo $this->session->userdata("admin_photo");?>" class="pull-left" style="border-radius:100%;height:70px;width:70px;margin:10px;">
				<br/>
				<p class="welcomesidetext" style="font-size:16px;">
					<span style="font-size:14px;"><i><b>Welcome,</b></i></span>
					<br/>
					<strong><i><?php echo $this->session->userdata("admin_name");?></i></strong>
					<br/>
				</p>
				<button onclick="location='<?php echo site_url("login_admin/logout"); ?>'" class="btn purple pull-right signout" style="margin:-40px 10px 0 0;"><b>Sign Out</b></button>
				<br/><br/>
			</li>	
			
			<li class="active">
				<a href="<?php echo site_url('admin');?>">
					<i class="fa fa-home"></i>
					<span class="title">
						Dashboard
					</span>
					<span class="selected">
					</span>
				</a>
			</li>
			
			<?php 
				foreach($menu as $row){
			?>
				<?php
					if( $cek["group_menu_name"] == $row["group_menu_name"] ){
				?>
					<li class="open">
				<?php
					}else{
				?>
					<li class="">
				<?php
					}
				?>
				
					<a href="javascript:;">
					<i class="fa 
					<?php
					if($row["icon"]!="") echo $row["icon"];
					else "fa-table";
					?>
					"></i>
					<span class="title"> <?php echo $row["group_menu_name"];?></span>
					
					<?php
						if( $cek["group_menu_name"] == $row["group_menu_name"] ){
					?>
						<span class="arrow open"></span>
					<?php
						}else{
					?>
						<span class="arrow "></span>
					<?php
						}
					?>
					
					</a>
					<?php
						if( $cek["group_menu_name"] == $row["group_menu_name"] ){
					?>
						<ul class="sub-menu" style="display:block">
					<?php
						}else{
					?>
						<ul class="sub-menu">
					<?php
						}
					?>
					
						<?php
							foreach($row["menu"] as $row2){
						?>
							<?php
								if( $this->uri->segment(1)==$row2["menu_url"] ){
							?>
								<li class="open">
							<?php
								}else{
							?>
								<li class="">
							<?php
								}
							?>
								<a href="<?php echo site_url($row2["menu_url"]);?>">
								<?php echo $row2["menu_name"];?></a>
							</li>
						<?php
							}
						?>
					</ul>
				</li>
			<?php
				}
			?>
		</ul>
</div>
				