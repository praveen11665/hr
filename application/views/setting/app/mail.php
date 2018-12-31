

 <div class="row">
     <div class="col-lg-12">
         <div class="element-wrapper">
             <h6 class="element-header">Email Settings</h6>
             <div class="element-box">
                 <form action="<?php echo base_url(); ?>setting/app/email/" method="post">
                     <h5 class="form-header">Email SMTP Settings</h5>
                     <div class="form-desc">Changing this settings affects the application direclty without any confirmation. Please be sure what you are doing before edit.</div>

                     <?php
                     if(isset($message))
                     {
                       ?>
                       <div class="alert alert-success">
                          <p><?php echo $message; ?></p>
                       </div>

                       <?php
                     }
                     ?>
                     <?php
                     foreach ($mail_configurations as $key => $value)
                     {
                         $field_type = $value->field_type;
                         $required=($value->required=='1')?'required=""':'';
                         $editable=($value->read_only=='1')?'readonly=""':'';
                         $field_value=$value->value;
                         $keyword_value=$value->keyword;


                     ?>

                     <div class="form-group">
                         <label for=""><?php echo ucwords(str_replace('_', ' ', $value->keyword)); ?></label>
                         <?php
                         if($field_type =='text' || $field_type =='number' || $field_type== 'email')
                         {

                         ?>
                         <input <?php echo $required.''.$editable; ?> value="<?php echo $this->dbvars->$keyword_value; ?>" class="form-control" placeholder="Enter <?php echo ucwords(str_replace('_', ' ', $value->keyword)); ?>" name="<?php echo $value->keyword; ?>" type="<?php echo $value->field_type; ?>">
                         <?php
                         }

                         if($field_type=="textarea")
                         {
                           ?>

                           <textarea <?php echo $required.''.$editable; ?> cols="80" rows="10" id="ckeditor<?php echo $value->conf_id;?>" name="<?php echo $value->keyword; ?>" style=""><?php echo $this->dbvars->$keyword_value; ?></textarea>
                           <?php
                         }
                         ?>
                     </div>
                     <?php
                     }
                     ?>
                     <div class="form-group">

                     </div>
                     <div class="form-buttons-w">
                         <button class="btn btn-primary" type="submit" name="submit"> Update Settings</button>
                     </div>


                 </form>
             </div>
         </div>
     </div>
 </div>
