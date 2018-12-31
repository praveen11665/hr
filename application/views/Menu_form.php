
<?php
$id                 =   "";
$module_id          =   "";
$parent             =   "";
$name               =   "";
$icon               =   "";
$slug               =   "";
$number             =   "";  

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $id                 =   $row->id;
        $module_id          =   $row->module_id;
        $parent             =   $row->parent;
        $name               =   $row->name;
        $icon               =   $row->icon;
        $slug               =   $row->slug;
        $number             =   $row->number;
    }
}
else
{
    $activity_id            =   $this->input->post('activity_id');
    $module_id              =   $this->input->post('module_id');
    $id                     =   $this->input->post('id');
    $parent                 =   $this->input->post('parent');
    $name                   =   $this->input->post('name');
    $icon                   =   $this->input->post('icon');
    $slug                   =   $this->input->post('slug');
    $number                 =   $this->input->post('number');
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <h6 class="element-header"> <?php echo $this->lang->line('menuform_heading');?></h6>
            <div class="element-box">
                <h5 class="form-header"><?php echo $this->lang->line('Menu_form_form_title');?></h5>
                <div class="form-desc"><?php echo $this->lang->line('Menu_form_description');?></div>
                <?php
                //success alert for insert and update
                if (isset($message)) 
                {
                    ?>
                        <div class="alert alert-<?php echo $alertType;?>">
                            <?php echo $message?>
                        </div>
                    <?php
                }
                ?>
                <form action="<?php echo base_url($ActionUrl);?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                    <div class="row">
    	                <div class="col-md-4">
    	                    <div class="form-group">
                                <label for=""><?php echo $this->lang->line('label_module');?><span class="mandatory">*</span></label>
                                <?php
                                    $extraAttr="id='module_id' class='form-control select2' onchange='loadParent(this.value)'";
                                    echo form_dropdown('module_id', $moduleDropdown, $module_id, $extraAttr);
                                ?> 
                                <span class="help-block"><?php echo form_error('module_id')?></span>
    	                    </div>
    	                </div>

    	                <div class="col-md-4">
    	                    <div class="form-group">
    							<label><?php echo $this->lang->line('label_parent');?></label>
    							<?php
                                    $parentDropdown  =   $this->mdrop->parentDropdown($module_id);   
                                    $extraAttr="id='parent' class='form-control select2'";
    								echo form_dropdown('parent', $parentDropdown, $parent, $extraAttr);
    							?>          
    							<span class="help-block"><?php echo form_error('parent')?></span>
           					</div>
    	                </div>
    	                <div class="col-md-4">
                        	<div class="form-group">
    							<label><?php echo $this->lang->line('label_name');?></label>
    							<span class="mandatory">*</span>
    							<input type="text" name="name" id="name" value="<?php echo $name;?>" class="form-control" />
    							<span class="help-block"><?php echo form_error('name')?></span>
                            </div>  
                        </div>
                    </div>

                    <div class="row">
    					<div class="col-md-4">
    						<div class="form-group">
    							<label><?php echo $this->lang->line('label_icon');?></label>
    							 
    							<input type="text" name="icon" id="icon" value="<?php echo $icon;?>" class="form-control" />
    							<span class="help-block"><?php echo form_error('icon')?></span>
                            </div>  
                      	</div>

                      	<div class="col-md-4">
    						<div class="form-group">
    							<label><?php echo $this->lang->line('label_slug');?></label>
    							<span class="mandatory">*</span>
    							<input type="slug" name="slug" id="slug" value="<?php echo $slug;?>" class="form-control" />
    							<span class="help-block"><?php echo form_error('slug')?></span>
                            </div>  
                      	</div>

                      	<div class="col-md-4">
    						<div class="form-group">
    							<label><?php echo $this->lang->line('label_sort');?></label>
    							<span class="mandatory">*</span>
    							<input type="number" name="number" id="number" value="<?php echo $number;?>" class="form-control" />
    							<span class="help-block"><?php echo form_error('number')?></span>
                            </div>  
                      	</div>
    				</div>

    				<div class="form-buttons-w">
                            <button class="btn btn-primary" type="submit" name="submit"> Submit</button>
                            <a href="<?php echo base_url('Menu/add') ?>" class="btn btn-danger"> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($listData))
{
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('Menu_form_list_title');?></h6>
                <div class="element-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="dataTableId" border="1" cellpadding="2" cellspacing="1" class="mytable table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('label_Module');?></th>
                                        <th><?php echo lang('label_Parent');?></th>
                                        <th><?php echo lang('label_Name');?></th>                                        
                                        <th><?php echo lang('label_Icon');?></th>
                                        <th><?php echo lang('label_Slug');?></th>
                                        <th><?php echo lang('label_Sort');?></th>
                                        
                                        <th><?php echo lang('lable_action');?></th>
                                    </tr> 
                                    <tbody>
                                        
                                    </tbody>                           
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<script>
  function loadParent(val)
  {
    module_id   =   $('#module_id').val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('Menu/getParent');?>",
      data : {
        'module_id' : module_id},
      success : function(data)
      {
        $('#parent').html(data);
      },
    });
  }
</script>

 

    
