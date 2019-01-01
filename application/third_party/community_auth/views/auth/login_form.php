
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="wrapper-page account-page-full">
            <div class="card">
                <div class="card-block">
                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="<?php echo base_url(); ?>" class="text-dark">
									<a href="<?php echo base_url(); ?>" class="manufacturing"><img src="<?php echo base_url('global/assets/images/logo.png'); ?>" width="60%"></a>

                                    <!--<span class="zcircle one-edge-shadow "></span><span class="ocircle one-edge-shadow "></span><span class="oocircle one-edge-shadow "></span><span class="tcircle one-edge-shadow "></span>
                                    <span class="manufacturing">Manufacturing <sup class="beta">Beta</sup></span>-->
                                </a>
                            </h2>
<?php
	if( ! isset( $optional_login ) )
	{
	    ?>
	        <h4 class="auth-header"><?php echo $this->lang->line('login_form_heading'); ?></h4>    
	    <?php
	}
	?>
<?php

if( ! isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
		echo '
			<div class="alert alert-danger">

					<strong>Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ' attempts:</strong><br /> Invalid Username, Email Address, or Password.
				<br />
					Username, email address and password are all case sensitive.
			</div>
		';
	}

	if( $this->input->get('logout') )
	{
		echo '
			<div class="alert alert-success">'.
			$this->lang->line('logout_sentence')
			.'</div>
		';
	}
	echo form_open(isset($login_url)?$login_url:''); 
?>

                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('login_username'); ?></label>
                    <input value="appadmin" maxlength="255" name="login_string" id="login_string" autocomplete="off" class="form-control" placeholder="<?php echo $this->lang->line('username_placeholder'); ?>" type="text">
                    
                </div>
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('login_password'); ?></label>
                    <input value="Password!23" name="login_pass" id="login_pass" autocomplete="off"  class="form-control" placeholder="<?php echo $this->lang->line('password_placeholder'); ?>" type="password" 
                    <?php 
					if( config_item('max_chars_for_password') > 0 )
					{
						echo 'maxlength="' . config_item('max_chars_for_password') . '"'; 		
					}
					?>
					readonly="readonly" onfocus="this.removeAttribute('readonly');"
					>
                    
                </div>
                <div class="buttons-w">
                    <button type="submit"  id="submit_button" name="submit" class="btn btn-block btn-custom waves-effect waves-light" value="Login"><?php echo $this->lang->line('login_btn_text'); ?></button>
                    <?php
						if( config_item('allow_remember_me') )
						{
					?>
	                    <div class="form-check-inline">
	                        <label for="remember_me" class="form-check-label">
	                            <input class="form-check-input" id="remember_me" name="remember_me" value="yes" type="checkbox"><?php echo $this->lang->line('login_remember'); ?></label>
	                    </div>
	                <?php
						}
					?>
                </div>
                
                <?php
				$link_protocol = USE_SSL ? 'https' : NULL;
			?>
            </form>
            
	<div>



		

		<!--<p>
			<?php
				$link_protocol = USE_SSL ? 'https' : NULL;
			?>
			<a href="<?php echo site_url('examples/recover', $link_protocol); ?>">
				Can't access your account?
			</a>
		</p>-->


	</div>
</form>

<?php

	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div class="alert alert-danger">
				<strong>
					Excessive Login Attempts
				</strong><br />
				
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.<br />
				
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
					<br />
					Please use the <a href='.base_url().'"/auth/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
			</div>
		';
	}

/* End of file login_form.php */
/* Location: /community_auth/views/auth/login_form.php */ 


?>
<!-- Begin page -->



                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted"><?php echo $this->lang->line('cant_access'); ?> <a href="<?php echo site_url('recover', $link_protocol); ?>" class="text-dark m-l-5"><b>Reset Password</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="account-copyright">HR  &copy; <?php echo date('Y'); ?>. All rights reserved.</p>
            </div>

        </div>