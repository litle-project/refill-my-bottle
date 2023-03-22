<h1><?php echo $title;?></h1>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box grey">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
                </div>
                 <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tier Name</th>
                            <th>For Member Has Refill</th>
                            <th>Tier Icon/Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no=1;
                        for($i=0; $i <count($data) ; $i++){
                    ?>
                        <tr class="gradeX">
                            <td><?php echo $no;?></td>
                            <td><?php echo $data[$i]["tier_name"];?></td>
                            <td><?php echo $data[$i]["tier_point"];?> Times</td>
                            <td><img src="<?php echo base_url("media/member_tier/".$data[$i]["tier_image"]."");?>" width="50" height="50"></td>
                            <td>
                            <a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["tier_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
                            <a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["tier_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
                            <a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["tier_id"]."");?>" class="btn btn-sm red"><b>Delete</b></a>
                            </td>
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