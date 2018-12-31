<?php
 $action_id    = "";
 $action_code  = "";
 $action_desc  = "";
 $category_id  = "";
 
if(!empty($tabledata))
{
    foreach ($tabledata as $row) 
    {
        $action_id   = $row->action_id;        
        $action_code = $row->action_code;
        $action_desc = $row->action_desc;
        $category_id = $row->category_id;
    }
}    
else
{
    $action_id   = $this->input->post('action_id');
    $action_code = $this->input->post('action_code');
    $action_desc = $this->input->post('action_desc');
    $category_id = $this->input->post('category_id');
}

?>
<body>
    <?php echo '<h1>'.$success.'</h1>' ?>        
    <form action="http://localhost/productivity/setting/ModuleOperation/formsubmit" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="element-wrapper">
                    <h6 class="element-header">Operations</h6>
                    <div class="element-box">
                        <form>
                            <h5 class="form-header">Create Module Operation</h5>
                            <div class="form-desc">Module Operation creation description will come here</div>
                           
                            <div class="form-group">
                                <label for=""> Select Module</label>
                                <select class="form-control">
                            <?php
                            foreach ($modules_list as $key => $value) 
                            {
                            ?>
                            <option value="<?php echo $value->category_id; ?>"><?php echo ucfirst($value->category_code); ?></option>
                            <?php
                            }
                            ?>
                            
                        </select>
                        
                            </div>
                           
                            <div class="form-group">
                                <label> Operation Name</label>
                                <input type="text" name="action_code" value="<?php echo $action_code;?>" class="form-control">
                                <?php echo form_error('action_code'); ?>         
                            </div>
                            <div class="form-group">
                                <label> Operation Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>                    
                            <div class="form-buttons-w">
                                <button class="btn btn-primary" type="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<?php
if(isset($operations_list))
{
?>
<div class="element-wrapper">
    <h6 class="element-header">Module Operations</h6>
    <div class="element-box">
        <h5 class="form-header">Operations List</h5>
        <div class="form-desc">Description about operations</div>
        <div class="table-responsive">
            <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                <thead>
                    <tr>
                        <th>Module Name</th>
                        <th>Operation Name</th>
                        <th>Operation Description</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Module Name</th>
                        <th>Operation Name</th>
                        <th>Operation Description</th>
                        <th>Operations</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                foreach ($operations_list as $key => $value) {
                ?>
                    <tr>
                        <td><?php echo $value->category_id; ?></td>
                        <td><?php echo $value->action_code; ?></td>
                        <td><?php echo $value->action_desc; ?></td>
                        <td><a class="btn btn-success btn-sm" href="#"><i class="os-icon os-icon-pencil-1"></i><span>Edit</span></a> <a class="btn btn-danger btn-sm" href="#"><i class="os-icon os-icon-ui-15"></i><span>Delete</span></a> </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}
?>