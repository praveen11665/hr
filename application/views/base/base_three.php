<!DOCTYPE html>
<html>
<head>
    <title><?php echo (isset($title))? $title : $this->dbvars->app_name.' - '.$this->dbvars->meta_title;?></title>
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
    <!--DynaTable-->
    <link href="<?php echo base_url(); ?>assets/css/jquery.dynatable.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/zoot_logo.css" rel="stylesheet">
</head>
<body>
    <div class="all-wrapper menu-side">
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
                        <div class="avatar-w"><img alt="" src="<?php echo base_url(); ?>assets/img/man.svg"></div>
                        <div class="logged-user-info-w">
                          <div class="logged-user-name"><?php echo $this->auth_profile_data['first_name'];
                                                              echo isset($this->auth_profile_data['last_name'])?' '.$this->auth_profile_data['last_name']:''; ?></div>
                          <div class="logged-user-role"><?php echo $this->auth_role; ?></div>
                        </div>
                    </div>

                    <ul class="main-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-window-content"></div>
                                </div><span>Dashboard</span></a>
                        </li>
                        <li class="has-sub-menu">
                            <a href="javascript:void(0);">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-grid-squares"></div>
                                </div><span>Settings</span></a>
                            <ul class="sub-menu">
                              <li><a href="<?php echo base_url(); ?>setting/modules/create">Module Settings</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/modules/operation">Module Operations</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/roles/create">Roles</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/users/create">Users</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/app/setup/">App Settings</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/app/email/">Email Settings</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/app/sms/">SMS Settings</a></li>
                              <li><a href="<?php echo base_url(); ?>setting/app/push/">Push Notification</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="desktop-menu menu-side-compact-w menu-activated-on-hover color-scheme-dark">
                <div class="logo-w">
                    <a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png"></a>
                </div>
                <div class="menu-and-user">
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w"><img alt="" src="<?php echo base_url(); ?>assets/img/man.svg"></div>
                            <div class="logged-user-menu">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w"><img alt="" src="<?php echo base_url(); ?>assets/img/man.svg"></div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name"><?php echo $this->auth_profile_data['first_name'];
                                        echo isset($this->auth_profile_data['last_name'])?' '.$this->auth_profile_data['last_name']:''; ?></div>
                                        <div class="logged-user-role"><?php echo $this->auth_role; ?></div>
                                    </div>
                                </div>
                                <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <ul>

                                    <li><a href="<?php echo base_url(); ?>profile"><i class="os-icon os-icon-user-male-circle2"></i><span>My Profile</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>logout"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="main-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <div class="icon-w"><i class="os-icon os-icon-window-content"></i></div>
                            </a>
                        </li>

                        <li class="has-sub-menu">
                            <a href="javascript:void(0);">
                                <div class="icon-w"><i class="os-icon os-icon-grid-squares"></i></div>
                            </a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-title">Settings</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-grid-squares"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                      <li><a href="<?php echo base_url(); ?>setting/modules/create">Module Settings</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/Moduleoperations/add">Module Operations</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/roles/add">Roles</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/users/create">Users</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/app/setup/">App Settings</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/app/email/">Email Settings</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/app/sms/">SMS Settings</a></li>
                                      <li><a href="<?php echo base_url(); ?>setting/app/push/">Push Notification</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="has-sub-menu">
                            <a href="javascript:void(0);">
                                <div class="icon-w"><i class="os-icon os-icon-hierarchy-structure-2"></i></div>
                            </a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-title">Masters</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-hierarchy-structure-2"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                      <li><a href="<?php echo base_url(); ?>master/Discipline/add">Discipline</a></li>
                                      <li><a href="<?php echo base_url(); ?>master/UOM/add">UOM</a></li>
                                      <li><a href="<?php echo base_url(); ?>master/Activity/add">Activity</a></li>
                                      <li><a href="<?php echo base_url(); ?>master/WorkmanCategory/add">Workman Category</a></li>
                                      <li><a href="<?php echo base_url(); ?>master/Sites/add">Sites</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- END - Menu side compact -->
            <div class="content-w">
                <!-- START - Breadcrumbs -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><span>Good Day <?php echo $this->auth_profile_data['first_name'];
                                                        echo isset($this->auth_profile_data['last_name'])?' '.$this->auth_profile_data['last_name']:''; ?>! </span></li>
                    <li class="breadcrumb-item"><span id="app_clock"></span></li>
                </ul>
                <!-- END - Breadcrumbs -->
                <div class="content-i">
                    <div class="content-box">

                        <?php echo (isset($content)?$content:''); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
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
    <!--DynaTable-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.dynatable.js"></script>

<?php
require_once(APPPATH."views/base/common_js.php");
?>
</body>
</html>
