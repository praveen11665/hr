<style type="text/css">
  .content-box
  {
    padding: 0px !important;
  }
</style>
<div class="app-email-w">
    <div class="app-email-i">
      <div class="ae-list-w">
        <div class="ae-list">
          <div class="ae-item">

              <div class="aei-content">
                  <h6 class="aei-title">HR Module</h6>
                  <div class="aei-sub-title">About HR</div>
                  <div class="aei-text">

                    <p>
                      Modules are the components of ZootERP. In the industry, it can be called as APPS or Modules. Accounting, HR, Marketing ..etc are the best examples of Modules. The purpose of creating this module management is to automate role based permission for users (ZootERP’s Pricing model is based upon the number of users).
                    </p>
                  </div>
              </div>
            </div>
            <div class="ae-item">
              <div class="aei-content">
                  <div class="aei-sub-title">Help Documents</div>
                  <div class="aei-text">
                    <br />
                    <a href="">How to create employee?</a>
                    <br />
                    <a href="">Is Payroll available? How can i access it?</a>
                    <br />
                    <a href="">How to add fingerprint Machine?</a>
                    <br />
                    <a href="">Manual and Auto Attendence configuration</a>
                    <br />
                    <a href="">How to create employee?</a>
                    <br />
                    <a href="">Is Payroll available? How can i access it?</a>
                    <br />
                    <a href="">How to add fingerprint Machine?</a>
                    <br />
                    <a href="">Manual and Auto Attendence configuration</a>
                  </div>
              </div>
            </div>
            <div class="ae-item">
              <div class="aei-content">
                  <div class="aei-sub-title">Watch Video</div>
                  <div class="aei-text">
                    <br>
                    <iframe width="320" height="200" src="https://www.youtube.com/embed/enMumwvLAug" frameborder="0" allowfullscreen></iframe>
                  </div>
              </div>
            </div>
        </div>

      </div>

        <div class="ae-content-w">
            <div class="aec-head">
                <div class="actions-left"><a class="highlight" href="#"><i class="os-icon os-icon-ui-02"></i></a> &nbsp; Human Resource Module</div>
                <div class="actions-right">
                    <!--<div class="aeh-actions"><a href="#"><i class="os-icon os-icon-ui-44"></i></a><a class="separate" href="#"><i class="os-icon os-icon-ui-15"></i></a><a href="#"><i class="os-icon os-icon-common-07"></i></a><a href="#"><i class="os-icon os-icon-mail-19"></i></a></div>
                    <div class="user-avatar"><img alt="" src="img/avatar3.jpg"></div>-->
                </div>
            </div>
            <div class="ae-content">

                    <div class="aec-full-message">

                        <div class="message-content">
                              <?php

                              $config["nav_tag_open"]          = '<div class="row">';
                        			$config["parent_tag_open"]       = '<div class="col-md-6 dash_padding">';
                        			$config["parent_anchor_tag"]     = '<a tabindex="-1" href="%s">%s</a>';
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
    </div>
    </div>
</div>
