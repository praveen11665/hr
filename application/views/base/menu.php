<?php
$CI =& get_instance();
$CI->load->model('menu_model','menu');
$CI->load->library("multi_menu");

$config["nav_tag_open"]          = '<ul class="submenu">';
$config["parent_tag_open"]       = '<li class="has-submenu">';
$config["parent_anchor_tag"]     = '<li><a tabindex="-1" href="%s">%s</a></li>';
$config["children_tag_open"]     = '<ul class="submenu">';
$config["children_tag_close"]    = '</ul>';
$config["item_divider"]          = "<li class='divider'></li>";
$config["parent_tag_close"]      = '</li>';
$config['nav_tag_close']         = '</ul>';
$CI->multi_menu->initialize($config);
?>
<!-- Navigation Menu-->
<ul class="navigation-menu">
    <li class="has-submenu">
        <a href="<?php echo base_url(); ?>">Desk</a>
        
    </li>
    <li class="has-submenu">
        <a href="<?php echo base_url().'setting/index'; ?>">Settings</a>
            <?php
                /*$stock_items = $CI->menu->getmodulemenus('2');
                $CI->multi_menu->set_items($stock_items);
                echo $CI->multi_menu->render();*/
            ?>
    </li>
    <li class="has-submenu">
        <a href="<?php echo base_url().'hr/index'; ?>">HR</a>
            <?php
                /*$itemsHr = $CI->menu->getmodulemenusHr('4');
                $CI->multi_menu->set_items($items);
                echo $CI->multi_menu->render();*/
            ?>
    </li>
    
    <!--<li class="has-submenu">
        <a href="#"><i class="icon-fire"></i>Components</a>
        <ul class="submenu">
            <li class="has-submenu">
                <a href="#">Email</a>
                <ul class="submenu">
                    <li><a href="email-inbox.html">Inbox</a></li>
                    <li><a href="email-read.html">Read Email</a></li>
                    <li><a href="email-compose.html">Compose Email</a></li>            
                </ul>
            </li>
            <li>
                <a href="widgets.html">Widgets</a>
            </li>      
            <li class="has-submenu">
                <a href="#">Charts</a>
                <ul class="submenu">
                    <li><a href="chart-flot.html">Flot Chart</a></li>
                    <li><a href="chart-morris.html">Morris Chart</a></li>
                    <li><a href="chart-google.html">Google Chart</a></li>
                    <li><a href="chart-chartist.html">Chartist Chart</a></li>
                    <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
                    <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                    <li><a href="chart-knob.html">Jquery Knob</a></li>
                </ul>
            </li>      
            <li class="has-submenu">
                <a href="#">Forms</a>
                <ul class="submenu">
                    <li><a href="form-elements.html">Form Elements</a></li>
                    <li><a href="form-advanced.html">Form Advanced</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-pickers.html">Form Pickers</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                    <li><a href="form-mask.html">Form Masks</a></li>
                    <li><a href="form-summernote.html">Summernote</a></li>
                    <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                    <li><a href="form-x-editable.html">X Editable</a></li>
                    <li><a href="form-uploads.html">Multiple File Upload</a></li>            
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#">Icons</a>
                <ul class="submenu">
                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                    <li><a href="icons-fontawesome.html">Font awesome</a></li>
                    <li><a href="icons-feather.html">Feather Icons</a></li>
                    <li><a href="icons-simpleline.html">Simple Line Icons</a></li>            
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Tables</a>
                <ul class="submenu">
                    <li><a href="tables-basic.html">Basic Tables</a></li>
                    <li><a href="tables-datatable.html">Data Tables</a></li>
                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                    <li><a href="tables-tablesaw.html">Tablesaw Tables</a></li>
                    <li><a href="tables-foo.html">Foo Tables</a></li>            
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Maps</a>
                <ul class="submenu">
                    <li><a href="maps-google.html">Google Maps</a></li>
                    <li><a href="maps-vector.html">Vector Maps</a></li>
                    <li><a href="maps-mapael.html">Mapael Maps</a></li>
                </ul>
            </li>
        </ul>
    </li>   

    <li class="has-submenu">
        <a href="#">HR</a>
        <ul class="submenu megamenu">
            <li>
                <ul>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-cards.html">Cards</a></li>
                    <li><a href="ui-buttons.html">Buttons</a></li>
                    <li><a href="ui-modals.html">Modals</a></li>
                    <li><a href="ui-spinners.html">Spinners</a></li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><a href="ui-ribbons.html">Ribbons</a></li>
                    <li><a href="ui-tooltips-popovers.html">Tooltips & Popover</a></li>
                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                    <li><a href="ui-tabs.html">Tabs</a></li>
                    <li><a href="ui-progressbars.html">Progress Bars</a></li>           
                </ul>
            </li>
            <li>
                <ul>
                    <li><a href="ui-notifications.html">Notification</a></li>
                    <li><a href="ui-grid.html">Grid</a></li> 
                    <li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
                    <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                    <li><a href="ui-range-slider.html">Range Slider</a></li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#"><i class="icon-briefcase"></i>UI Elements</a>
        <ul class="submenu megamenu">
            <li>
                <ul>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-cards.html">Cards</a></li>
                    <li><a href="ui-buttons.html">Buttons</a></li>
                    <li><a href="ui-modals.html">Modals</a></li>
                    <li><a href="ui-spinners.html">Spinners</a></li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><a href="ui-ribbons.html">Ribbons</a></li>
                    <li><a href="ui-tooltips-popovers.html">Tooltips & Popover</a></li>
                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                    <li><a href="ui-tabs.html">Tabs</a></li>
                    <li><a href="ui-progressbars.html">Progress Bars</a></li>           
                </ul>
            </li>
            <li>
                <ul>
                    <li><a href="ui-notifications.html">Notification</a></li>
                    <li><a href="ui-grid.html">Grid</a></li> 
                    <li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
                    <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                    <li><a href="ui-range-slider.html">Range Slider</a></li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="has-submenu">
        <a href="#"><i class="icon-fire"></i>Components</a>
        <ul class="submenu">
            <li class="has-submenu">
                <a href="#">Email</a>
                <ul class="submenu">
                    <li><a href="email-inbox.html">Inbox</a></li>
                    <li><a href="email-read.html">Read Email</a></li>
                    <li><a href="email-compose.html">Compose Email</a></li>            
                </ul>
            </li>
            <li>
                <a href="widgets.html">Widgets</a>
            </li>      
            <li class="has-submenu">
                <a href="#">Charts</a>
                <ul class="submenu">
                    <li><a href="chart-flot.html">Flot Chart</a></li>
                    <li><a href="chart-morris.html">Morris Chart</a></li>
                    <li><a href="chart-google.html">Google Chart</a></li>
                    <li><a href="chart-chartist.html">Chartist Chart</a></li>
                    <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
                    <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                    <li><a href="chart-knob.html">Jquery Knob</a></li>
                </ul>
            </li>      
            <li class="has-submenu">
                <a href="#">Forms</a>
                <ul class="submenu">
                    <li><a href="form-elements.html">Form Elements</a></li>
                    <li><a href="form-advanced.html">Form Advanced</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-pickers.html">Form Pickers</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                    <li><a href="form-mask.html">Form Masks</a></li>
                    <li><a href="form-summernote.html">Summernote</a></li>
                    <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                    <li><a href="form-x-editable.html">X Editable</a></li>
                    <li><a href="form-uploads.html">Multiple File Upload</a></li>            
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#">Icons</a>
                <ul class="submenu">
                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                    <li><a href="icons-fontawesome.html">Font awesome</a></li>
                    <li><a href="icons-feather.html">Feather Icons</a></li>
                    <li><a href="icons-simpleline.html">Simple Line Icons</a></li>            
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Tables</a>
                <ul class="submenu">
                    <li><a href="tables-basic.html">Basic Tables</a></li>
                    <li><a href="tables-datatable.html">Data Tables</a></li>
                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                    <li><a href="tables-tablesaw.html">Tablesaw Tables</a></li>
                    <li><a href="tables-foo.html">Foo Tables</a></li>            
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">Maps</a>
                <ul class="submenu">
                    <li><a href="maps-google.html">Google Maps</a></li>
                    <li><a href="maps-vector.html">Vector Maps</a></li>
                    <li><a href="maps-mapael.html">Mapael Maps</a></li>
                </ul>
            </li>
        </ul>
    </li>-->
</ul>
<!-- End navigation menu -->