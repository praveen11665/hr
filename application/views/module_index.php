<style type="text/css">
  .content-box
  {
    padding: 0px !important;
  }
</style>
<?php
if(!empty($module_data))
{
  foreach ($module_data as $row) 
  {
    $category_id          = $row->category_id;
    $category_code        = $row->category_code;
    $category_desc        = $row->category_desc;
    $module_short_content = $row->module_short_content;
    $module_icon          = $row->module_icon;
    $color                = $row->color;
  }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">HR</a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($category_code); ?></li>
                </ol>
            </div>
            <h4 class="page-title"><?php echo ucfirst($category_code); ?></h4>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-lg-4">
      <div class="card-box">
          <h4 class="text-dark header-title m-t-0"><?php echo $module_name; ?></h4>
          <p class="text-muted m-b-30 font-13">
              <?php echo $category_desc; ?>
              
          </p>
          <p>
                      MEP is an end-to-end business solution that helps you to manage all your business information in one application and use it to not only manage operations but also enables you to take informed decisions well in time to remain ahead of your competition. It forms a backbone of your business to add strength, transparency and control to your enterprise.
                    </p>

          
      </div>
  </div>
  <div class="col-lg-8">
      <div class="card-box">
          <h4 class="text-dark header-title m-t-0"><?php echo $module_name; ?></h4>
          <p class="text-muted m-b-30 font-13">
              <?php echo $category_desc; ?>
              
          </p>

          <div class="message-content">
                              <?php
                              $config["nav_tag_open"]          = '<div class="row">';
                              $config["parent_tag_open"]       = '<div class="col-md-6 dash_padding">';
                              $config["parent_anchor_tag"]     = '<a  tabindex="-1" href="%s">%s</a>';
                              $config["children_tag_open"]     = '<ul class="module_operations-submenu">';
                              $config['nav_tag_close']         = '</div>';
                              $config["parent_tag_close"]       = '</div>';

                              $config["item_divider"]          = "<li class='divider'></li>";
                              $this->multi_menu->initialize($config);
                              echo $this->multi_menu->render();
                               ?>
                        </div>
      </div>
  </div>
</div>
