<div class="row">
  <div class="col-sm-12">
      <div class="page-title-box">
          <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url();?>">HR</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
              </ol>
          </div>
          <h4 class="page-title">Dashboard</h4>
      </div>
  </div>
</div>
                 
<div class="row">
  <?php

  //Icon based menu
  foreach ($modules as $key => $value)
  {
    ?>
    <!--<div class="col-md-1 col-sm-3 col-xs-3 feature-icon text-center" style="color: #fff; font-weight:100;  margin-bottom: 20px; float:left; margin-right: 30px; text-align:center">
      <a href="<?php echo base_url().''.strtolower($value['category_code']).'/index'; ?>" style="color:#fff; text-decoration:none">
         <i style="font-size: 20px;" class="<?php echo $value['module_icon']; ?>"></i><br />
         <div style="font-size:16px; text-transform:uppercase;"><?php echo $value['category_code']; ?></div>
         <span><?php echo $value['category_desc']; ?></span>
      </a>
    </div>-->

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3" >
        <div class="card-box tilebox-one">
            <i style="color:<?php echo $value['color']; ?>" class="<?php echo $value['module_icon']; ?> pull-right"></i>
            <!--<h6 class="text-muted text-uppercase mt-0">Orders</h6>-->
            <?php 
              $pageUrl     = urldecode(base_url().''.strtolower($value['category_code'].'/index'));
              $dirCheck    = APPPATH.'controllers/'.strtolower($value['category_code']);
              $checkUrl    = (is_dir($dirCheck)) ? $pageUrl : '#';
              $cursorCss   = (is_dir($dirCheck)) ? 'pointer' : 'not-allowed';
            ?>
            <a style="color: #848181; cursor: <?php echo $cursorCss;?>" href="<?php echo $checkUrl; ?>"><h4 class="m-b-20" data-plugin="counterup"><?php echo strtoupper($value['category_code']); ?></h4></a>
            <span class="text-muted"><?php echo $value['category_desc']; ?></span>
        </div>
    </div>
   <?php
  }

  //Thumnail based menu
  foreach ($modules as $key => $value)
  {
    ?>
    <!--<div class="col-md-1 col-sm-3 col-xs-3 text-center" style="margin:10px 18px 40px 18px;">
      <a href="<?php echo base_url().''.strtolower($value['category_code']).'/index'; ?>" style="color:#fff; text-decoration:none">
        <div class="avatar-circle" style="background: <?php echo $value['color']; ?>">
          <span class="initials"><?php echo strtoupper(substr($value['category_code'],0,2)); ?></span>
        </div>
        <br />
        <span style="color:#fff;"><?php echo strtoupper($value['category_code']); ?></span>
      </a>
    </div>-->
    <!--<div class="col-md-1 col-sm-3 col-xs-3 feature-icon text-center" style="color: #fff; font-weight:100;  margin-bottom: 20px; float:left; margin-right: 30px; text-align:center">
      <a href="<?php echo base_url().''.strtolower($value['category_code']).'/index'; ?>" style="color:#fff; text-decoration:none">
         <i style="font-size: 20px;" class="<?php echo $value['module_icon']; ?>"></i><br />
         <div style="font-size:16px; text-transform:uppercase;"></div>
         <span><?php echo $value['category_desc']; ?></span>
      </a>
    </div>-->
   <?php
  }
  ?>
</div>

