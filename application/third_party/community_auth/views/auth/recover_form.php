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
                                <!--<span class="zcircle one-edge-shadow "></span><span class="ocircle one-edge-shadow "></span><span class="oocircle one-edge-shadow "></span><span class="tcircle one-edge-shadow "></span>
                                <span class="manufacturing">Portal <!--<sup class="beta">Beta</sup></span>-->
                            </a>
                        </h2>

 <h4 class="auth-header"><?php echo $this->lang->line('recover_form_heading'); ?></h4>
<?php
if( isset( $disabled ) )
{
	echo '
		<div style="border:1px solid red;">
			<p>
				Account Recovery is Disabled.
			</p>
			<p>
				If you have exceeded the maximum login attempts, or exceeded
				the allowed number of password recovery attempts, account recovery
				will be disabled for a short period of time.
				Please wait ' . ( (int) config_item('seconds_on_hold') / 60 ) . '
				minutes, or contact us if you require assistance gaining access to your account.
			</p>
		</div>
	';
}
else if( isset( $banned ) )
{
	echo '
		<div style="border:1px solid red;">
			<p>
				Account Locked.
			</p>
			<p>
				You have attempted to use the password recovery system using
				an email address that belongs to an account that has been
				purposely denied access to the authenticated areas of this website.
				If you feel this is an error, you may contact us
				to make an inquiry regarding the status of the account.
			</p>
		</div>
	';
}
else if( isset( $confirmation ) )
{
	echo '
		<div class="alert alert-success">
			<strong>
				Congratulations, you have created an account recovery link.
			</strong><br>

			<p>
				"We have sent you an email with instructions on how
				to recover your account."

        Please check your email.<br />

        Thank you.
			</p>

		</div>
    <br />
    <br />
	';
}
else if( isset( $no_match ) )
{
	echo '
		<div class="alert alert-success">
				Supplied email did not match any record.
		</div>
	';

	$show_form = 1;
}
else
{
	echo '
		<div class="alert">'.
			$this->lang->line('recover_sentence')
			.'
		</div>
	';

	$show_form = 1;
}
if( isset( $show_form ) )
{
	?>
		<?php echo form_open(); ?>
		 <div class="wrapper-page account-page-full">
            <div class="card">
                <div class="card-block">
		            <div class="form-group col-md-12">
		                <label for=""><?php echo $this->lang->line('recover_email_label'); ?></label>
		                <input required="" maxlength="255" name="email" id="email" autocomplete="off" class="form-control" placeholder="" type="text">
		                <!--<div class="pre-icon os-icon os-icon-mail-01"></div>-->
		            </div>
		            <div class="buttons-w col-md-4">
		                <button type="submit"  id="submit_button" name="submit" class="btn btn-primary"><?php echo $this->lang->line('recover_btn_text'); ?></button>
		            </div>
					<center>
						<br />
						<?php
						$link_protocol = USE_SSL ? 'https' : NULL;
						?>
						<a href="<?php echo site_url('login', $link_protocol); ?>">
						<?php echo $this->lang->line('take_me_to_login'); ?>
						</a>
					</center>
				</div>
			</div>
		</div>		
        </form>

	<?php
}
/* End of file recover_form.php */
/* Location: /community_auth/views/auth/recover_form.php */
