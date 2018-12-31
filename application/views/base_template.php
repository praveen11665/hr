<div  ng-cloak ng-app="myApp">
    <div class="row">
        <div class="col-lg-12">
        	<div class="element-wrapper" id="addNewPopupAngular" ng-controller="ModalCtrl as $ctrl" class="modal-angular">
                <?php
                    if($buttonview)
                    {
                        //'addNewAsLink'        => 1; If you want new button as a link, mention this key in controller
                        $href     = ($addNewAsLink) ? "href='".base_url($formUrl)."'" : '';
                        ?>   
                        <div class="btn-group pull-right" >
                            <a  <?php echo $href;?> class="btn btn-custom btn-rounded w-md waves-effect waves-light mb-4 pull-right" ng-click="$ctrl.open('lg', '', '<?php echo base_url($formUrl);?>' )"><i class="mdi mdi-plus-circle"></i>  New</a>
                        </div>  
                        <?php
                        /*
                            <span class="pull-right">
                                <!--<a <?php echo $href;?> class="btn btn-primary text-white" onclick="addNewPop('<?php echo $formUrl;?>');">+ New</a>-->
                                <a <?php echo $href;?> type="button" class="btn btn-primary text-white" ng-click="$ctrl.open('lg', '', '<?php echo base_url($formUrl);?>' )">+ New</a>                        
                            </span>
                        */
                        ?>
                        <?php
                    }
                ?>
                <h6 class="element-header"><?php echo $form_heading;?></h6>                
    			<?php
                if ($this->session->userdata('existMessage')) 
                {
                    $employeeArr = $this->session->userdata('employeeArr');
                    ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->userdata('existMessage'); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Naming Series</th>
                                        <th>Employee Code</th>
                                        <th>Employee Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Company</th>                                       
                                        <th>Upload Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($employeeArr as $key => $row) 
                                {                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo stripslashes(str_replace("+AC0", "", $row[4])); ?></td>
                                        <td><?php echo $row[5]; ?></td>                                       
                                        <td><b style="color: #e91e63;"><?php echo $row['status']; ?></b></td>
                                    </tr>
                                    <?php
                                }
                               ?>
                               </tbody>
                           </table>
                        </div>
                    <?php
                }

    			if($this->session->flashdata('msg') != '')
    			{
    				?>
    					<div class="alert alert-<?php echo $this->session->flashdata('alertType');?>" id="alert-message">
    					    <?php echo $this->session->flashdata('msg'); ?>
    					</div>
    				<?php
    			}

    			// Form View
    			if($form_view != '')
    			{
    				?>
    		            <div class="element-box">
    		            	<h4 class="form-header"><?php echo $form_title;?>  </h4>
    		               <!--  <div class="form-desc"><?php echo $form_description;?></div>-->
    						<?php echo $form_view;?>
    		            </div>	
    				<?php
    			}

    			// List View
    			if($list_view)
    			{
    				?>
    					<div class="element-box">
    					    <div class="row">
    					        <div class="col-sm-9">
                                
    					        	<!--<h5 class="form-header"><?php echo $list_title;?></h5>-->

    					        </div>
    					    </div>
    					    <div class="form-desc"><?php echo $list_description;?></div>
    						<?php echo $this->table->generate();?>
    					</div>    	
    				<?php
    			}
    			?>
    		</div>
        </div>
    </div>
</div>