<h1><?php echo $title;?></h1>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box grey">
            <div class="portlet-body">
                 <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>No</th>
                          
                            <th>Member Name</th>
                            <th>Member Email</th>
                            <th>Member status</th>
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
                          
                            <td><?php echo $data[$i]["first_name"];?></td>
                            <td><?php echo $data[$i]["member_email"];?></td>
                            <td><?php if ($data[$i]['status'] == '1') {
                                echo "Active";?></td>
                            <?php }else{ echo "Inactive"; }?>
                            
                            <td>
                            <a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["member_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
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