<?php
$ci =&get_instance();
//$ci->load->company_id('Common_company_id','mcommon',TRUE);
$companyDropdown    =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$statusDropdown     =  $ci->mcommon->Dropdown('def_training_program_status', array('def_training_status_id as Key', 'status as Value'));
$trainerDropdown    =  $ci->mcommon->Dropdown('hr_trainer', array('trainer_id as Key', 'trainer_name as Value'), array('is_delete' => 0));
$supplierDropdown   =  $ci->mcommon->Dropdown('pur_supplier', array('supplier_id as Key', 'supplier_name as Value'), array('is_delete' => 0));

    $training_program_id        =   '';
    $training_program           =   '';
    $company_id                 =   '';
    $def_training_status_id     =   '';
    $trainer_id                 =   '';
    $trainer_email              =   '';
    $supplier_id                =   '';
    $trainer_contact            =   '';
    $description                =   '';

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $training_program_id    =   $row->training_program_id;
        $training_program       =   $row->training_program;
        $company_id             =   $row->company_id;
        $def_training_status_id =   $row->def_training_status_id;
        $trainer_id             =   $row->trainer_id;
        $trainer_email          =   $row->trainer_email;
        $supplier_id            =   $row->supplier_id;
        $trainer_contact        =   $row->trainer_contact;
        $description            =   $row->description;
    }
}
else
{
    $training_program_id        =   $this->input->post('training_program_id');
    $training_program           =   $this->input->post('training_program');
    $company_id                 =   $this->input->post('company_id');
    $def_training_status_id     =   $this->input->post('def_training_status_id');
    $trainer_id                 =   $this->input->post('trainer_id');  
    $trainer_email              =   $this->input->post('trainer_email');
    $supplier_id                =   $this->input->post('supplier_id');
    $trainer_contact            =   $this->input->post('trainer_contact');
    $description                =   $this->input->post('description');   
}

?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Training_program_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm"  name="myform">
        <input type="hidden" name="training_program_id" id="training_program_id" value="<?php echo $training_program_id; ?>"/>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_training_program');?>
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text" name="training_program" id="training_program" maxlength="35" ng-init="training_program = '<?php echo $training_program; ?>'"  value="<?php echo $training_program;?>" class="form-control" ng-model="training_program" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.training_program.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error("training_program")?></span>
                </div>
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'companies' )">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_company_id');?> <span class="mandatory">*</span>
                            <a class="add-new-popup" onclick="">+</a>    
                        </label>
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id"';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>-->
                        <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_training_program_status','' , 'statuses' )">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_status');?> <span class="mandatory">*</span>
                            <a class="add-new-popup" onclick="">+</a>    
                        </label>
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="def_training_status_id"';
                        echo form_dropdown('def_training_status_id', $statusDropdown, set_value('def_training_status_id', (isset($def_training_status_id)) ? $def_training_status_id : ''), $attrib);?>-->
                        <select name="def_training_status_id" ng-init="def_training_status_id = '<?php echo $def_training_status_id; ?>'" ng-model="def_training_status_id" id="def_training_status_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="def_training_status_id in statuses" value="{{def_training_status_id.def_training_status_id}}">{{def_training_status_id.status}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.def_training_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_trainer',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'trainers' )">
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('label_trainer');?> <span class="mandatory">*</span>
                        <a class="add-new-popup" onclick="">+</a>    
                    </label>
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="trainer_id" onchange="loadtrainerdetails(id)"';
                    echo form_dropdown('trainer_id', $trainerDropdown, set_value('trainer_id', (isset($trainer_id)) ? $trainer_id : ''), $attrib);?>-->
                    <select name="trainer_id" ng-init="trainer_id = '<?php echo $trainer_id; ?>'" ng-model="trainer_id" id="trainer_id" class="form-control" required select2 onchange="loadtrainerdetails()">
                        <option value="">-- Select --</option>  
                        <option ng-repeat="trainer_id in trainers" value="{{trainer_id.trainer_id}}">{{trainer_id.trainer_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.trainer_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_mail');?>
                        <!--<span class="mandatory">*</span>-->
                    </label>
                    <input type="email" name="trainer_email" id="trainer_email" ng-init="trainer_email = '<?php echo $trainer_email; ?>'"  value="<?php echo $trainer_email;?>" class="form-control" ng-model="trainer_email" readonly />
                    <!--<span class="help-block" ng-show="showMsgs && myform.trainer_email.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.trainer_email.$error.email"><?php echo $this->lang->line('email_val');?></span>-->
                    <span class="help-block"><?php echo form_error("trainer_email")?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_contact_number');?>
                    <!--<span class="mandatory">*</span>-->
                    </label>
                    <input type="text" name="trainer_contact" id="trainer_contact" ng-init="trainer_contact = '<?php echo $trainer_contact; ?>'"  value="<?php echo $trainer_contact;?>" class="form-control" ng-model="trainer_contact" readonly/>
                    <!--<span class="help-block" ng-show="showMsgs && myform.trainer_contact.$error.required"><?php echo $this->lang->line('required');?></span>-->
                    <span class="help-block"><?php echo form_error("trainer_contact")?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/pur_supplier',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'suppliers' )">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_supplier');?>
                            <a class="add-new-popup" onclick="">+</a>    
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="supplier_id"';
                        echo form_dropdown('supplier_id', $supplierDropdown, set_value('supplier_id', (isset($supplier_id)) ? $supplier_id : ''), $attrib);?>
                        <select name="supplier_id" ng-init="supplier_id = '<?php echo $supplier_id; ?>'" ng-model="supplier_id" id="supplier_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="supplier_id in suppliers" value="{{supplier_id.supplier_id}}">{{supplier_id.supplier_name}}</option>  
                        </select>
                    </div>
            </div>-->
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_description');?></label>
                    <textarea class="form-control" id="description" name="description" ng-init="description = '<?php echo $description; ?>'"  rows="5" cols="8"><?php echo $description ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"><?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Training/Training_program') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
    </form>
</div>