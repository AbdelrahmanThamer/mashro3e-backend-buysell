<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Send Booking Request Email to hotel
 * @param  [type] $booking_id [description]
 * @return [type]             [description]
 */
if ( !function_exists( 'send_user_register_email' )) {

  function send_user_register_email( $user_id, $subject = "" )
  {
    // get ci instance
    $CI =& get_instance();
    
    $user_info_obj = $CI->User->get_one($user_id);

    $user_name  = $user_info_obj->user_name;
    $user_email = $user_info_obj->user_email;
    $code = $user_info_obj->code;
    

    $to = $user_email;

	$sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi = get_msg('hi_label');
    $new_user_acc = get_msg('new_user_acc');
    $verify_code = get_msg('verify_code_label');
    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi} {$user_name},</p>

<p>{$new_user_acc}</p>

<p>
{$verify_code} : {$code}<br/>
</p>


<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;
    
    
    

    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}

if ( !function_exists( 'send_contact_us_emails' )) {

  function send_contact_us_emails( $contact_id, $subject = "" )
  {
    // get ci instance  
    $CI =& get_instance();
    
    $contact_info_obj = $CI->Contact->get_one($contact_id);

    $contact_name  = $contact_info_obj->contact_name;
    $contact_email = $contact_info_obj->contact_email;
    $contact_phone = $contact_info_obj->contact_phone;
    $contact_msg   = $contact_info_obj->contact_message;

    $to = $CI->Backend_config->get_one('be1')->receive_email;

    $sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi_admin  = get_msg('hi_admin_label');
    $name = get_msg('name_label');
    $email = get_msg('email_label');
    $phone = get_msg('phone_label');
    $message = get_msg('msg_label');
    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi_admin},</p>

<p>
{$name} : {$contact_name}<br/>
{$email} : {$contact_email}<br/>
{$phone} : {$contact_phone}<br/>
{$message} : {$contact_msg}<br/>
</p>


<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;
    
    
    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}

if ( !function_exists( 'send_user_register_email_without_verify' )) {

  function send_user_register_email_without_verify( $user_id, $subject = "" )
  {
     // get ci instance
    $CI =& get_instance();
    
    $user_info_obj = $CI->User->get_one($user_id);

    $user_name  = $user_info_obj->user_name;
    $user_email = $user_info_obj->user_email;
    
    

    $to = $user_email;

    $sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi = get_msg('hi_label');
    $user_auto_approved = get_msg('user_auto_approved');
    
    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi} {$user_name},</p>

<p>{$user_auto_approved}</p>

<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;
    
    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}


if ( !function_exists( 'send_user_blue_mark_email' )) {

  function send_user_blue_mark_email( $user_id, $subject = "", $is_verify_blue_mark )
  {
     // get ci instance
    $CI =& get_instance();
    
    $user_info_obj = $CI->User->get_one($user_id);

    $user_name  = $user_info_obj->user_name;
    $user_email = $user_info_obj->user_email;
    
    

    $to = $user_email;

    $sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi = get_msg('hi_label');

    if ($is_verify_blue_mark == 1) {
        $admin_verify_blue_mark = get_msg('approve_blue_mark');
    } else {
        $admin_verify_blue_mark = get_msg('reject_blue_mark');
    }
    
    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi} {$user_name},</p>

<p>{$admin_verify_blue_mark}</p>

<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;

    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}


if ( !function_exists( 'send_item_approval_email' )) {

  function send_item_approval_email( $user_id, $subject = "" )
  {
     // get ci instance
    $CI =& get_instance();
    
    $user_info_obj = $CI->User->get_one($user_id);

    $user_name  = $user_info_obj->user_name;
    $user_email = $user_info_obj->user_email;
    $to = $user_email;

    $sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi = get_msg('hi_label');

    if($item_status == 1) {
      $admin_approval = get_msg( 'approve_item' );
    } else if ($item_status == 2) {
      $admin_approval = get_msg( 'disable_item' );
    } else {
      $admin_approval = get_msg( 'reject_item' );
    }

    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi} {$user_name},</p>

<p>{$admin_approval}</p>

<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;

    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}


if ( !function_exists( 'send_rating_email' )) {

  function send_rating_email( $user_id, $subject = "", $from_user_id )
  {
     // get ci instance
    $CI =& get_instance();
    
    $user_info_obj = $CI->User->get_one($user_id);
    $from_user_name = $CI->User->get_one($from_user_id)->user_name;

    $user_name  = $user_info_obj->user_name;
    $user_email = $user_info_obj->user_email;
    $to = $user_email;

    $sender_name = $CI->Backend_config->get_one('be1')->sender_name;
    $hi = get_msg('hi_label');

    $receive_rating = get_msg('receive_rating_from') . " " . $from_user_name;
    
    $best_regards = get_msg( 'best_regards_label' );

    $msg = <<<EOL
<p>{$hi} {$user_name},</p>

<p>{$receive_rating}</p>

<p>
{$best_regards},<br/>
{$sender_name}
</p>
EOL;

    // send email from admin
    return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
  }
}