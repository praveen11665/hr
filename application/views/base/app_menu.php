<?php
$menu_style='';
switch ($this->dbvars->app_template)
{
    case 'base/base_one':
        $desktop_menu_style='desktop-menu menu-side-compact-w menu-activated-on-hover';
        $mobile_menu_style='menu-mobile menu-activated-on-click color-scheme-dark';
        break;
    case 'base/base_two':
        $desktop_menu_style='desktop-menu menu-side-compact-w menu-activated-on-hover';
        $mobile_menu_style='menu-mobile menu-activated-on-click color-scheme-dark';
        break;
    case 'base/base_three':
        $menu_style='menu-side-compact-w menu-activated-on-hover color-scheme-dark';
        break;
    case 'base/base_four':
        $menu_style='menu-side-compact-w';
        break;
    case 'base/base_five':
        $menu_style='menu-top-w';
        break;
    case 'base/base_six':
        $menu_style='menu-top-w';
        break;
    case 'base/base_seven':
        $menu_style='menu-top-image-w';
        break;
    default:
        $menu_style='menu-side-compact-w';
        break;
}

?>
<!--START - Mobile Menu-->
            <div class="<?php echo $mobile_menu_style; ?>">
                <div class="mm-logo-buttons-w">
                    <a class="mm-logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png"><span><?php echo $this->dbvars->app_name; ?></span></a>
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
                    <!--START - Mobile Menu List-->
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
                    <!--END - Mobile Menu List-->
                    <div class="mobile-menu-magic">
                        <h4>Light Admin</h4>
                        <p>Clean Bootstrap 4 Template</p>
                        <div class="btn-w"><a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a></div>
                    </div>
                </div>
            </div>
            <!--END - Mobile Menu-->
            <!--START - Menu side-->
            <div class="<?php echo $desktop_menu_style; ?>">
                <div class="logo-w">
                    <a class="mm-logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png"><span>Productivity App</span></a>
                </div>
                <div class="menu-and-user">
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w"><img alt="" src="img/avatar1.jpg"></div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name">Albert Einstein</div>
                                <div class="logged-user-role">Administrator</div>
                            </div>
                            <div class="logged-user-menu">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w"><img alt="" src="img/avatar1.jpg"></div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name">Albert Einstein</div>
                                        <div class="logged-user-role">Administrator</div>
                                    </div>
                                </div>
                                <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <ul>
                                    <li><a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a></li>
                                    <li><a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a></li>
                                    <li><a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a></li>
                                    <li><a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a></li>
                                    <li><a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                                </ul>
                            </div>
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
                    <div class="side-menu-magic">
                        <h4>Light Admin</h4>
                        <p>Clean Bootstrap 4 Template</p>
                        <div class="btn-w"><a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a></div>
                    </div>
                </div>
            </div>
            <!--END - Menu side -->
