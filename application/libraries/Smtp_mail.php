<?php
/**
* This is a SMTP EMAIL LIBRARY which is very helpful for sending HTML Email using
* GMAIL Account from your server.
* Author: Ganesh Ananthan
* Date: 10/08/2017
* TODO:
*   Need to add a new function for sending email without template
*/

class Smtp_mail {
    const TABLE = 'configuration';
    //Table where variables will be stored.

    private $data;
    private $ci;

    function __construct()
    {
        $this->ci =& get_instance();
        $q = $this->ci->db->get(self::TABLE);
        foreach ($q->result() as $row)
        {
                $this->data[$row->keyword] = unserialize(base64_decode($row->value));
               //echo unserialize(base64_decode($row->value));
        }
        $q->free_result();
    }

    /**
    *     Function: send_with_template
    *     param : $email_array(to - To email address,
    *                          cc - CC Email Address bcc,
    *                          bcc - BCC Email Address,
    *                          subject - Email Subject,
    *                          body - array ( greeting - (Example: Hello Steve,)
    *                                         content - HTML Content with tags
    *                                         thanks_text - (Example: Thanks & Regards, <br /> Steve Jobs)
    *                                         link_text - If you want a button you should use this. (Example: Confirm Email)
    *                                         link_url - URL to navigate once the button is clicked
    *                                         link_button_color - By default button will be in blue color, if you want you can use this to change the color (Example: #f9f9f9;)) Ends with semicolon.
    *
    *     View file location: third_party/views/email/transactional_template.php
    *
    *     NOTE: if you dont want to use configuration table.
    *
    *     1. Change all $this->data['variable'] and specify the data directly.
    *     2. Change $this->dbvars-keyword; to your data directly.
    *
    *    Example Configuration using GMAIL. (Single and double quotes are important)
    *     $config = Array(
    *                        'protocol' => 'smtp',
    *                        'smtp_host' => 'ssl://smtp.gmail.com',
    *                        'smtp_port' => 465,
    *                        'smtp_user' => '- your gmail account --',
    *                        'smtp_pass' => '- your gmail password --',
    *                        'mailtype'  => 'html',
    *                        'charset'   => 'iso-8859-1'
    *                    	);
    *     FIXES:
    *     if your email is showing the HTML code use the following line
    *     $this->ci->email->set_mailtype('html');
    *
    *     DEBUG: to debug use the follwing line
    *     echo $this->email->print_debugger();
    *
    *     GMAIL SECUTIRTY POLICY:
    *     TO USE GMAIL YOU NEED TO ENABLE LESS SECURE FOR THE GMAIL ADDRESS (SENDER)
    *     https://myaccount.google.com/lesssecureapps
    *************/

    public function send_with_template($email_array)
    {
        $config = array(
        'protocol' => $this->data['protocol'],
        'smtp_host' => $this->data['smtp_host'],
        'smtp_port' => $this->data['smtp_port'],
        'smtp_user' => $this->data['smtp_user'],
        'smtp_pass' => $this->data['smtp_pass'],
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1',
        'wordwrap'  => TRUE,
    	 );
        $this->ci->load->library('email',$config);
    		$this->ci->email->set_newline("\r\n");
    		$this->ci->email->from($this->data['app_email'], $this->data['app_name']);
        $this->ci->email->to($email_array['to']);
        $this->ci->email->subject($email_array['subject']);
        $body = $this->ci->load->view('email/transactional_template',$email_array['body'],TRUE);
        $this->ci->email->message($body);
        $this->ci->email->set_mailtype('html');
        if(isset($email_array['cc']))
        {
          $this->ci->email->cc($email_array['cc']);
        }
        if(isset($email_array['bcc']))
        {
          $this->ci->email->bcc($email_array['bcc']);
        }
        $this->ci->email->send();
    		$result = $this->ci->email->send();
        return $result;
    }
}
 ?>
