<?php
/**
 * Webcore Support forms
 * 13.11.2018
 */


$form = 'support';
$devname = strpos($_SERVER['HTTP_USER_AGENT'], 'Unknown');

$remote_referer_arr = parse_url($_SERVER['HTTP_REFERER']);
$this_file_arr = parse_url($_SERVER['HTTP_HOST']);

if ($remote_referer_arr['host'] != $remote_referer_arr['host']) die;

// require_once '../config.php';
require_once 'config.php';

$message    = (isset($_POST['message'])) ? htmlspecialchars(stripslashes($_POST['message']), ENT_QUOTES, "UTF-8") : '';
$number     = (isset($_POST['number'])) ? htmlspecialchars(stripslashes($_POST['number']), ENT_QUOTES, "UTF-8") : '';
$email      = (isset($_POST['email'])) ? htmlspecialchars(stripslashes($_POST['email']), ENT_QUOTES, "UTF-8") : '';

if (isset($_POST['siteurl'])) $_POST['siteurl'] = htmlspecialchars(stripslashes($_POST['siteurl']), ENT_QUOTES, "UTF-8");
    
$from = $email;

$message = nl2br($message);

$text = '';

$text .= '<b>Email:</b> ' . $email . "<br>" . PHP_EOL;
$text .= '<b>Number:</b> ' . $number . "<br>" . PHP_EOL;

if (!!$message) $text .= $message;

$out_arr = Array( 'sent'=> 1, 'number' => $number, 'email' => $email, 'message' => $message );
echo json_encode($out_arr);

//if about anything
$to            =   $mail[$form];
$toName        =   $producer . ' Manager';
$subj          =   ' Message From Your Website Form ';

//PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/phpmailer/src/Exception.php';
require 'lib/phpmailer/src/PHPMailer.php';
require 'lib/phpmailer/src/SMTP.php';


$mail = new PHPMailer(false); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
$mail->CharSet = "UTF-8";

$mail->AddAddress($to, $toName);
$mail->AddReplyTo($replTo, $replToName);
$mail->SetFrom($fromEmail, $fromName);
$mail->Subject = $subj;
$mail->MsgHTML($text);
$mail->Sender = $from;

$mail->IsSMTP();
$mail->Host = "smtp.advancedhosters.com";
$mail->SMTPAuth = true;
$mail->Username = $fromEmail;
$mail->Password = $fromPass;

try {

    if ($form == 'suport') { //adding files

        if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
            for($i=0;$i<count($_FILES["images"]["name"]);$i++) {
                if (is_file($_FILES["images"]["tmp_name"][$i]) && is_uploaded_file($_FILES["images"]["tmp_name"][$i])) {
                    $mail->AddAttachment($_FILES["images"]["tmp_name"][$i], $_FILES["images"]["name"][$i]);
                }
            }
        }

    }

    $mail->Send();

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

