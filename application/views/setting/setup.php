
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <h6 class="element-header">Master Application Settings</h6>
            <div class="element-box">
                <form action="<?php echo base_url(); ?>settings/setup/" method="post">
                    <h5 class="form-header">Basic Settings</h5>
                    <div class="form-desc">Changing this settings affects the application direclty without any confirmation. Please be sure what you are doing before edit.</div>


                    <?php
                    foreach ($configurations as $key => $value)
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
                      <input <?php echo $required.''.$editable; ?> value="<?php echo $this->dbvars->$keyword_value; ?>" class="form-control" placeholder="Enter email" name="<?php echo $value->keyword; ?>" type="<?php echo $value->field_type; ?>">
                      <?php
                      }
                      else if($field_type=='select')
                      {

                          ?>
                          <select <?php echo $required.''.$editable; ?> class="form-control" name="<?php echo $value->keyword; ?>" id="<?php echo $value->keyword; ?>">
                              <?php
                              if($value->keyword=='timezone')
                              {
                                  $options = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                  foreach ($options as $key => $value)
                                  {
                                      ?>
                                      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                      <?php
                                  }
                              }
                              elseif ($value->keyword=='default_currency')
                              {
                                  foreach ($currencies as $key => $values)
                                  {
                                      ?>
                                      <option <?php echo ($values->code==unserialize($value->value))?'selected':''; ?> value="<?php echo $values->code; ?>"><?php echo $values->code; ?></option>
                                      <?php
                                  }
                              }
                              elseif ($value->keyword=='default_country')
                              {
                                  foreach ($countries as $key => $values)
                                  {
                                      ?>
                                      <option <?php echo ($values->name==unserialize($value->value))?'selected':''; ?> value="<?php echo $values->name; ?>"><?php echo $values->name; ?></option>
                                      <?php
                                  }
                              }
                              else
                              {
                                  $options = $value->options;
                                  foreach (explode(',', $options) as $drop_value)
                                  {
                                      ?>
                                      <option value="<?php echo $drop_value; ?>"><?php echo $drop_value; ?></option>
                                      <?php

                                  }
                              }

                              ?>

                          </select>
                          <?php
                      }

                      ?>
                  </div>
                  <?php
                  }
                  ?>
                    <div class="form-buttons-w">
                        <button class="btn btn-primary" type="submit" name="submit"> Submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
