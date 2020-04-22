<?php
// Database connection settings
define('SITENAME', 'UZEM');
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','uzem2');

// Mailer settings
// Mail worker settings
define('MAILHOST', 'smtp.zoho.com');
define('MAILAUTHUSER', 'no-reply@uzemplus.com');
define('MAILPASSWORD', 'sz5pSdicxTj4');
define('MAILSMTPAUTH', true);
define('MAILSMTPSECURE', 'ssl');
define('MAILPORT', 465);
define('MAILFROMADDRESS', 'no-reply@uzemplus.com');
define('MAILFROMNAME', 'Uzem Plus');
define('MAILERPATH', 'PHPMailer/');
define('ADMINEMAIL', 'admin@uzemplus.com');

// Path settings
define('PPPATH', ''); // Profile pictures' path
define('ENVPATH', ''); // Environments' path
define('HWPATH', ''); // Homeworks' path


date_default_timezone_set('Europe/Istanbul');

function __autoload($class) {
    $class = strtolower($class);
    //if call from within assets adjust the path
    $classpath = 'classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }
}
?>
