<!DOCTYPE html>
<html>


<head>
    <title><?php echo (isset($title))? $title : $this->dbvars->app_name.' - '.$this->dbvars->meta_title;?>s</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="AlphasoftZ Solutions" name="author">
    <meta content="Cloud driven communication platform for educational institutions" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url(); ?>assets/favicon.png" rel="shortcut icon">
    <link href="<?php echo base_url(); ?>assets/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="http://fast.fonts.net/cssapi/175a63a1-3f26-476a-ab32-4e21cbdb8be2.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/mainc010.css?version=3.2.1" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/overwrite.css" rel="stylesheet">

    
    <link href="<?php echo base_url(); ?>assets/css/jquery.dynatable.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/desktop.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    
    <link href="<?php echo base_url(); ?>/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    
    <script src="<?php echo base_url(); ?>assets/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <link href="<?php echo base_url(); ?>/assets/bower_components/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/zoot_logo.css" rel="stylesheet">
</head>

<body>
    <div class="all-wrapper menu-top">
        <div class="layout-w">
            <div class="menu-mobile menu-activated-on-click color-scheme-dark">
                <div class="mm-logo-buttons-w">
                    <a class="mm-logo" href="<?php echo base_url(); ?>"><span class="zcircle one-edge-shadow "></span><span class="ocircle one-edge-shadow "></span><span class="oocircle one-edge-shadow "></span><span class="tcircle one-edge-shadow "></span>
    <span class="manufacturing">Manufacturing <sup class="beta">Beta</sup></span></a>
                    <div class="mm-buttons">
                        <div class="content-panel-open">
                            <div class="os-icon os-icon-grid-circles"></div>
                        </div>
                        <div class="mobile-menu-trigger">
                            <div class="os-icon os-icon-hamburger-menu-1"></div>
                        </div>
                    </div>
                </div>
                <div class="menu-and-user">
                    <div class="logged-user-w">
                        <div class="avatar-w"><img alt="" src="img/avatar1.jpg"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name">Albert Einstein</div>
                            <div class="logged-user-role">Administrator</div>
                        </div>
                    </div>

                    <ul class="main-menu">
                        <li class="has-sub-menu">
                            <a href="index.html">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-window-content"></div>
                                </div><span>Dashboard</span></a>
                            <ul class="sub-menu">
                                <li><a href="index.html">Dashboard 1</a></li>
                                <li><a href="apps_projects.html">Dashboard 2</a></li>
                                <li><a href="layouts_menu_top_image.html">Dashboard 3</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-hierarchy-structure-2"></div>
                                </div><span>Menu Styles</span></a>
                            <ul class="sub-menu">
                                <li><a href="layouts_menu_side.html">Side Menu Light</a></li>
                                <li><a href="layouts_menu_side_dark.html">Side Menu Dark</a></li>
                                <li><a href="layouts_menu_side_compact.html">Compact Side Menu</a></li>
                                <li><a href="layouts_menu_side_compact_dark.html">Compact Menu Dark</a></li>
                                <li><a href="layouts_menu_top.html">Top Menu Light</a></li>
                                <li><a href="layouts_menu_top_dark.html">Top Menu Dark</a></li>
                                <li><a href="apps_projects.html">Side and Top Menu</a></li>
                                <li><a href="layouts_menu_top_image.html">Top Menu Image</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-delivery-box-2"></div>
                                </div><span>Applications</span></a>
                            <ul class="sub-menu">
                                <li><a href="apps_email.html">Email Application</a></li>
                                <li><a href="apps_projects.html">Projects List</a></li>
                                <li><a href="apps_full_chat.html">Chat Application</a></li>
                                <li><a href="apps_pipeline.html">CRM Pipeline <strong class="badge badge-danger">New</strong></a></li>
                                <li><a href="misc_chat.html">Popup Chat</a></li>
                                <li><a href="misc_calendar.html">Calendar</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-newspaper"></div>
                                </div><span>Pages</span></a>
                            <ul class="sub-menu">
                                <li><a href="misc_invoice.html">Invoice</a></li>
                                <li><a href="front_home.html">Front Site <strong class="badge badge-danger">New</strong></a></li>
                                <li><a href="misc_charts.html">Charts</a></li>
                                <li><a href="auth_login.html">Login</a></li>
                                <li><a href="auth_register.html">Register</a></li>
                                <li><a href="auth_lock.html">Lock Screen</a></li>
                                <li><a href="misc_pricing_plans.html">Pricing Plans</a></li>
                                <li><a href="misc_error_404.html">Error 404</a></li>
                                <li><a href="misc_error_500.html">Error 500</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-user-male-circle"></div>
                                </div><span>User Profiles</span></a>
                            <ul class="sub-menu">
                                <li><a href="users_profile_big.html">Big Profile</a></li>
                                <li><a href="users_profile_small.html">Compact Profile</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-tasks-checked"></div>
                                </div><span>Forms</span></a>
                            <ul class="sub-menu">
                                <li><a href="forms_regular.html">Regular Forms</a></li>
                                <li><a href="forms_validation.html">Form Validation</a></li>
                                <li><a href="forms_wizard.html">Form Wizard</a></li>
                                <li><a href="forms_uploads.html">File Uploads</a></li>
                                <li><a href="forms_wisiwig.html">Wisiwig Editor</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-grid-squares"></div>
                                </div><span>Tables</span></a>
                            <ul class="sub-menu">
                                <li><a href="tables_regular.html">Regular Tables</a></li>
                                <li><a href="tables_datatables.html">Data Tables</a></li>
                                <li><a href="tables_editable.html">Editable Tables</a></li>
                            </ul>
                        </li>
                        <li class="has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-robot-1"></div>
                                </div><span>Icons</span></a>
                            <ul class="sub-menu">
                                <li><a href="icon_fonts_simple_line_icons.html">Simple Line Icons</a></li>
                                <li><a href="icon_fonts_themefy.html">Themefy Icons</a></li>
                                <li><a href="icon_fonts_picons_thin.html">Picons Thin</a></li>
                                <li><a href="icon_fonts_dripicons.html">Dripicons</a></li>
                                <li><a href="icon_fonts_eightyshades.html">Eightyshades</a></li>
                                <li><a href="icon_fonts_entypo.html">Entypo</a></li>
                                <li><a href="icon_fonts_font_awesome.html">Font Awesome</a></li>
                                <li><a href="icon_fonts_foundation_icon_font.html">Foundation Icon Font</a></li>
                                <li><a href="icon_fonts_metrize_icons.html">Metrize Icons</a></li>
                                <li><a href="icon_fonts_picons_social.html">Picons Social</a></li>
                                <li><a href="icon_fonts_batch_icons.html">Batch Icons</a></li>
                                <li><a href="icon_fonts_dashicons.html">Dashicons</a></li>
                                <li><a href="icon_fonts_typicons.html">Typicons</a></li>
                                <li><a href="icon_fonts_weather_icons.html">Weather Icons</a></li>
                                <li><a href="icon_fonts_light_admin.html">Light Admin</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="mobile-menu-magic">
                        <h4>Light Admin</h4>
                        <p>Clean Bootstrap 4 Template</p>
                        <div class="btn-w"><a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a></div>
                    </div>
                </div>
            </div>

            <div class=" desktop-menu menu-top-w menu-activated-on-hover">
                <div class="menu-top-i">
                  <div class="logo-w">
                      <a class="logo" href="<?php echo base_url(); ?>"><span class="zcircle one-edge-shadow "></span><span class="ocircle one-edge-shadow "></span><span class="oocircle one-edge-shadow "></span><span class="tcircle one-edge-shadow "></span>
    <span class="manufacturing">Manufacturing <sup class="beta">Beta</sup></span></a>
                  </div>
                    <ul class="main-menu" style="float:right">
                      <li>
                          <a href="<?php echo base_url(); ?>">
                              <div class="icon-w">
                                <div class="os-icon os-icon-window-content"></div>
                              </div> <span>Desk</span>
                          </a>
                      </li>
                    </ul>
                    <div class="top-menu-secondary">
                    <div class="top-menu-controls">
                        <div class="element-search hidden-lg-down">
                            <input placeholder="Start typing to search..." type="text">
                        </div>
                        <div class="top-icon top-search hidden-xl-up"><i class="os-icon os-icon-ui-37"></i></div>
                     
                        <div class="messages-notifications os-dropdown-trigger os-dropdown-center"><i class="os-icon os-icon-mail-14"></i>
                            <div class="new-messages-count">12</div>
                            <div class="os-dropdown light message-list">
                                <div class="icon-w"><i class="os-icon os-icon-mail-14"></i></div>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <div class="user-avatar-w"><img alt="" src="img/avatar1.jpg"></div>
                                            <div class="message-content">
                                                <h6 class="message-from">John Mayers</h6>
                                                <h6 class="message-title">Account Update</h6></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-avatar-w"><img alt="" src="img/avatar2.jpg"></div>
                                            <div class="message-content">
                                                <h6 class="message-from">Phil Jones</h6>
                                                <h6 class="message-title">Secutiry Updates</h6></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-avatar-w"><img alt="" src="img/avatar5.jpg"></div>
                                            <div class="message-content">
                                                <h6 class="message-from">Bekky Simpson</h6>
                                                <h6 class="message-title">Vacation Rentals</h6></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-avatar-w"><img alt="" src="img/avatar4.jpg"></div>
                                            <div class="message-content">
                                                <h6 class="message-from">Alice Priskon</h6>
                                                <h6 class="message-title">Payment Confirmation</h6></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                     
                        <div class="top-icon top-settings os-dropdown-trigger os-dropdown-center"><i class="os-icon os-icon-ui-46"></i>
                            <div class="os-dropdown">
                                <div class="icon-w"><i class="os-icon os-icon-ui-46"></i></div>
                                <ul>
                                    <li><a href="#"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a></li>
                                    <li><a href="#"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a></li>
                                    <li><a href="#"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a></li>
                                    <li><a href="#"><i class="os-icon os-icon-ui-15"></i><span>Deactivate Account</span></a></li>
                                </ul>
                            </div>
                        </div>
                     
                        <div class="logged-user-w">
                            <div class="logged-user-i">
                                <div class="avatar-w"><img alt="" src="<?php echo base_url(); ?>assets/img/man.svg"></div>
                                <div class="logged-user-menu">
                                    <div class="logged-user-avatar-info">
                                        <div class="avatar-w"><img alt="" src="<?php echo base_url(); ?>assets/img/man.svg"></div>
                                        <div class="logged-user-info-w">
                                            <div class="logged-user-name">
                                              <?php echo $this->auth_profile_data['first_name'];
                                                    echo isset($this->auth_profile_data['last_name'])?' '.$this->auth_profile_data['last_name']:'';
                                              ?>
                                            </div>
                                            <div class="logged-user-role"><?php echo $this->auth_role; ?></div>
                                        </div>
                                    </div>
                                    <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                    <ul>
                                        <li><a href="#"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a></li>
                                        <li><a href="#"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a></li>
                                        <li><a href="#"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a></li>
                                        <li><a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>logout"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                  </div>


                </div>
            </div>
            <?php
            if($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='')
            {
              ?>
              <style>
              .breadcrumb li span
              {
                color:#fff;
              }
              .content-w
              {
                background-color:#000;
                 background-repeat: no-repeat;
                 background-position: bottom;
                 background-image: url('<?php echo base_url(); ?>assets/img/desk_bg_1.jpg');
              }
              .element-header
              {
                color:#fff;
              }
              .user-title
              {
                color:#fff;
              }
              .user-role
              {
                color:#ccc !important;
              }
              .user-action
              {
                color:#0777ff !important;
              }
              </style>

              <?php
            }
            else {
              ?>
              <style>
              .content-box{
                background: #f3eeee;
              }
              .breadcrumb
              {
                background: #f3eeee;
              }
              </style>
              <?php
            }
            ?>
            <div class="content-w" id="image-head">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><span>Good Day <?php echo $this->auth_profile_data['first_name'];
                                                        echo isset($this->auth_profile_data['last_name'])?' '.$this->auth_profile_data['last_name']:''; ?>! </span></li>
                    <li class="breadcrumb-item"><span id="app_clock"></span></li>
                </ul>
                
                <div class="content-i">
                    <div class="content-box">
                      <?php echo (isset($content)?$content:''); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/dropzone/dist/dropzone.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/editable-table/mindmup-editabletable.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mainc010.js?version=3.2.1"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.dynatable.js"></script>
    
    
</body>
<?php
require_once(APPPATH."views/base/common_js.php");
?>
    
</html>