<?php
/**
 * Created by PhpStorm.
 * User: otter
 * Date: 04.01.2018
 * Time: 23:46
 */

require_once MAILERPATH . 'PHPMailer.php';
require_once MAILERPATH . 'POP3.php';
require_once MAILERPATH . 'SMTP.php';
require_once MAILERPATH . 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailWorker extends \PHPMailer\PHPMailer\PHPMailer
{
    function __construct($exceptions = null)
    {
        parent::__construct($exceptions);

        $this->SMTPDebug = 0;
        $this->isSMTP();
        $this->Host = MAILHOST;
        $this->SMTPAuth = MAILSMTPAUTH;
        $this->Username = MAILAUTHUSER;
        $this->Password = MAILPASSWORD;
        $this->SMTPSecure = MAILSMTPSECURE;
        $this->Port = MAILPORT;
        $this->setFrom(MAILFROMADDRESS, MAILFROMNAME);
        $this->isHTML(true);
        $this->CharSet = 'UTF-8';
    }
}