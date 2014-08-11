***REMOVED***
/**
 * PHPMailer - PHP email creation and transport class.
 * PHP Version 5
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2012 - 2014 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * PHPMailer - PHP email creation and transport class.
 * @package PHPMailer
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 */
class PHPMailer
{
***REMOVED***
***REMOVED*** The PHPMailer Version number.
***REMOVED*** @type string
***REMOVED***/
    public $Version = '5.2.8';

***REMOVED***
***REMOVED*** Email priority.
***REMOVED*** Options: 1 = High, 3 = Normal, 5 = low.
***REMOVED*** @type integer
***REMOVED***/
    public $Priority = 3;

***REMOVED***
***REMOVED*** The character set of the message.
***REMOVED*** @type string
***REMOVED***/
    public $CharSet = 'iso-8859-1';

***REMOVED***
***REMOVED*** The MIME Content-type of the message.
***REMOVED*** @type string
***REMOVED***/
    public $ContentType = 'text/plain';

***REMOVED***
***REMOVED*** The message encoding.
***REMOVED*** Options: "8bit", "7bit", "binary", "base64", and "quoted-printable".
***REMOVED*** @type string
***REMOVED***/
    public $Encoding = '8bit';

***REMOVED***
***REMOVED*** Holds the most recent mailer error message.
***REMOVED*** @type string
***REMOVED***/
    public $ErrorInfo = '';

***REMOVED***
***REMOVED*** The From email address for the message.
***REMOVED*** @type string
***REMOVED***/
    public $From = 'root@localhost';

***REMOVED***
***REMOVED*** The From name of the message.
***REMOVED*** @type string
***REMOVED***/
    public $FromName = 'Root User';

***REMOVED***
***REMOVED*** The Sender email (Return-Path) of the message.
***REMOVED*** If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
***REMOVED*** @type string
***REMOVED***/
    public $Sender = '';

***REMOVED***
***REMOVED*** The Return-Path of the message.
***REMOVED*** If empty, it will be set to either From or Sender.
***REMOVED*** @type string
***REMOVED*** @deprecated Email senders should never set a return-path header;
***REMOVED*** it's the receiver's job (RFC5321 section 4.4), so this no longer does anything.
***REMOVED*** @link https://tools.ietf.org/html/rfc5321#section-4.4 RFC5321 reference
***REMOVED***/
    public $ReturnPath = '';

***REMOVED***
***REMOVED*** The Subject of the message.
***REMOVED*** @type string
***REMOVED***/
    public $Subject = '';

***REMOVED***
***REMOVED*** An HTML or plain text message body.
***REMOVED*** If HTML then call isHTML(true).
***REMOVED*** @type string
***REMOVED***/
    public $Body = '';

***REMOVED***
***REMOVED*** The plain-text message body.
***REMOVED*** This body can be read by mail clients that do not have HTML email
***REMOVED*** capability such as mutt & Eudora.
***REMOVED*** Clients that can read HTML will view the normal Body.
***REMOVED*** @type string
***REMOVED***/
    public $AltBody = '';

***REMOVED***
***REMOVED*** An iCal message part body.
***REMOVED*** Only supported in simple alt or alt_inline message types
***REMOVED*** To generate iCal events, use the bundled extras/EasyPeasyICS.php class or iCalcreator
***REMOVED*** @link http://sprain.ch/blog/downloads/php-class-easypeasyics-create-ical-files-with-php/
***REMOVED*** @link http://kigkonsult.se/iCalcreator/
***REMOVED*** @type string
***REMOVED***/
    public $Ical = '';

***REMOVED***
***REMOVED*** The complete compiled MIME message body.
***REMOVED*** @access protected
***REMOVED*** @type string
***REMOVED***/
    protected $MIMEBody = '';

***REMOVED***
***REMOVED*** The complete compiled MIME message headers.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $MIMEHeader = '';

***REMOVED***
***REMOVED*** Extra headers that createHeader() doesn't fold in.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $mailHeader = '';

***REMOVED***
***REMOVED*** Word-wrap the message body to this number of chars.
***REMOVED*** @type integer
***REMOVED***/
    public $WordWrap = 0;

***REMOVED***
***REMOVED*** Which method to use to send mail.
***REMOVED*** Options: "mail", "sendmail", or "smtp".
***REMOVED*** @type string
***REMOVED***/
    public $Mailer = 'mail';

***REMOVED***
***REMOVED*** The path to the sendmail program.
***REMOVED*** @type string
***REMOVED***/
    public $Sendmail = '/usr/sbin/sendmail';

***REMOVED***
***REMOVED*** Whether mail() uses a fully sendmail-compatible MTA.
***REMOVED*** One which supports sendmail's "-oi -f" options.
***REMOVED*** @type boolean
***REMOVED***/
    public $UseSendmailOptions = true;

***REMOVED***
***REMOVED*** Path to PHPMailer plugins.
***REMOVED*** Useful if the SMTP class is not in the PHP include path.
***REMOVED*** @type string
***REMOVED*** @deprecated Should not be needed now there is an autoloader.
***REMOVED***/
    public $PluginDir = '';

***REMOVED***
***REMOVED*** The email address that a reading confirmation should be sent to.
***REMOVED*** @type string
***REMOVED***/
    public $ConfirmReadingTo = '';

***REMOVED***
***REMOVED*** The hostname to use in Message-Id and Received headers
***REMOVED*** and as default HELO string.
***REMOVED*** If empty, the value returned
***REMOVED*** by SERVER_NAME is used or 'localhost.localdomain'.
***REMOVED*** @type string
***REMOVED***/
    public $Hostname = '';

***REMOVED***
***REMOVED*** An ID to be used in the Message-Id header.
***REMOVED*** If empty, a unique id will be generated.
***REMOVED*** @type string
***REMOVED***/
    public $MessageID = '';

***REMOVED***
***REMOVED*** The message Date to be used in the Date header.
***REMOVED*** If empty, the current date will be added.
***REMOVED*** @type string
***REMOVED***/
    public $MessageDate = '';

***REMOVED***
***REMOVED*** SMTP hosts.
***REMOVED*** Either a single hostname or multiple semicolon-delimited hostnames.
***REMOVED*** You can also specify a different port
***REMOVED*** for each host by using this format: [hostname:port]
***REMOVED*** (e.g. "smtp1.example.com:25;smtp2.example.com").
***REMOVED*** Hosts will be tried in order.
***REMOVED*** @type string
***REMOVED***/
    public $Host = 'localhost';

***REMOVED***
***REMOVED*** The default SMTP server port.
***REMOVED*** @type integer
***REMOVED*** @TODO Why is this needed when the SMTP class takes care of it?
***REMOVED***/
    public $Port = 25;

***REMOVED***
***REMOVED*** The SMTP HELO of the message.
***REMOVED*** Default is $Hostname.
***REMOVED*** @type string
***REMOVED*** @see PHPMailer::$Hostname
***REMOVED***/
    public $Helo = '';

***REMOVED***
***REMOVED*** The secure connection prefix.
***REMOVED*** Options: "", "ssl" or "tls"
***REMOVED*** @type string
***REMOVED***/
    public $SMTPSecure = '';

***REMOVED***
***REMOVED*** Whether to use SMTP authentication.
***REMOVED*** Uses the Username and Password properties.
***REMOVED*** @type boolean
***REMOVED*** @see PHPMailer::$Username
***REMOVED*** @see PHPMailer::$Password
***REMOVED***/
    public $SMTPAuth = false;

***REMOVED***
***REMOVED*** SMTP username.
***REMOVED*** @type string
***REMOVED***/
    public $Username = '';

***REMOVED***
***REMOVED*** SMTP password.
***REMOVED*** @type string
***REMOVED***/
    public $Password = '';

***REMOVED***
***REMOVED*** SMTP auth type.
***REMOVED*** Options are LOGIN (default), PLAIN, NTLM, CRAM-MD5
***REMOVED*** @type string
***REMOVED***/
    public $AuthType = '';

***REMOVED***
***REMOVED*** SMTP realm.
***REMOVED*** Used for NTLM auth
***REMOVED*** @type string
***REMOVED***/
    public $Realm = '';

***REMOVED***
***REMOVED*** SMTP workstation.
***REMOVED*** Used for NTLM auth
***REMOVED*** @type string
***REMOVED***/
    public $Workstation = '';

***REMOVED***
***REMOVED*** The SMTP server timeout in seconds.
***REMOVED*** @type integer
***REMOVED***/
    public $Timeout = 10;

***REMOVED***
***REMOVED*** SMTP class debug output mode.
***REMOVED*** Options:
***REMOVED***   0: no output
***REMOVED***   1: commands
***REMOVED***   2: data and commands
***REMOVED***   3: as 2 plus connection status
***REMOVED***   4: low level data output
***REMOVED*** @type integer
***REMOVED*** @see SMTP::$do_debug
***REMOVED***/
    public $SMTPDebug = 0;

***REMOVED***
***REMOVED*** How to handle debug output.
***REMOVED*** Options:
***REMOVED***   'echo': Output plain-text as-is, appropriate for CLI
***REMOVED***   'html': Output escaped, line breaks converted to <br>, appropriate for browser output
***REMOVED***   'error_log': Output to error log as configured in php.ini
***REMOVED*** @type string
***REMOVED*** @see SMTP::$Debugoutput
***REMOVED***/
    public $Debugoutput = 'echo';

***REMOVED***
***REMOVED*** Whether to keep SMTP connection open after each message.
***REMOVED*** If this is set to true then to close the connection
***REMOVED*** requires an explicit call to smtpClose().
***REMOVED*** @type boolean
***REMOVED***/
    public $SMTPKeepAlive = false;

***REMOVED***
***REMOVED*** Whether to split multiple to addresses into multiple messages
***REMOVED*** or send them all in one message.
***REMOVED*** @type boolean
***REMOVED***/
    public $SingleTo = false;

***REMOVED***
***REMOVED*** Storage for addresses when SingleTo is enabled.
***REMOVED*** @type array
***REMOVED*** @TODO This should really not be public
***REMOVED***/
    public $SingleToArray = array();

***REMOVED***
***REMOVED*** Whether to generate VERP addresses on send.
***REMOVED*** Only applicable when sending via SMTP.
***REMOVED*** @link http://en.wikipedia.org/wiki/Variable_envelope_return_path
***REMOVED*** @link http://www.postfix.org/VERP_README.html Postfix VERP info
***REMOVED*** @type boolean
***REMOVED***/
    public $do_verp = false;

***REMOVED***
***REMOVED*** Whether to allow sending messages with an empty body.
***REMOVED*** @type boolean
***REMOVED***/
    public $AllowEmpty = false;

***REMOVED***
***REMOVED*** The default line ending.
***REMOVED*** @note The default remains "\n". We force CRLF where we know
***REMOVED***        it must be used via self::CRLF.
***REMOVED*** @type string
***REMOVED***/
    public $LE = "\n";

***REMOVED***
***REMOVED*** DKIM selector.
***REMOVED*** @type string
***REMOVED***/
    public $DKIM_selector = '';

***REMOVED***
***REMOVED*** DKIM Identity.
***REMOVED*** Usually the email address used as the source of the email
***REMOVED*** @type string
***REMOVED***/
    public $DKIM_identity = '';

***REMOVED***
***REMOVED*** DKIM passphrase.
***REMOVED*** Used if your key is encrypted.
***REMOVED*** @type string
***REMOVED***/
    public $DKIM_passphrase = '';

***REMOVED***
***REMOVED*** DKIM signing domain name.
***REMOVED*** @example 'example.com'
***REMOVED*** @type string
***REMOVED***/
    public $DKIM_domain = '';

***REMOVED***
***REMOVED*** DKIM private key file path.
***REMOVED*** @type string
***REMOVED***/
    public $DKIM_private = '';

***REMOVED***
***REMOVED*** Callback Action function name.
***REMOVED***
***REMOVED*** The function that handles the result of the send email action.
***REMOVED*** It is called out by send() for each email sent.
***REMOVED***
***REMOVED*** Value can be any php callable: http://www.php.net/is_callable
***REMOVED***
***REMOVED*** Parameters:
***REMOVED***   boolean $result        result of the send action
***REMOVED***   string  $to            email address of the recipient
***REMOVED***   string  $cc            cc email addresses
***REMOVED***   string  $bcc           bcc email addresses
***REMOVED***   string  $subject       the subject
***REMOVED***   string  $body          the email body
***REMOVED***   string  $from          email address of sender
***REMOVED*** @type string
***REMOVED***/
    public $action_function = '';

***REMOVED***
***REMOVED*** What to use in the X-Mailer header.
***REMOVED*** Options: null for default, whitespace for none, or a string to use
***REMOVED*** @type string
***REMOVED***/
    public $XMailer = '';

***REMOVED***
***REMOVED*** An instance of the SMTP sender class.
***REMOVED*** @type SMTP
***REMOVED*** @access protected
***REMOVED***/
    protected $smtp = null;

***REMOVED***
***REMOVED*** The array of 'to' addresses.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $to = array();

***REMOVED***
***REMOVED*** The array of 'cc' addresses.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $cc = array();

***REMOVED***
***REMOVED*** The array of 'bcc' addresses.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $bcc = array();

***REMOVED***
***REMOVED*** The array of reply-to names and addresses.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $ReplyTo = array();

***REMOVED***
***REMOVED*** An array of all kinds of addresses.
***REMOVED*** Includes all of $to, $cc, $bcc, $replyto
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $all_recipients = array();

***REMOVED***
***REMOVED*** The array of attachments.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $attachment = array();

***REMOVED***
***REMOVED*** The array of custom headers.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $CustomHeader = array();

***REMOVED***
***REMOVED*** The most recent Message-ID (including angular brackets).
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $lastMessageID = '';

***REMOVED***
***REMOVED*** The message's MIME type.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $message_type = '';

***REMOVED***
***REMOVED*** The array of MIME boundary strings.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $boundary = array();

***REMOVED***
***REMOVED*** The array of available languages.
***REMOVED*** @type array
***REMOVED*** @access protected
***REMOVED***/
    protected $language = array();

***REMOVED***
***REMOVED*** The number of errors encountered.
***REMOVED*** @type integer
***REMOVED*** @access protected
***REMOVED***/
    protected $error_count = 0;

***REMOVED***
***REMOVED*** The S/MIME certificate file path.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $sign_cert_file = '';

***REMOVED***
***REMOVED*** The S/MIME key file path.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $sign_key_file = '';

***REMOVED***
***REMOVED*** The S/MIME password for the key.
***REMOVED*** Used only if the key is encrypted.
***REMOVED*** @type string
***REMOVED*** @access protected
***REMOVED***/
    protected $sign_key_pass = '';

***REMOVED***
***REMOVED*** Whether to throw exceptions for errors.
***REMOVED*** @type boolean
***REMOVED*** @access protected
***REMOVED***/
    protected $exceptions = false;

***REMOVED***
***REMOVED*** Error severity: message only, continue processing
***REMOVED***/
    const STOP_MESSAGE = 0;

***REMOVED***
***REMOVED*** Error severity: message, likely ok to continue processing
***REMOVED***/
    const STOP_CONTINUE = 1;

***REMOVED***
***REMOVED*** Error severity: message, plus full stop, critical error reached
***REMOVED***/
    const STOP_CRITICAL = 2;

***REMOVED***
***REMOVED*** SMTP RFC standard line ending
***REMOVED***/
    const CRLF = "\r\n";

***REMOVED***
***REMOVED*** Constructor
***REMOVED*** @param boolean $exceptions Should we throw external exceptions?
***REMOVED***/
    public function __construct($exceptions = false)
    {
        $this->exceptions = ($exceptions == true);
        //Make sure our autoloader is loaded
        if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
            $autoload = spl_autoload_functions();
            if ($autoload === false or !in_array('PHPMailerAutoload', $autoload)) {
                require 'PHPMailerAutoload.php';
            }
        }
    }

***REMOVED***
***REMOVED*** Destructor.
***REMOVED***/
    public function __destruct()
    {
        if ($this->Mailer == 'smtp') { //close any open SMTP connection nicely
            $this->smtpClose();
        }
    }

***REMOVED***
***REMOVED*** Call mail() in a safe_mode-aware fashion.
***REMOVED*** Also, unless sendmail_path points to sendmail (or something that
***REMOVED*** claims to be sendmail), don't pass params (not a perfect fix,
***REMOVED*** but it will do)
***REMOVED*** @param string $to To
***REMOVED*** @param string $subject Subject
***REMOVED*** @param string $body Message Body
***REMOVED*** @param string $header Additional Header(s)
***REMOVED*** @param string $params Params
***REMOVED*** @access private
***REMOVED*** @return boolean
***REMOVED***/
    private function mailPassthru($to, $subject, $body, $header, $params)
    {
        //Check overloading of mail function to avoid double-encoding
        if (ini_get('mbstring.func_overload') & 1) {
            $subject = $this->secureHeader($subject);
        } else {
            $subject = $this->encodeHeader($this->secureHeader($subject));
        }
        if (ini_get('safe_mode') || !($this->UseSendmailOptions)) {
            $result = @mail($to, $subject, $body, $header);
        } else {
            $result = @mail($to, $subject, $body, $header, $params);
        }
        return $result;
    }

***REMOVED***
***REMOVED*** Output debugging info via user-defined method.
***REMOVED*** Only if debug output is enabled.
***REMOVED*** @see PHPMailer::$Debugoutput
***REMOVED*** @see PHPMailer::$SMTPDebug
***REMOVED*** @param string $str
***REMOVED***/
    protected function edebug($str)
    {
        if (!$this->SMTPDebug) {
            return;
        }
        switch ($this->Debugoutput) {
            case 'error_log':
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking display that's HTML-safe
                echo htmlentities(preg_replace('/[\r\n]+/', '', $str), ENT_QUOTES, $this->CharSet) . "<br>\n";
                break;
            case 'echo':
            default:
                echo $str."\n";
        }
    }

***REMOVED***
***REMOVED*** Sets message type to HTML or plain.
***REMOVED*** @param boolean $isHtml True for HTML mode.
***REMOVED*** @return void
***REMOVED***/
    public function isHTML($isHtml = true)
    {
        if ($isHtml) {
            $this->ContentType = 'text/html';
        } else {
            $this->ContentType = 'text/plain';
        }
    }

***REMOVED***
***REMOVED*** Send messages using SMTP.
***REMOVED*** @return void
***REMOVED***/
    public function isSMTP()
    {
        $this->Mailer = 'smtp';
    }

***REMOVED***
***REMOVED*** Send messages using PHP's mail() function.
***REMOVED*** @return void
***REMOVED***/
    public function isMail()
    {
        $this->Mailer = 'mail';
    }

***REMOVED***
***REMOVED*** Send messages using $Sendmail.
***REMOVED*** @return void
***REMOVED***/
    public function isSendmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'sendmail')) {
            $this->Sendmail = '/usr/sbin/sendmail';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'sendmail';
    }

***REMOVED***
***REMOVED*** Send messages using qmail.
***REMOVED*** @return void
***REMOVED***/
    public function isQmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'qmail')) {
            $this->Sendmail = '/var/qmail/bin/qmail-inject';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'qmail';
    }

***REMOVED***
***REMOVED*** Add a "To" address.
***REMOVED*** @param string $address
***REMOVED*** @param string $name
***REMOVED*** @return boolean true on success, false if address already used
***REMOVED***/
    public function addAddress($address, $name = '')
    {
        return $this->addAnAddress('to', $address, $name);
    }

***REMOVED***
***REMOVED*** Add a "CC" address.
***REMOVED*** @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
***REMOVED*** @param string $address
***REMOVED*** @param string $name
***REMOVED*** @return boolean true on success, false if address already used
***REMOVED***/
    public function addCC($address, $name = '')
    {
        return $this->addAnAddress('cc', $address, $name);
    }

***REMOVED***
***REMOVED*** Add a "BCC" address.
***REMOVED*** @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
***REMOVED*** @param string $address
***REMOVED*** @param string $name
***REMOVED*** @return boolean true on success, false if address already used
***REMOVED***/
    public function addBCC($address, $name = '')
    {
        return $this->addAnAddress('bcc', $address, $name);
    }

***REMOVED***
***REMOVED*** Add a "Reply-to" address.
***REMOVED*** @param string $address
***REMOVED*** @param string $name
***REMOVED*** @return boolean
***REMOVED***/
    public function addReplyTo($address, $name = '')
    {
        return $this->addAnAddress('Reply-To', $address, $name);
    }

***REMOVED***
***REMOVED*** Add an address to one of the recipient arrays.
***REMOVED*** Addresses that have been added already return false, but do not throw exceptions
***REMOVED*** @param string $kind One of 'to', 'cc', 'bcc', 'ReplyTo'
***REMOVED*** @param string $address The email address to send to
***REMOVED*** @param string $name
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean true on success, false if address already used or invalid in some way
***REMOVED*** @access protected
***REMOVED***/
    protected function addAnAddress($kind, $address, $name = '')
    {
        if (!preg_match('/^(to|cc|bcc|Reply-To)$/', $kind)) {
            $this->setError($this->lang('Invalid recipient array') . ': ' . $kind);
            $this->edebug($this->lang('Invalid recipient array') . ': ' . $kind);
            if ($this->exceptions) {
                throw new phpmailerException('Invalid recipient array: ' . $kind);
            }
            return false;
        }
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!$this->validateAddress($address)) {
            $this->setError($this->lang('invalid_address') . ': ' . $address);
            $this->edebug($this->lang('invalid_address') . ': ' . $address);
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('invalid_address') . ': ' . $address);
            }
            return false;
        }
        if ($kind != 'Reply-To') {
            if (!isset($this->all_recipients[strtolower($address)])) {
                array_push($this->$kind, array($address, $name));
                $this->all_recipients[strtolower($address)] = true;
                return true;
            }
        } else {
            if (!array_key_exists(strtolower($address), $this->ReplyTo)) {
                $this->ReplyTo[strtolower($address)] = array($address, $name);
                return true;
            }
        }
        return false;
    }

***REMOVED***
***REMOVED*** Set the From and FromName properties.
***REMOVED*** @param string $address
***REMOVED*** @param string $name
***REMOVED*** @param boolean $auto Whether to also set the Sender address, defaults to true
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED***/
    public function setFrom($address, $name = '', $auto = true)
    {
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!$this->validateAddress($address)) {
            $this->setError($this->lang('invalid_address') . ': ' . $address);
            $this->edebug($this->lang('invalid_address') . ': ' . $address);
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('invalid_address') . ': ' . $address);
            }
            return false;
        }
        $this->From = $address;
        $this->FromName = $name;
        if ($auto) {
            if (empty($this->Sender)) {
                $this->Sender = $address;
            }
        }
        return true;
    }

***REMOVED***
***REMOVED*** Return the Message-ID header of the last email.
***REMOVED*** Technically this is the value from the last time the headers were created,
***REMOVED*** but it's also the message ID of the last sent message except in
***REMOVED*** pathological cases.
***REMOVED*** @return string
***REMOVED***/
    public function getLastMessageID()
    {
        return $this->lastMessageID;
    }

***REMOVED***
***REMOVED*** Check that a string looks like an email address.
***REMOVED*** @param string $address The email address to check
***REMOVED*** @param string $patternselect A selector for the validation pattern to use :
***REMOVED*** * `auto` Pick strictest one automatically;
***REMOVED*** * `pcre8` Use the squiloople.com pattern, requires PCRE > 8.0, PHP >= 5.3.2, 5.2.14;
***REMOVED*** * `pcre` Use old PCRE implementation;
***REMOVED*** * `php` Use PHP built-in FILTER_VALIDATE_EMAIL; same as pcre8 but does not allow 'dotless' domains;
***REMOVED*** * `html5` Use the pattern given by the HTML5 spec for 'email' type form input elements.
***REMOVED*** * `noregex` Don't use a regex: super fast, really dumb.
***REMOVED*** @return boolean
***REMOVED*** @static
***REMOVED*** @access public
***REMOVED***/
    public static function validateAddress($address, $patternselect = 'auto')
    {
        if (!$patternselect or $patternselect == 'auto') {
            //Check this constant first so it works when extension_loaded() is disabled by safe mode
            //Constant was added in PHP 5.2.4
            if (defined('PCRE_VERSION')) {
                //This pattern can get stuck in a recursive loop in PCRE <= 8.0.2
                if (version_compare(PCRE_VERSION, '8.0.3') >= 0) {
                    $patternselect = 'pcre8';
                } else {
                    $patternselect = 'pcre';
                }
            } elseif (function_exists('extension_loaded') and extension_loaded('pcre')) {
                //Fall back to older PCRE
                $patternselect = 'pcre';
            } else {
                //Filter_var appeared in PHP 5.2.0 and does not require the PCRE extension
                if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
                    $patternselect = 'php';
                } else {
                    $patternselect = 'noregex';
                }
            }
        }
        switch ($patternselect) {
            case 'pcre8':
  ***REMOVED*****REMOVED*****REMOVED***
       ***REMOVED*****REMOVED*** Uses the same RFC5322 regex on which FILTER_VALIDATE_EMAIL is based, but allows dotless domains.
       ***REMOVED*****REMOVED*** @link http://squiloople.com/2009/12/20/email-address-validation/
       ***REMOVED*****REMOVED*** @copyright 2009-2010 Michael Rushton
       ***REMOVED*****REMOVED*** Feel free to use and redistribute this code. But please keep this copyright notice.
       ***REMOVED*****REMOVED***/
                return (boolean)preg_match(
                    '/^(?!(***REMOVED***(?1)"?(***REMOVED***\\\[ -~]|[^"])"?(?1)){255,})(?!(***REMOVED***(?1)"?(***REMOVED***\\\[ -~]|[^"])"?(?1)){65,}@)' .
                    '((***REMOVED***(***REMOVED***(***REMOVED***((***REMOVED***(***REMOVED***(***REMOVED***\x0D\x0A)?[\t ])+|(***REMOVED***[\t ]*\x0D\x0A)?[\t ]+)?)(\((***REMOVED***(?2)' .
                    '(***REMOVED***[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)' .
                    '([!#-\'*+\/-9=?^-~-]+|"(***REMOVED***(?2)(***REMOVED***[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*' .
                    '(?2)")(***REMOVED***(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(***REMOVED***([a-z0-9](***REMOVED***[a-z0-9-]*[a-z0-9])?)' .
                    '(***REMOVED***(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(***REMOVED***IPv6:(***REMOVED***([a-f0-9]{1,4})(***REMOVED***:(?6)){7}' .
                    '|(?!(?:.*[a-f0-9][:\]]){8,})((?6)(***REMOVED***:(?6)){0,6})?::(?7)?))|(***REMOVED***(***REMOVED***IPv6:(***REMOVED***(?6)(***REMOVED***:(?6)){5}:' .
                    '|(?!(?:.*[a-f0-9]:){6,})(?8)?::(***REMOVED***((?6)(***REMOVED***:(?6)){0,4}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(***REMOVED***\.(?9)){3}))\])(?1)$/isD',
                    $address
                );
            case 'pcre':
                //An older regex that doesn't need a recent PCRE
                return (boolean)preg_match(
                    '/^(?!(***REMOVED***"?(***REMOVED***\\\[ -~]|[^"])"?){255,})(?!(***REMOVED***"?(***REMOVED***\\\[ -~]|[^"])"?){65,}@)(***REMOVED***' .
                    '[!#-\'*+\/-9=?^-~-]+|"(***REMOVED***(***REMOVED***[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*")' .
                    '(***REMOVED***\.(***REMOVED***[!#-\'*+\/-9=?^-~-]+|"(***REMOVED***(***REMOVED***[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*"))*' .
                    '@(***REMOVED***(?![a-z0-9-]{64,})(***REMOVED***[a-z0-9](***REMOVED***[a-z0-9-]*[a-z0-9])?)(***REMOVED***\.(?![a-z0-9-]{64,})' .
                    '(***REMOVED***[a-z0-9](***REMOVED***[a-z0-9-]*[a-z0-9])?)){0,126}|\[(?:(***REMOVED***IPv6:(***REMOVED***(***REMOVED***[a-f0-9]{1,4})(***REMOVED***:' .
                    '[a-f0-9]{1,4}){7}|(?!(?:.*[a-f0-9][:\]]){8,})(***REMOVED***[a-f0-9]{1,4}(***REMOVED***:[a-f0-9]{1,4}){0,6})?' .
                    '::(***REMOVED***[a-f0-9]{1,4}(***REMOVED***:[a-f0-9]{1,4}){0,6})?))|(***REMOVED***(***REMOVED***IPv6:(***REMOVED***[a-f0-9]{1,4}(***REMOVED***:' .
                    '[a-f0-9]{1,4}){5}:|(?!(?:.*[a-f0-9]:){6,})(***REMOVED***[a-f0-9]{1,4}(***REMOVED***:[a-f0-9]{1,4}){0,4})?' .
                    '::(***REMOVED***(?:[a-f0-9]{1,4}(***REMOVED***:[a-f0-9]{1,4}){0,4}):)?))?(***REMOVED***25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(***REMOVED***\.(***REMOVED***25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\])$/isD',
                    $address
                );
            case 'html5':
  ***REMOVED*****REMOVED*****REMOVED***
       ***REMOVED*****REMOVED*** This is the pattern used in the HTML5 spec for validation of 'email' type form input elements.
       ***REMOVED*****REMOVED*** @link http://www.whatwg.org/specs/web-apps/current-work/#e-mail-state-(type=email)
       ***REMOVED*****REMOVED***/
                return (boolean)preg_match(
                    '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}' .
                    '[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/sD',
                    $address
                );
            case 'noregex':
                //No PCRE! Do something _very_ approximate!
                //Check the address is 3 chars or longer and contains an @ that's not the first or last char
                return (strlen($address) >= 3
                    and strpos($address, '@') >= 1
                    and strpos($address, '@') != strlen($address) - 1);
            case 'php':
            default:
                return (boolean)filter_var($address, FILTER_VALIDATE_EMAIL);
        }
    }

***REMOVED***
***REMOVED*** Create a message and send it.
***REMOVED*** Uses the sending method specified by $Mailer.
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean false on error - See the ErrorInfo property for details of the error.
***REMOVED***/
    public function send()
    {
        try {
            if (!$this->preSend()) {
                return false;
            }
            return $this->postSend();
        } catch (phpmailerException $exc) {
            $this->mailHeader = '';
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

***REMOVED***
***REMOVED*** Prepare a message for sending.
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED***/
    public function preSend()
    {
        try {
            $this->mailHeader = '';
            if ((count($this->to) + count($this->cc) + count($this->bcc)) < 1) {
                throw new phpmailerException($this->lang('provide_address'), self::STOP_CRITICAL);
            }

            // Set whether the message is multipart/alternative
            if (!empty($this->AltBody)) {
                $this->ContentType = 'multipart/alternative';
            }

            $this->error_count = 0; // reset errors
            $this->setMessageType();
            // Refuse to send an empty message unless we are specifically allowing it
            if (!$this->AllowEmpty and empty($this->Body)) {
                throw new phpmailerException($this->lang('empty_message'), self::STOP_CRITICAL);
            }

            $this->MIMEHeader = $this->createHeader();
            $this->MIMEBody = $this->createBody();

            // To capture the complete message when using mail(), create
            // an extra header list which createHeader() doesn't fold in
            if ($this->Mailer == 'mail') {
                if (count($this->to) > 0) {
                    $this->mailHeader .= $this->addrAppend('To', $this->to);
                } else {
                    $this->mailHeader .= $this->headerLine('To', 'undisclosed-recipients:;');
                }
                $this->mailHeader .= $this->headerLine(
                    'Subject',
                    $this->encodeHeader($this->secureHeader(trim($this->Subject)))
                );
            }

            // Sign with DKIM if enabled
            if (!empty($this->DKIM_domain)
                && !empty($this->DKIM_private)
                && !empty($this->DKIM_selector)
                && !empty($this->DKIM_domain)
                && file_exists($this->DKIM_private)) {
                $header_dkim = $this->DKIM_Add(
                    $this->MIMEHeader . $this->mailHeader,
                    $this->encodeHeader($this->secureHeader($this->Subject)),
                    $this->MIMEBody
                );
                $this->MIMEHeader = rtrim($this->MIMEHeader, "\r\n ") . self::CRLF .
                    str_replace("\r\n", "\n", $header_dkim) . self::CRLF;
            }
            return true;

        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

***REMOVED***
***REMOVED*** Actually send a message.
***REMOVED*** Send the email via the selected mechanism
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED***/
    public function postSend()
    {
        try {
            // Choose the mailer and send through it
            switch ($this->Mailer) {
                case 'sendmail':
                case 'qmail':
                    return $this->sendmailSend($this->MIMEHeader, $this->MIMEBody);
                case 'smtp':
                    return $this->smtpSend($this->MIMEHeader, $this->MIMEBody);
                case 'mail':
                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
                default:
                    $sendMethod = $this->Mailer.'Send';
                    if (method_exists($this, $sendMethod)) {
                        return $this->$sendMethod($this->MIMEHeader, $this->MIMEBody);
                    }

                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
            }
        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
        }
        return false;
    }

***REMOVED***
***REMOVED*** Send mail using the $Sendmail program.
***REMOVED*** @param string $header The message headers
***REMOVED*** @param string $body The message body
***REMOVED*** @see PHPMailer::$Sendmail
***REMOVED*** @throws phpmailerException
***REMOVED*** @access protected
***REMOVED*** @return boolean
***REMOVED***/
    protected function sendmailSend($header, $body)
    {
        if ($this->Sender != '') {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s -f%s', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            } else {
                $sendmail = sprintf('%s -oi -f%s -t', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            }
        } else {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s', escapeshellcmd($this->Sendmail));
            } else {
                $sendmail = sprintf('%s -oi -t', escapeshellcmd($this->Sendmail));
            }
        }
        if ($this->SingleTo === true) {
            foreach ($this->SingleToArray as $toAddr) {
                if (!@$mail = popen($sendmail, 'w')) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
                fputs($mail, 'To: ' . $toAddr . "\n");
                fputs($mail, $header);
                fputs($mail, $body);
                $result = pclose($mail);
                $this->doCallback(
                    ($result == 0),
                    array($toAddr),
                    $this->cc,
                    $this->bcc,
                    $this->Subject,
                    $body,
                    $this->From
                );
                if ($result != 0) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
            }
        } else {
            if (!@$mail = popen($sendmail, 'w')) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
            fputs($mail, $header);
            fputs($mail, $body);
            $result = pclose($mail);
            $this->doCallback(($result == 0), $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From);
            if ($result != 0) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
        }
        return true;
    }

***REMOVED***
***REMOVED*** Send mail using the PHP mail() function.
***REMOVED*** @param string $header The message headers
***REMOVED*** @param string $body The message body
***REMOVED*** @link http://www.php.net/manual/en/book.mail.php
***REMOVED*** @throws phpmailerException
***REMOVED*** @access protected
***REMOVED*** @return boolean
***REMOVED***/
    protected function mailSend($header, $body)
    {
        $toArr = array();
        foreach ($this->to as $toaddr) {
            $toArr[] = $this->addrFormat($toaddr);
        }
        $to = implode(', ', $toArr);

        if (empty($this->Sender)) {
            $params = ' ';
        } else {
            $params = sprintf('-f%s', $this->Sender);
        }
        if ($this->Sender != '' and !ini_get('safe_mode')) {
            $old_from = ini_get('sendmail_from');
            ini_set('sendmail_from', $this->Sender);
        }
        $result = false;
        if ($this->SingleTo === true && count($toArr) > 1) {
            foreach ($toArr as $toAddr) {
                $result = $this->mailPassthru($toAddr, $this->Subject, $body, $header, $params);
                $this->doCallback($result, array($toAddr), $this->cc, $this->bcc, $this->Subject, $body, $this->From);
            }
        } else {
            $result = $this->mailPassthru($to, $this->Subject, $body, $header, $params);
            $this->doCallback($result, $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From);
        }
        if (isset($old_from)) {
            ini_set('sendmail_from', $old_from);
        }
        if (!$result) {
            throw new phpmailerException($this->lang('instantiate'), self::STOP_CRITICAL);
        }
        return true;
    }

***REMOVED***
***REMOVED*** Get an instance to use for SMTP operations.
***REMOVED*** Override this function to load your own SMTP implementation
***REMOVED*** @return SMTP
***REMOVED***/
    public function getSMTPInstance()
    {
        if (!is_object($this->smtp)) {
            $this->smtp = new SMTP;
        }
        return $this->smtp;
    }

***REMOVED***
***REMOVED*** Send mail via SMTP.
***REMOVED*** Returns false if there is a bad MAIL FROM, RCPT, or DATA input.
***REMOVED*** Uses the PHPMailerSMTP class by default.
***REMOVED*** @see PHPMailer::getSMTPInstance() to use a different class.
***REMOVED*** @param string $header The message headers
***REMOVED*** @param string $body The message body
***REMOVED*** @throws phpmailerException
***REMOVED*** @uses SMTP
***REMOVED*** @access protected
***REMOVED*** @return boolean
***REMOVED***/
    protected function smtpSend($header, $body)
    {
        $bad_rcpt = array();

        if (!$this->smtpConnect()) {
            throw new phpmailerException($this->lang('smtp_connect_failed'), self::STOP_CRITICAL);
        }
        $smtp_from = ($this->Sender == '') ? $this->From : $this->Sender;
        if (!$this->smtp->mail($smtp_from)) {
            $this->setError($this->lang('from_failed') . $smtp_from . ' : ' . implode(',', $this->smtp->getError()));
            throw new phpmailerException($this->ErrorInfo, self::STOP_CRITICAL);
        }

        // Attempt to send to all recipients
        foreach ($this->to as $to) {
            if (!$this->smtp->recipient($to[0])) {
                $bad_rcpt[] = $to[0];
                $isSent = false;
            } else {
                $isSent = true;
            }
            $this->doCallback($isSent, array($to[0]), array(), array(), $this->Subject, $body, $this->From);
        }
        foreach ($this->cc as $cc) {
            if (!$this->smtp->recipient($cc[0])) {
                $bad_rcpt[] = $cc[0];
                $isSent = false;
            } else {
                $isSent = true;
            }
            $this->doCallback($isSent, array(), array($cc[0]), array(), $this->Subject, $body, $this->From);
        }
        foreach ($this->bcc as $bcc) {
            if (!$this->smtp->recipient($bcc[0])) {
                $bad_rcpt[] = $bcc[0];
                $isSent = false;
            } else {
                $isSent = true;
            }
            $this->doCallback($isSent, array(), array(), array($bcc[0]), $this->Subject, $body, $this->From);
        }

        // Only send the DATA command if we have viable recipients
        if ((count($this->all_recipients) > count($bad_rcpt)) and !$this->smtp->data($header . $body)) {
            throw new phpmailerException($this->lang('data_not_accepted'), self::STOP_CRITICAL);
        }
        if ($this->SMTPKeepAlive == true) {
            $this->smtp->reset();
        } else {
            $this->smtp->quit();
            $this->smtp->close();
        }
        if (count($bad_rcpt) > 0) { // Create error message for any bad addresses
            throw new phpmailerException(
                $this->lang('recipients_failed') . implode(', ', $bad_rcpt),
                self::STOP_CONTINUE
            );
        }
        return true;
    }

***REMOVED***
***REMOVED*** Initiate a connection to an SMTP server.
***REMOVED*** Returns false if the operation failed.
***REMOVED*** @param array $options An array of options compatible with stream_context_create()
***REMOVED*** @uses SMTP
***REMOVED*** @access public
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED***/
    public function smtpConnect($options = array())
    {
        if (is_null($this->smtp)) {
            $this->smtp = $this->getSMTPInstance();
        }

        // Already connected?
        if ($this->smtp->connected()) {
            return true;
        }

        $this->smtp->setTimeout($this->Timeout);
        $this->smtp->setDebugLevel($this->SMTPDebug);
        $this->smtp->setDebugOutput($this->Debugoutput);
        $this->smtp->setVerp($this->do_verp);
        $hosts = explode(';', $this->Host);
        $lastexception = null;

        foreach ($hosts as $hostentry) {
            $hostinfo = array();
            if (!preg_match('/^((ssl|tls):\/\/)*([a-zA-Z0-9\.-]*):?([0-9]*)$/', trim($hostentry), $hostinfo)) {
                // Not a valid host entry
                continue;
            }
            // $hostinfo[2]: optional ssl or tls prefix
            // $hostinfo[3]: the hostname
            // $hostinfo[4]: optional port number
            // The host string prefix can temporarily override the current setting for SMTPSecure
            // If it's not specified, the default value is used
            $prefix = '';
            $tls = ($this->SMTPSecure == 'tls');
            if ($hostinfo[2] == 'ssl' or ($hostinfo[2] == '' and $this->SMTPSecure == 'ssl')) {
                $prefix = 'ssl://';
                $tls = false; // Can't have SSL and TLS at once
            } elseif ($hostinfo[2] == 'tls') {
                $tls = true;
                // tls doesn't use a prefix
            }
            $host = $hostinfo[3];
            $port = $this->Port;
            $tport = (integer)$hostinfo[4];
            if ($tport > 0 and $tport < 65536) {
                $port = $tport;
            }
            if ($this->smtp->connect($prefix . $host, $port, $this->Timeout, $options)) {
                try {
                    if ($this->Helo) {
                        $hello = $this->Helo;
                    } else {
                        $hello = $this->serverHostname();
                    }
                    $this->smtp->hello($hello);

                    if ($tls) {
                        if (!$this->smtp->startTLS()) {
                            throw new phpmailerException($this->lang('connect_host'));
                        }
                        // We must resend HELO after tls negotiation
                        $this->smtp->hello($hello);
                    }
                    if ($this->SMTPAuth) {
                        if (!$this->smtp->authenticate(
                            $this->Username,
                            $this->Password,
                            $this->AuthType,
                            $this->Realm,
                            $this->Workstation
                        )
                        ) {
                            throw new phpmailerException($this->lang('authenticate'));
                        }
                    }
                    return true;
                } catch (phpmailerException $exc) {
                    $lastexception = $exc;
                    // We must have connected, but then failed TLS or Auth, so close connection nicely
                    $this->smtp->quit();
                }
            }
        }
        // If we get here, all connection attempts have failed, so close connection hard
        $this->smtp->close();
        // As we've caught all exceptions, just report whatever the last one was
        if ($this->exceptions and !is_null($lastexception)) {
            throw $lastexception;
        }
        return false;
    }

***REMOVED***
***REMOVED*** Close the active SMTP session if one exists.
***REMOVED*** @return void
***REMOVED***/
    public function smtpClose()
    {
        if ($this->smtp !== null) {
            if ($this->smtp->connected()) {
                $this->smtp->quit();
                $this->smtp->close();
            }
        }
    }

***REMOVED***
***REMOVED*** Set the language for error messages.
***REMOVED*** Returns false if it cannot load the language file.
***REMOVED*** The default language is English.
***REMOVED*** @param string $langcode ISO 639-1 2-character language code (e.g. French is "fr")
***REMOVED*** @param string $lang_path Path to the language file directory, with trailing separator (slash)
***REMOVED*** @return boolean
***REMOVED*** @access public
***REMOVED***/
    public function setLanguage($langcode = 'en', $lang_path = '')
    {
        // Define full set of translatable strings in English
        $PHPMAILER_LANG = array(
            'authenticate' => 'SMTP Error: Could not authenticate.',
            'connect_host' => 'SMTP Error: Could not connect to SMTP host.',
            'data_not_accepted' => 'SMTP Error: data not accepted.',
            'empty_message' => 'Message body empty',
            'encoding' => 'Unknown encoding: ',
            'execute' => 'Could not execute: ',
            'file_access' => 'Could not access file: ',
            'file_open' => 'File Error: Could not open file: ',
            'from_failed' => 'The following From address failed: ',
            'instantiate' => 'Could not instantiate mail function.',
            'invalid_address' => 'Invalid address',
            'mailer_not_supported' => ' mailer is not supported.',
            'provide_address' => 'You must provide at least one recipient email address.',
            'recipients_failed' => 'SMTP Error: The following recipients failed: ',
            'signing' => 'Signing Error: ',
            'smtp_connect_failed' => 'SMTP connect() failed.',
            'smtp_error' => 'SMTP server error: ',
            'variable_set' => 'Cannot set or reset variable: '
        );
        if (empty($lang_path)) {
            // Calculate an absolute path so it can work if CWD is not here
            $lang_path = dirname(__FILE__). DIRECTORY_SEPARATOR . 'language'. DIRECTORY_SEPARATOR;
        }
        $foundlang = true;
        $lang_file = $lang_path . 'phpmailer.lang-' . $langcode . '.php';
        if ($langcode != 'en') { // There is no English translation file
            // Make sure language file path is readable
            if (!is_readable($lang_file)) {
                $foundlang = false;
            } else {
                // Overwrite language-specific strings.
                // This way we'll never have missing translations.
                $foundlang = include $lang_file;
            }
        }
        $this->language = $PHPMAILER_LANG;
        return ($foundlang == true); // Returns false if language not found
    }

***REMOVED***
***REMOVED*** Get the array of strings for the current language.
***REMOVED*** @return array
***REMOVED***/
    public function getTranslations()
    {
        return $this->language;
    }

***REMOVED***
***REMOVED*** Create recipient headers.
***REMOVED*** @access public
***REMOVED*** @param string $type
***REMOVED*** @param array $addr An array of recipient,
***REMOVED*** where each recipient is a 2-element indexed array with element 0 containing an address
***REMOVED*** and element 1 containing a name, like:
***REMOVED*** array(array('joe@example.com', 'Joe User'), array('zoe@example.com', 'Zoe User'))
***REMOVED*** @return string
***REMOVED***/
    public function addrAppend($type, $addr)
    {
        $addresses = array();
        foreach ($addr as $address) {
            $addresses[] = $this->addrFormat($address);
        }
        return $type . ': ' . implode(', ', $addresses) . $this->LE;
    }

***REMOVED***
***REMOVED*** Format an address for use in a message header.
***REMOVED*** @access public
***REMOVED*** @param array $addr A 2-element indexed array, element 0 containing an address, element 1 containing a name
***REMOVED***      like array('joe@example.com', 'Joe User')
***REMOVED*** @return string
***REMOVED***/
    public function addrFormat($addr)
    {
        if (empty($addr[1])) { // No name provided
            return $this->secureHeader($addr[0]);
        } else {
            return $this->encodeHeader($this->secureHeader($addr[1]), 'phrase') . ' <' . $this->secureHeader(
                $addr[0]
            ) . '>';
        }
    }

***REMOVED***
***REMOVED*** Word-wrap message.
***REMOVED*** For use with mailers that do not automatically perform wrapping
***REMOVED*** and for quoted-printable encoded messages.
***REMOVED*** Original written by philippe.
***REMOVED*** @param string $message The message to wrap
***REMOVED*** @param integer $length The line length to wrap to
***REMOVED*** @param boolean $qp_mode Whether to run in Quoted-Printable mode
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function wrapText($message, $length, $qp_mode = false)
    {
        $soft_break = ($qp_mode) ? sprintf(' =%s', $this->LE) : $this->LE;
        // If utf-8 encoding is used, we will need to make sure we don't
        // split multibyte characters when we wrap
        $is_utf8 = (strtolower($this->CharSet) == 'utf-8');
        $lelen = strlen($this->LE);
        $crlflen = strlen(self::CRLF);

        $message = $this->fixEOL($message);
        if (substr($message, -$lelen) == $this->LE) {
            $message = substr($message, 0, -$lelen);
        }

        $line = explode($this->LE, $message); // Magic. We know fixEOL uses $LE
        $message = '';
        for ($i = 0; $i < count($line); $i++) {
            $line_part = explode(' ', $line[$i]);
            $buf = '';
            for ($e = 0; $e < count($line_part); $e++) {
                $word = $line_part[$e];
                if ($qp_mode and (strlen($word) > $length)) {
                    $space_left = $length - strlen($buf) - $crlflen;
                    if ($e != 0) {
                        if ($space_left > 20) {
                            $len = $space_left;
                            if ($is_utf8) {
                                $len = $this->utf8CharBoundary($word, $len);
                            } elseif (substr($word, $len - 1, 1) == '=') {
                                $len--;
                            } elseif (substr($word, $len - 2, 1) == '=') {
                                $len -= 2;
                            }
                            $part = substr($word, 0, $len);
                            $word = substr($word, $len);
                            $buf .= ' ' . $part;
                            $message .= $buf . sprintf('=%s', self::CRLF);
                        } else {
                            $message .= $buf . $soft_break;
                        }
                        $buf = '';
                    }
                    while (strlen($word) > 0) {
                        if ($length <= 0) {
                            break;
                        }
                        $len = $length;
                        if ($is_utf8) {
                            $len = $this->utf8CharBoundary($word, $len);
                        } elseif (substr($word, $len - 1, 1) == '=') {
                            $len--;
                        } elseif (substr($word, $len - 2, 1) == '=') {
                            $len -= 2;
                        }
                        $part = substr($word, 0, $len);
                        $word = substr($word, $len);

                        if (strlen($word) > 0) {
                            $message .= $part . sprintf('=%s', self::CRLF);
                        } else {
                            $buf = $part;
                        }
                    }
                } else {
                    $buf_o = $buf;
                    $buf .= ($e == 0) ? $word : (' ' . $word);

                    if (strlen($buf) > $length and $buf_o != '') {
                        $message .= $buf_o . $soft_break;
                        $buf = $word;
                    }
                }
            }
            $message .= $buf . self::CRLF;
        }

        return $message;
    }

***REMOVED***
***REMOVED*** Find the last character boundary prior to $maxLength in a utf-8
***REMOVED*** quoted (printable) encoded string.
***REMOVED*** Original written by Colin Brown.
***REMOVED*** @access public
***REMOVED*** @param string $encodedText utf-8 QP text
***REMOVED*** @param integer $maxLength   find last character boundary prior to this length
***REMOVED*** @return integer
***REMOVED***/
    public function utf8CharBoundary($encodedText, $maxLength)
    {
        $foundSplitPos = false;
        $lookBack = 3;
        while (!$foundSplitPos) {
            $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
            $encodedCharPos = strpos($lastChunk, '=');
            if ($encodedCharPos !== false) {
                // Found start of encoded character byte within $lookBack block.
                // Check the encoded byte value (the 2 chars after the '=')
                $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
                $dec = hexdec($hex);
                if ($dec < 128) { // Single byte character.
                    // If the encoded char was found at pos 0, it will fit
                    // otherwise reduce maxLength to start of the encoded char
                    $maxLength = ($encodedCharPos == 0) ? $maxLength :
                        $maxLength - ($lookBack - $encodedCharPos);
                    $foundSplitPos = true;
                } elseif ($dec >= 192) { // First byte of a multi byte character
                    // Reduce maxLength to split at start of character
                    $maxLength = $maxLength - ($lookBack - $encodedCharPos);
                    $foundSplitPos = true;
                } elseif ($dec < 192) { // Middle byte of a multi byte character, look further back
                    $lookBack += 3;
                }
            } else {
                // No encoded character found
                $foundSplitPos = true;
            }
        }
        return $maxLength;
    }

***REMOVED***
***REMOVED*** Set the body wrapping.
***REMOVED*** @access public
***REMOVED*** @return void
***REMOVED***/
    public function setWordWrap()
    {
        if ($this->WordWrap < 1) {
            return;
        }

        switch ($this->message_type) {
            case 'alt':
            case 'alt_inline':
            case 'alt_attach':
            case 'alt_inline_attach':
                $this->AltBody = $this->wrapText($this->AltBody, $this->WordWrap);
                break;
            default:
                $this->Body = $this->wrapText($this->Body, $this->WordWrap);
                break;
        }
    }

***REMOVED***
***REMOVED*** Assemble message headers.
***REMOVED*** @access public
***REMOVED*** @return string The assembled headers
***REMOVED***/
    public function createHeader()
    {
        $result = '';

        // Set the boundaries
        $uniq_id = md5(uniqid(time()));
        $this->boundary[1] = 'b1_' . $uniq_id;
        $this->boundary[2] = 'b2_' . $uniq_id;
        $this->boundary[3] = 'b3_' . $uniq_id;

        if ($this->MessageDate == '') {
            $this->MessageDate = self::rfcDate();
        }
        $result .= $this->headerLine('Date', $this->MessageDate);


        // To be created automatically by mail()
        if ($this->SingleTo === true) {
            if ($this->Mailer != 'mail') {
                foreach ($this->to as $toaddr) {
                    $this->SingleToArray[] = $this->addrFormat($toaddr);
                }
            }
        } else {
            if (count($this->to) > 0) {
                if ($this->Mailer != 'mail') {
                    $result .= $this->addrAppend('To', $this->to);
                }
            } elseif (count($this->cc) == 0) {
                $result .= $this->headerLine('To', 'undisclosed-recipients:;');
            }
        }

        $result .= $this->addrAppend('From', array(array(trim($this->From), $this->FromName)));

        // sendmail and mail() extract Cc from the header before sending
        if (count($this->cc) > 0) {
            $result .= $this->addrAppend('Cc', $this->cc);
        }

        // sendmail and mail() extract Bcc from the header before sending
        if ((
                $this->Mailer == 'sendmail' or $this->Mailer == 'qmail' or $this->Mailer == 'mail'
            )
            and count($this->bcc) > 0
        ) {
            $result .= $this->addrAppend('Bcc', $this->bcc);
        }

        if (count($this->ReplyTo) > 0) {
            $result .= $this->addrAppend('Reply-To', $this->ReplyTo);
        }

        // mail() sets the subject itself
        if ($this->Mailer != 'mail') {
            $result .= $this->headerLine('Subject', $this->encodeHeader($this->secureHeader($this->Subject)));
        }

        if ($this->MessageID != '') {
            $this->lastMessageID = $this->MessageID;
        } else {
            $this->lastMessageID = sprintf('<%s@%s>', $uniq_id, $this->ServerHostname());
        }
        $result .= $this->HeaderLine('Message-ID', $this->lastMessageID);
        $result .= $this->headerLine('X-Priority', $this->Priority);
        if ($this->XMailer == '') {
            $result .= $this->headerLine(
                'X-Mailer',
                'PHPMailer ' . $this->Version . ' (https://github.com/PHPMailer/PHPMailer/)'
            );
        } else {
            $myXmailer = trim($this->XMailer);
            if ($myXmailer) {
                $result .= $this->headerLine('X-Mailer', $myXmailer);
            }
        }

        if ($this->ConfirmReadingTo != '') {
            $result .= $this->headerLine('Disposition-Notification-To', '<' . trim($this->ConfirmReadingTo) . '>');
        }

        // Add custom headers
        for ($index = 0; $index < count($this->CustomHeader); $index++) {
            $result .= $this->headerLine(
                trim($this->CustomHeader[$index][0]),
                $this->encodeHeader(trim($this->CustomHeader[$index][1]))
            );
        }
        if (!$this->sign_key_file) {
            $result .= $this->headerLine('MIME-Version', '1.0');
            $result .= $this->getMailMIME();
        }

        return $result;
    }

***REMOVED***
***REMOVED*** Get the message MIME type headers.
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function getMailMIME()
    {
        $result = '';
        $ismultipart = true;
        switch ($this->message_type) {
            case 'inline':
                $result .= $this->headerLine('Content-Type', 'multipart/related;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', 'multipart/mixed;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'alt':
            case 'alt_inline':
                $result .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            default:
                // Catches case 'plain': and case '':
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                $ismultipart = false;
                break;
        }
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($this->Encoding != '7bit') {
            // RFC 2045 section 6.4 says multipart MIME parts may only use 7bit, 8bit or binary CTE
            if ($ismultipart) {
                if ($this->Encoding == '8bit') {
                    $result .= $this->headerLine('Content-Transfer-Encoding', '8bit');
                }
                // The only remaining alternatives are quoted-printable and base64, which are both 7bit compatible
            } else {
                $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
            }
        }

        if ($this->Mailer != 'mail') {
            $result .= $this->LE;
        }

        return $result;
    }

***REMOVED***
***REMOVED*** Returns the whole MIME message.
***REMOVED*** Includes complete headers and body.
***REMOVED*** Only valid post preSend().
***REMOVED*** @see PHPMailer::preSend()
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function getSentMIMEMessage()
    {
        return $this->MIMEHeader . $this->mailHeader . self::CRLF . $this->MIMEBody;
    }


***REMOVED***
***REMOVED*** Assemble the message body.
***REMOVED*** Returns an empty string on failure.
***REMOVED*** @access public
***REMOVED*** @throws phpmailerException
***REMOVED*** @return string The assembled message body
***REMOVED***/
    public function createBody()
    {
        $body = '';

        if ($this->sign_key_file) {
            $body .= $this->getMailMIME() . $this->LE;
        }

        $this->setWordWrap();

        $bodyEncoding = $this->Encoding;
        $bodyCharSet = $this->CharSet;
        if ($bodyEncoding == '8bit' and !$this->has8bitChars($this->Body)) {
            $bodyEncoding = '7bit';
            $bodyCharSet = 'us-ascii';
        }
        $altBodyEncoding = $this->Encoding;
        $altBodyCharSet = $this->CharSet;
        if ($altBodyEncoding == '8bit' and !$this->has8bitChars($this->AltBody)) {
            $altBodyEncoding = '7bit';
            $altBodyCharSet = 'us-ascii';
        }
        switch ($this->message_type) {
            case 'inline':
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[1]);
                break;
            case 'attach':
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'inline_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt':
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                if (!empty($this->Ical)) {
                    $body .= $this->getBoundary($this->boundary[1], '', 'text/calendar; method=REQUEST', '');
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
                    $body .= $this->LE . $this->LE;
                }
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_inline':
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt_inline_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[2]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[3] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[3], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[3]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            default:
                // catch case 'plain' and case ''
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                break;
        }

        if ($this->isError()) {
            $body = '';
        } elseif ($this->sign_key_file) {
            try {
                if (!defined('PKCS7_TEXT')) {
                    throw new phpmailerException($this->lang('signing') . ' OpenSSL extension missing.');
                }
                // @TODO would be nice to use php://temp streams here, but need to wrap for PHP < 5.1
                $file = tempnam(sys_get_temp_dir(), 'mail');
                file_put_contents($file, $body); // @TODO check this worked
                $signed = tempnam(sys_get_temp_dir(), 'signed');
                if (@openssl_pkcs7_sign(
                    $file,
                    $signed,
                    'file://' . realpath($this->sign_cert_file),
                    array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                    null
                )
                ) {
                    @unlink($file);
                    $body = file_get_contents($signed);
                    @unlink($signed);
                } else {
                    @unlink($file);
                    @unlink($signed);
                    throw new phpmailerException($this->lang('signing') . openssl_error_string());
                }
            } catch (phpmailerException $exc) {
                $body = '';
                if ($this->exceptions) {
                    throw $exc;
                }
            }
        }
        return $body;
    }

***REMOVED***
***REMOVED*** Return the start of a message boundary.
***REMOVED*** @access protected
***REMOVED*** @param string $boundary
***REMOVED*** @param string $charSet
***REMOVED*** @param string $contentType
***REMOVED*** @param string $encoding
***REMOVED*** @return string
***REMOVED***/
    protected function getBoundary($boundary, $charSet, $contentType, $encoding)
    {
        $result = '';
        if ($charSet == '') {
            $charSet = $this->CharSet;
        }
        if ($contentType == '') {
            $contentType = $this->ContentType;
        }
        if ($encoding == '') {
            $encoding = $this->Encoding;
        }
        $result .= $this->textLine('--' . $boundary);
        $result .= sprintf('Content-Type: %s; charset=%s', $contentType, $charSet);
        $result .= $this->LE;
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($encoding != '7bit') {
            $result .= $this->headerLine('Content-Transfer-Encoding', $encoding);
        }
        $result .= $this->LE;

        return $result;
    }

***REMOVED***
***REMOVED*** Return the end of a message boundary.
***REMOVED*** @access protected
***REMOVED*** @param string $boundary
***REMOVED*** @return string
***REMOVED***/
    protected function endBoundary($boundary)
    {
        return $this->LE . '--' . $boundary . '--' . $this->LE;
    }

***REMOVED***
***REMOVED*** Set the message type.
***REMOVED*** PHPMailer only supports some preset message types,
***REMOVED*** not arbitrary MIME structures.
***REMOVED*** @access protected
***REMOVED*** @return void
***REMOVED***/
    protected function setMessageType()
    {
        $type = array();
        if ($this->alternativeExists()) {
            $type[] = 'alt';
        }
        if ($this->inlineImageExists()) {
            $type[] = 'inline';
        }
        if ($this->attachmentExists()) {
            $type[] = 'attach';
        }
        $this->message_type = implode('_', $type);
        if ($this->message_type == '') {
            $this->message_type = 'plain';
        }
    }

***REMOVED***
***REMOVED*** Format a header line.
***REMOVED*** @access public
***REMOVED*** @param string $name
***REMOVED*** @param string $value
***REMOVED*** @return string
***REMOVED***/
    public function headerLine($name, $value)
    {
        return $name . ': ' . $value . $this->LE;
    }

***REMOVED***
***REMOVED*** Return a formatted mail line.
***REMOVED*** @access public
***REMOVED*** @param string $value
***REMOVED*** @return string
***REMOVED***/
    public function textLine($value)
    {
        return $value . $this->LE;
    }

***REMOVED***
***REMOVED*** Add an attachment from a path on the filesystem.
***REMOVED*** Returns false if the file could not be found or read.
***REMOVED*** @param string $path Path to the attachment.
***REMOVED*** @param string $name Overrides the attachment name.
***REMOVED*** @param string $encoding File encoding (see $Encoding).
***REMOVED*** @param string $type File extension (MIME) type.
***REMOVED*** @param string $disposition Disposition to use
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED***/
    public function addAttachment($path, $name = '', $encoding = 'base64', $type = '', $disposition = 'attachment')
    {
        try {
            if (!@is_file($path)) {
                throw new phpmailerException($this->lang('file_access') . $path, self::STOP_CONTINUE);
            }

            // If a MIME type is not specified, try to work it out from the file name
            if ($type == '') {
                $type = self::filenameToType($path);
            }

            $filename = basename($path);
            if ($name == '') {
                $name = $filename;
            }

            $this->attachment[] = array(
                0 => $path,
                1 => $filename,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => false, // isStringAttachment
                6 => $disposition,
                7 => 0
            );

        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
        return true;
    }

***REMOVED***
***REMOVED*** Return the array of attachments.
***REMOVED*** @return array
***REMOVED***/
    public function getAttachments()
    {
        return $this->attachment;
    }

***REMOVED***
***REMOVED*** Attach all file, string, and binary attachments to the message.
***REMOVED*** Returns an empty string on failure.
***REMOVED*** @access protected
***REMOVED*** @param string $disposition_type
***REMOVED*** @param string $boundary
***REMOVED*** @return string
***REMOVED***/
    protected function attachAll($disposition_type, $boundary)
    {
        // Return text of body
        $mime = array();
        $cidUniq = array();
        $incl = array();

        // Add all attachments
        foreach ($this->attachment as $attachment) {
            // Check if it is a valid disposition_filter
            if ($attachment[6] == $disposition_type) {
                // Check for string attachment
                $string = '';
                $path = '';
                $bString = $attachment[5];
                if ($bString) {
                    $string = $attachment[0];
                } else {
                    $path = $attachment[0];
                }

                $inclhash = md5(serialize($attachment));
                if (in_array($inclhash, $incl)) {
                    continue;
                }
                $incl[] = $inclhash;
                $name = $attachment[2];
                $encoding = $attachment[3];
                $type = $attachment[4];
                $disposition = $attachment[6];
                $cid = $attachment[7];
                if ($disposition == 'inline' && isset($cidUniq[$cid])) {
                    continue;
                }
                $cidUniq[$cid] = true;

                $mime[] = sprintf('--%s%s', $boundary, $this->LE);
                $mime[] = sprintf(
                    'Content-Type: %s; name="%s"%s',
                    $type,
                    $this->encodeHeader($this->secureHeader($name)),
                    $this->LE
                );
                // RFC1341 part 5 says 7bit is assumed if not specified
                if ($encoding != '7bit') {
                    $mime[] = sprintf('Content-Transfer-Encoding: %s%s', $encoding, $this->LE);
                }

                if ($disposition == 'inline') {
                    $mime[] = sprintf('Content-ID: <%s>%s', $cid, $this->LE);
                }

                // If a filename contains any of these chars, it should be quoted,
                // but not otherwise: RFC2183 & RFC2045 5.1
                // Fixes a warning in IETF's msglint MIME checker
                // Allow for bypassing the Content-Disposition header totally
                if (!(empty($disposition))) {
                    if (preg_match('/[ \(\)<>@,;:\\"\/\[\]\?=]/', $name)) {
                        $mime[] = sprintf(
                            'Content-Disposition: %s; filename="%s"%s',
                            $disposition,
                            $this->encodeHeader($this->secureHeader($name)),
                            $this->LE . $this->LE
                        );
                    } else {
                        $mime[] = sprintf(
                            'Content-Disposition: %s; filename=%s%s',
                            $disposition,
                            $this->encodeHeader($this->secureHeader($name)),
                            $this->LE . $this->LE
                        );
                    }
                } else {
                    $mime[] = $this->LE;
                }

                // Encode as string attachment
                if ($bString) {
                    $mime[] = $this->encodeString($string, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                } else {
                    $mime[] = $this->encodeFile($path, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                }
            }
        }

        $mime[] = sprintf('--%s--%s', $boundary, $this->LE);

        return implode('', $mime);
    }

***REMOVED***
***REMOVED*** Encode a file attachment in requested format.
***REMOVED*** Returns an empty string on failure.
***REMOVED*** @param string $path The full path to the file
***REMOVED*** @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
***REMOVED*** @throws phpmailerException
***REMOVED*** @see EncodeFile(encodeFile
***REMOVED*** @access protected
***REMOVED*** @return string
***REMOVED***/
    protected function encodeFile($path, $encoding = 'base64')
    {
        try {
            if (!is_readable($path)) {
                throw new phpmailerException($this->lang('file_open') . $path, self::STOP_CONTINUE);
            }
            $magic_quotes = get_magic_quotes_runtime();
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime(false);
                } else {
                    //Doesn't exist in PHP 5.4, but we don't need to check because
                    //get_magic_quotes_runtime always returns false in 5.4+
                    //so it will never get here
                    ini_set('magic_quotes_runtime', 0);
                }
            }
            $file_buffer = file_get_contents($path);
            $file_buffer = $this->encodeString($file_buffer, $encoding);
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime($magic_quotes);
                } else {
                    ini_set('magic_quotes_runtime', ($magic_quotes?'1':'0'));
                }
            }
            return $file_buffer;
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            return '';
        }
    }

***REMOVED***
***REMOVED*** Encode a string in requested format.
***REMOVED*** Returns an empty string on failure.
***REMOVED*** @param string $str The text to encode
***REMOVED*** @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function encodeString($str, $encoding = 'base64')
    {
        $encoded = '';
        switch (strtolower($encoding)) {
            case 'base64':
                $encoded = chunk_split(base64_encode($str), 76, $this->LE);
                break;
            case '7bit':
            case '8bit':
                $encoded = $this->fixEOL($str);
                // Make sure it ends with a line break
                if (substr($encoded, -(strlen($this->LE))) != $this->LE) {
                    $encoded .= $this->LE;
                }
                break;
            case 'binary':
                $encoded = $str;
                break;
            case 'quoted-printable':
                $encoded = $this->encodeQP($str);
                break;
            default:
                $this->setError($this->lang('encoding') . $encoding);
                break;
        }
        return $encoded;
    }

***REMOVED***
***REMOVED*** Encode a header string optimally.
***REMOVED*** Picks shortest of Q, B, quoted-printable or none.
***REMOVED*** @access public
***REMOVED*** @param string $str
***REMOVED*** @param string $position
***REMOVED*** @return string
***REMOVED***/
    public function encodeHeader($str, $position = 'text')
    {
        $matchcount = 0;
        switch (strtolower($position)) {
            case 'phrase':
                if (!preg_match('/[\200-\377]/', $str)) {
                    // Can't use addslashes as we don't know the value of magic_quotes_sybase
                    $encoded = addcslashes($str, "\0..\37\177\\\"");
                    if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str)) {
                        return ($encoded);
                    } else {
                        return ("\"$encoded\"");
                    }
                }
                $matchcount = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
                break;
   ***REMOVED*****REMOVED*** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                $matchcount = preg_match_all('/[()"]/', $str, $matches);
                // Intentional fall-through
            case 'text':
            default:
                $matchcount += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
                break;
        }

        if ($matchcount == 0) { // There are no chars that need encoding
            return ($str);
        }

        $maxlen = 75 - 7 - strlen($this->CharSet);
        // Try to select the encoding which should produce the shortest output
        if ($matchcount > strlen($str) / 3) {
            // More than a third of the content will need encoding, so B encoding will be most efficient
            $encoding = 'B';
            if (function_exists('mb_strlen') && $this->hasMultiBytes($str)) {
                // Use a custom function which correctly encodes and wraps long
                // multibyte strings without breaking lines within a character
                $encoded = $this->base64EncodeWrapMB($str, "\n");
            } else {
                $encoded = base64_encode($str);
                $maxlen -= $maxlen % 4;
                $encoded = trim(chunk_split($encoded, $maxlen, "\n"));
            }
        } else {
            $encoding = 'Q';
            $encoded = $this->encodeQ($str, $position);
            $encoded = $this->wrapText($encoded, $maxlen, true);
            $encoded = str_replace('=' . self::CRLF, "\n", trim($encoded));
        }

        $encoded = preg_replace('/^(.*)$/m', ' =?' . $this->CharSet . "?$encoding?\\1?=", $encoded);
        $encoded = trim(str_replace("\n", $this->LE, $encoded));

        return $encoded;
    }

***REMOVED***
***REMOVED*** Check if a string contains multi-byte characters.
***REMOVED*** @access public
***REMOVED*** @param string $str multi-byte text to wrap encode
***REMOVED*** @return boolean
***REMOVED***/
    public function hasMultiBytes($str)
    {
        if (function_exists('mb_strlen')) {
            return (strlen($str) > mb_strlen($str, $this->CharSet));
        } else { // Assume no multibytes (we can't handle without mbstring functions anyway)
            return false;
        }
    }

***REMOVED***
***REMOVED*** Does a string contain any 8-bit chars (in any charset)?
***REMOVED*** @param string $text
***REMOVED*** @return boolean
***REMOVED***/
    public function has8bitChars($text)
    {
        return (boolean)preg_match('/[\x80-\xFF]/', $text);
    }

***REMOVED***
***REMOVED*** Encode and wrap long multibyte strings for mail headers
***REMOVED*** without breaking lines within a character.
***REMOVED*** Adapted from a function by paravoid
***REMOVED*** @link http://www.php.net/manual/en/function.mb-encode-mimeheader.php#60283
***REMOVED*** @access public
***REMOVED*** @param string $str multi-byte text to wrap encode
***REMOVED*** @param string $linebreak string to use as linefeed/end-of-line
***REMOVED*** @return string
***REMOVED***/
    public function base64EncodeWrapMB($str, $linebreak = null)
    {
        $start = '=?' . $this->CharSet . '?B?';
        $end = '?=';
        $encoded = '';
        if ($linebreak === null) {
            $linebreak = $this->LE;
        }

        $mb_length = mb_strlen($str, $this->CharSet);
        // Each line must have length <= 75, including $start and $end
        $length = 75 - strlen($start) - strlen($end);
        // Average multi-byte ratio
        $ratio = $mb_length / strlen($str);
        // Base64 has a 4:3 ratio
        $avgLength = floor($length * $ratio * .75);

        for ($i = 0; $i < $mb_length; $i += $offset) {
            $lookBack = 0;
            do {
                $offset = $avgLength - $lookBack;
                $chunk = mb_substr($str, $i, $offset, $this->CharSet);
                $chunk = base64_encode($chunk);
                $lookBack++;
            } while (strlen($chunk) > $length);
            $encoded .= $chunk . $linebreak;
        }

        // Chomp the last linefeed
        $encoded = substr($encoded, 0, -strlen($linebreak));
        return $encoded;
    }

***REMOVED***
***REMOVED*** Encode a string in quoted-printable format.
***REMOVED*** According to RFC2045 section 6.7.
***REMOVED*** @access public
***REMOVED*** @param string $string The text to encode
***REMOVED*** @param integer $line_max Number of chars allowed on a line before wrapping
***REMOVED*** @return string
***REMOVED*** @link http://www.php.net/manual/en/function.quoted-printable-decode.php#89417 Adapted from this comment
***REMOVED***/
    public function encodeQP($string, $line_max = 76)
    {
        if (function_exists('quoted_printable_encode')) { // Use native function if it's available (>= PHP5.3)
            return $this->fixEOL(quoted_printable_encode($string));
        }
        // Fall back to a pure PHP implementation
        $string = str_replace(
            array('%20', '%0D%0A.', '%0D%0A', '%'),
            array(' ', "\r\n=2E", "\r\n", '='),
            rawurlencode($string)
        );
        $string = preg_replace('/[^\r\n]{' . ($line_max - 3) . '}[^=\r\n]{2}/', "$0=\r\n", $string);
        return $this->fixEOL($string);
    }

***REMOVED***
***REMOVED*** Backward compatibility wrapper for an old QP encoding function that was removed.
***REMOVED*** @see PHPMailer::encodeQP()
***REMOVED*** @access public
***REMOVED*** @param string $string
***REMOVED*** @param integer $line_max
***REMOVED*** @param boolean $space_conv
***REMOVED*** @return string
***REMOVED*** @deprecated Use encodeQP instead.
***REMOVED***/
    public function encodeQPphp(
        $string,
        $line_max = 76,
    ***REMOVED*** @noinspection PhpUnusedParameterInspection */ $space_conv = false
    ) {
        return $this->encodeQP($string, $line_max);
    }

***REMOVED***
***REMOVED*** Encode a string using Q encoding.
***REMOVED*** @link http://tools.ietf.org/html/rfc2047
***REMOVED*** @param string $str the text to encode
***REMOVED*** @param string $position Where the text is going to be used, see the RFC for what that means
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function encodeQ($str, $position = 'text')
    {
        // There should not be any EOL in the string
        $pattern = '';
        $encoded = str_replace(array("\r", "\n"), '', $str);
        switch (strtolower($position)) {
            case 'phrase':
                // RFC 2047 section 5.3
                $pattern = '^A-Za-z0-9!*+\/ -';
                break;
   ***REMOVED*****REMOVED*** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                // RFC 2047 section 5.2
                $pattern = '\(\)"';
                // intentional fall-through
                // for this reason we build the $pattern without including delimiters and []
            case 'text':
            default:
                // RFC 2047 section 5.1
                // Replace every high ascii, control, =, ? and _ characters
                $pattern = '\000-\011\013\014\016-\037\075\077\137\177-\377' . $pattern;
                break;
        }
        $matches = array();
        if (preg_match_all("/[{$pattern}]/", $encoded, $matches)) {
            // If the string contains an '=', make sure it's the first thing we replace
            // so as to avoid double-encoding
            $eqkey = array_search('=', $matches[0]);
            if ($eqkey !== false) {
                unset($matches[0][$eqkey]);
                array_unshift($matches[0], '=');
            }
            foreach (array_unique($matches[0]) as $char) {
                $encoded = str_replace($char, '=' . sprintf('%02X', ord($char)), $encoded);
            }
        }
        // Replace every spaces to _ (more readable than =20)
        return str_replace(' ', '_', $encoded);
    }


***REMOVED***
***REMOVED*** Add a string or binary attachment (non-filesystem).
***REMOVED*** This method can be used to attach ascii or binary data,
***REMOVED*** such as a BLOB record from a database.
***REMOVED*** @param string $string String attachment data.
***REMOVED*** @param string $filename Name of the attachment.
***REMOVED*** @param string $encoding File encoding (see $Encoding).
***REMOVED*** @param string $type File extension (MIME) type.
***REMOVED*** @param string $disposition Disposition to use
***REMOVED*** @return void
***REMOVED***/
    public function addStringAttachment(
        $string,
        $filename,
        $encoding = 'base64',
        $type = '',
        $disposition = 'attachment'
    ) {
        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($filename);
        }
        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $filename,
            2 => basename($filename),
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => 0
        );
    }

***REMOVED***
***REMOVED*** Add an embedded (inline) attachment from a file.
***REMOVED*** This can include images, sounds, and just about any other document type.
***REMOVED*** These differ from 'regular' attachmants in that they are intended to be
***REMOVED*** displayed inline with the message, not just attached for download.
***REMOVED*** This is used in HTML messages that embed the images
***REMOVED*** the HTML refers to using the $cid value.
***REMOVED*** @param string $path Path to the attachment.
***REMOVED*** @param string $cid Content ID of the attachment; Use this to reference
***REMOVED***        the content when using an embedded image in HTML.
***REMOVED*** @param string $name Overrides the attachment name.
***REMOVED*** @param string $encoding File encoding (see $Encoding).
***REMOVED*** @param string $type File MIME type.
***REMOVED*** @param string $disposition Disposition to use
***REMOVED*** @return boolean True on successfully adding an attachment
***REMOVED***/
    public function addEmbeddedImage($path, $cid, $name = '', $encoding = 'base64', $type = '', $disposition = 'inline')
    {
        if (!@is_file($path)) {
            $this->setError($this->lang('file_access') . $path);
            return false;
        }

        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($path);
        }

        $filename = basename($path);
        if ($name == '') {
            $name = $filename;
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $path,
            1 => $filename,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => false, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

***REMOVED***
***REMOVED*** Add an embedded stringified attachment.
***REMOVED*** This can include images, sounds, and just about any other document type.
***REMOVED*** Be sure to set the $type to an image type for images:
***REMOVED*** JPEG images use 'image/jpeg', GIF uses 'image/gif', PNG uses 'image/png'.
***REMOVED*** @param string $string The attachment binary data.
***REMOVED*** @param string $cid Content ID of the attachment; Use this to reference
***REMOVED***        the content when using an embedded image in HTML.
***REMOVED*** @param string $name
***REMOVED*** @param string $encoding File encoding (see $Encoding).
***REMOVED*** @param string $type MIME type.
***REMOVED*** @param string $disposition Disposition to use
***REMOVED*** @return boolean True on successfully adding an attachment
***REMOVED***/
    public function addStringEmbeddedImage(
        $string,
        $cid,
        $name = '',
        $encoding = 'base64',
        $type = '',
        $disposition = 'inline'
    ) {
        // If a MIME type is not specified, try to work it out from the name
        if ($type == '') {
            $type = self::filenameToType($name);
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $name,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

***REMOVED***
***REMOVED*** Check if an inline attachment is present.
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function inlineImageExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'inline') {
                return true;
            }
        }
        return false;
    }

***REMOVED***
***REMOVED*** Check if an attachment (non-inline) is present.
***REMOVED*** @return boolean
***REMOVED***/
    public function attachmentExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'attachment') {
                return true;
            }
        }
        return false;
    }

***REMOVED***
***REMOVED*** Check if this message has an alternative body set.
***REMOVED*** @return boolean
***REMOVED***/
    public function alternativeExists()
    {
        return !empty($this->AltBody);
    }

***REMOVED***
***REMOVED*** Clear all To recipients.
***REMOVED*** @return void
***REMOVED***/
    public function clearAddresses()
    {
        foreach ($this->to as $to) {
            unset($this->all_recipients[strtolower($to[0])]);
        }
        $this->to = array();
    }

***REMOVED***
***REMOVED*** Clear all CC recipients.
***REMOVED*** @return void
***REMOVED***/
    public function clearCCs()
    {
        foreach ($this->cc as $cc) {
            unset($this->all_recipients[strtolower($cc[0])]);
        }
        $this->cc = array();
    }

***REMOVED***
***REMOVED*** Clear all BCC recipients.
***REMOVED*** @return void
***REMOVED***/
    public function clearBCCs()
    {
        foreach ($this->bcc as $bcc) {
            unset($this->all_recipients[strtolower($bcc[0])]);
        }
        $this->bcc = array();
    }

***REMOVED***
***REMOVED*** Clear all ReplyTo recipients.
***REMOVED*** @return void
***REMOVED***/
    public function clearReplyTos()
    {
        $this->ReplyTo = array();
    }

***REMOVED***
***REMOVED*** Clear all recipient types.
***REMOVED*** @return void
***REMOVED***/
    public function clearAllRecipients()
    {
        $this->to = array();
        $this->cc = array();
        $this->bcc = array();
        $this->all_recipients = array();
    }

***REMOVED***
***REMOVED*** Clear all filesystem, string, and binary attachments.
***REMOVED*** @return void
***REMOVED***/
    public function clearAttachments()
    {
        $this->attachment = array();
    }

***REMOVED***
***REMOVED*** Clear all custom headers.
***REMOVED*** @return void
***REMOVED***/
    public function clearCustomHeaders()
    {
        $this->CustomHeader = array();
    }

***REMOVED***
***REMOVED*** Add an error message to the error container.
***REMOVED*** @access protected
***REMOVED*** @param string $msg
***REMOVED*** @return void
***REMOVED***/
    protected function setError($msg)
    {
        $this->error_count++;
        if ($this->Mailer == 'smtp' and !is_null($this->smtp)) {
            $lasterror = $this->smtp->getError();
            if (!empty($lasterror) and array_key_exists('smtp_msg', $lasterror)) {
                $msg .= '<p>' . $this->lang('smtp_error') . $lasterror['smtp_msg'] . "</p>\n";
            }
        }
        $this->ErrorInfo = $msg;
    }

***REMOVED***
***REMOVED*** Return an RFC 822 formatted date.
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED*** @static
***REMOVED***/
    public static function rfcDate()
    {
        // Set the time zone to whatever the default is to avoid 500 errors
        // Will default to UTC if it's not set properly in php.ini
        date_default_timezone_set(@date_default_timezone_get());
        return date('D, j M Y H:i:s O');
    }

***REMOVED***
***REMOVED*** Get the server hostname.
***REMOVED*** Returns 'localhost.localdomain' if unknown.
***REMOVED*** @access protected
***REMOVED*** @return string
***REMOVED***/
    protected function serverHostname()
    {
        $result = 'localhost.localdomain';
        if (!empty($this->Hostname)) {
            $result = $this->Hostname;
        } elseif (isset($_SERVER) and array_key_exists('SERVER_NAME', $_SERVER) and !empty($_SERVER['SERVER_NAME'])) {
            $result = $_SERVER['SERVER_NAME'];
        } elseif (function_exists('gethostname') && gethostname() !== false) {
            $result = gethostname();
        } elseif (php_uname('n') !== false) {
            $result = php_uname('n');
        }
        return $result;
    }

***REMOVED***
***REMOVED*** Get an error message in the current language.
***REMOVED*** @access protected
***REMOVED*** @param string $key
***REMOVED*** @return string
***REMOVED***/
    protected function lang($key)
    {
        if (count($this->language) < 1) {
            $this->setLanguage('en'); // set the default language
        }

        if (isset($this->language[$key])) {
            return $this->language[$key];
        } else {
            return 'Language string failed to load: ' . $key;
        }
    }

***REMOVED***
***REMOVED*** Check if an error occurred.
***REMOVED*** @access public
***REMOVED*** @return boolean True if an error did occur.
***REMOVED***/
    public function isError()
    {
        return ($this->error_count > 0);
    }

***REMOVED***
***REMOVED*** Ensure consistent line endings in a string.
***REMOVED*** Changes every end of line from CRLF, CR or LF to $this->LE.
***REMOVED*** @access public
***REMOVED*** @param string $str String to fixEOL
***REMOVED*** @return string
***REMOVED***/
    public function fixEOL($str)
    {
        // Normalise to \n
        $nstr = str_replace(array("\r\n", "\r"), "\n", $str);
        // Now convert LE as needed
        if ($this->LE !== "\n") {
            $nstr = str_replace("\n", $this->LE, $nstr);
        }
        return $nstr;
    }

***REMOVED***
***REMOVED*** Add a custom header.
***REMOVED*** $name value can be overloaded to contain
***REMOVED*** both header name and value (name:value)
***REMOVED*** @access public
***REMOVED*** @param string $name Custom header name
***REMOVED*** @param string $value Header value
***REMOVED*** @return void
***REMOVED***/
    public function addCustomHeader($name, $value = null)
    {
        if ($value === null) {
            // Value passed in as name:value
            $this->CustomHeader[] = explode(':', $name, 2);
        } else {
            $this->CustomHeader[] = array($name, $value);
        }
    }

***REMOVED***
***REMOVED*** Create a message from an HTML string.
***REMOVED*** Automatically makes modifications for inline images and backgrounds
***REMOVED*** and creates a plain-text version by converting the HTML.
***REMOVED*** Overwrites any existing values in $this->Body and $this->AltBody
***REMOVED*** @access public
***REMOVED*** @param string $message HTML message string
***REMOVED*** @param string $basedir baseline directory for path
***REMOVED*** @param boolean $advanced Whether to use the advanced HTML to text converter
***REMOVED*** @return string $message
***REMOVED***/
    public function msgHTML($message, $basedir = '', $advanced = false)
    {
        preg_match_all('/(src|background)=["\'](.*)["\']/Ui', $message, $images);
        if (isset($images[2])) {
            foreach ($images[2] as $imgindex => $url) {
                // do not change urls for absolute images (thanks to corvuscorax)
                if (!preg_match('#^[A-z]+://#', $url)) {
                    $filename = basename($url);
                    $directory = dirname($url);
                    if ($directory == '.') {
                        $directory = '';
                    }
                    $cid = md5($url) . '@phpmailer.0'; // RFC2392 S 2
                    if (strlen($basedir) > 1 && substr($basedir, -1) != '/') {
                        $basedir .= '/';
                    }
                    if (strlen($directory) > 1 && substr($directory, -1) != '/') {
                        $directory .= '/';
                    }
                    if ($this->addEmbeddedImage(
                        $basedir . $directory . $filename,
                        $cid,
                        $filename,
                        'base64',
                        self::_mime_types(self::mb_pathinfo($filename, PATHINFO_EXTENSION))
                    )
                    ) {
                        $message = preg_replace(
                            '/' . $images[1][$imgindex] . '=["\']' . preg_quote($url, '/') . '["\']/Ui',
                            $images[1][$imgindex] . '="cid:' . $cid . '"',
                            $message
                        );
                    }
                }
            }
        }
        $this->isHTML(true);
        // Convert all message body line breaks to CRLF, makes quoted-printable encoding work much better
        $this->Body = $this->normalizeBreaks($message);
        $this->AltBody = $this->normalizeBreaks($this->html2text($message, $advanced));
        if (empty($this->AltBody)) {
            $this->AltBody = 'To view this email message, open it in a program that understands HTML!' .
                self::CRLF . self::CRLF;
        }
        return $this->Body;
    }

***REMOVED***
***REMOVED*** Convert an HTML string into plain text.
***REMOVED*** @param string $html The HTML text to convert
***REMOVED*** @param boolean $advanced Should this use the more complex html2text converter or just a simple one?
***REMOVED*** @return string
***REMOVED***/
    public function html2text($html, $advanced = false)
    {
        if ($advanced) {
            require_once 'extras/class.html2text.php';
            $htmlconverter = new html2text($html);
            return $htmlconverter->get_text();
        }
        return html_entity_decode(
            trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/si', '', $html))),
            ENT_QUOTES,
            $this->CharSet
        );
    }

***REMOVED***
***REMOVED*** Get the MIME type for a file extension.
***REMOVED*** @param string $ext File extension
***REMOVED*** @access public
***REMOVED*** @return string MIME type of file.
***REMOVED*** @static
***REMOVED***/
    public static function _mime_types($ext = '')
    {
        $mimes = array(
            'xl' => 'application/excel',
            'hqx' => 'application/mac-binhex40',
            'cpt' => 'application/mac-compactpro',
            'bin' => 'application/macbinary',
            'doc' => 'application/msword',
            'word' => 'application/msword',
            'class' => 'application/octet-stream',
            'dll' => 'application/octet-stream',
            'dms' => 'application/octet-stream',
            'exe' => 'application/octet-stream',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'psd' => 'application/octet-stream',
            'sea' => 'application/octet-stream',
            'so' => 'application/octet-stream',
            'oda' => 'application/oda',
            'pdf' => 'application/pdf',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            'smi' => 'application/smil',
            'smil' => 'application/smil',
            'mif' => 'application/vnd.mif',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc' => 'application/vnd.wap.wmlc',
            'dcr' => 'application/x-director',
            'dir' => 'application/x-director',
            'dxr' => 'application/x-director',
            'dvi' => 'application/x-dvi',
            'gtar' => 'application/x-gtar',
            'php3' => 'application/x-httpd-php',
            'php4' => 'application/x-httpd-php',
            'php' => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps' => 'application/x-httpd-php-source',
            'js' => 'application/x-javascript',
            'swf' => 'application/x-shockwave-flash',
            'sit' => 'application/x-stuffit',
            'tar' => 'application/x-tar',
            'tgz' => 'application/x-tar',
            'xht' => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip' => 'application/zip',
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mp2' => 'audio/mpeg',
            'mp3' => 'audio/mpeg',
            'mpga' => 'audio/mpeg',
            'aif' => 'audio/x-aiff',
            'aifc' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'ram' => 'audio/x-pn-realaudio',
            'rm' => 'audio/x-pn-realaudio',
            'rpm' => 'audio/x-pn-realaudio-plugin',
            'ra' => 'audio/x-realaudio',
            'wav' => 'audio/x-wav',
            'bmp' => 'image/bmp',
            'gif' => 'image/gif',
            'jpeg' => 'image/jpeg',
            'jpe' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'eml' => 'message/rfc822',
            'css' => 'text/css',
            'html' => 'text/html',
            'htm' => 'text/html',
            'shtml' => 'text/html',
            'log' => 'text/plain',
            'text' => 'text/plain',
            'txt' => 'text/plain',
            'rtx' => 'text/richtext',
            'rtf' => 'text/rtf',
            'vcf' => 'text/vcard',
            'vcard' => 'text/vcard',
            'xml' => 'text/xml',
            'xsl' => 'text/xml',
            'mpeg' => 'video/mpeg',
            'mpe' => 'video/mpeg',
            'mpg' => 'video/mpeg',
            'mov' => 'video/quicktime',
            'qt' => 'video/quicktime',
            'rv' => 'video/vnd.rn-realvideo',
            'avi' => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie'
        );
        return (array_key_exists(strtolower($ext), $mimes) ? $mimes[strtolower($ext)]: 'application/octet-stream');
    }

***REMOVED***
***REMOVED*** Map a file name to a MIME type.
***REMOVED*** Defaults to 'application/octet-stream', i.e.. arbitrary binary data.
***REMOVED*** @param string $filename A file name or full path, does not need to exist as a file
***REMOVED*** @return string
***REMOVED*** @static
***REMOVED***/
    public static function filenameToType($filename)
    {
        // In case the path is a URL, strip any query string before getting extension
        $qpos = strpos($filename, '?');
        if ($qpos !== false) {
            $filename = substr($filename, 0, $qpos);
        }
        $pathinfo = self::mb_pathinfo($filename);
        return self::_mime_types($pathinfo['extension']);
    }

***REMOVED***
***REMOVED*** Multi-byte-safe pathinfo replacement.
***REMOVED*** Drop-in replacement for pathinfo(), but multibyte-safe, cross-platform-safe, old-version-safe.
***REMOVED*** Works similarly to the one in PHP >= 5.2.0
***REMOVED*** @link http://www.php.net/manual/en/function.pathinfo.php#107461
***REMOVED*** @param string $path A filename or path, does not need to exist as a file
***REMOVED*** @param integer|string $options Either a PATHINFO_* constant,
***REMOVED***      or a string name to return only the specified piece, allows 'filename' to work on PHP < 5.2
***REMOVED*** @return string|array
***REMOVED*** @static
***REMOVED***/
    public static function mb_pathinfo($path, $options = null)
    {
        $ret = array('dirname' => '', 'basename' => '', 'extension' => '', 'filename' => '');
        $pathinfo = array();
        if (preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'] = $pathinfo[1];
            }
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'] = $pathinfo[2];
            }
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'] = $pathinfo[5];
            }
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'] = $pathinfo[3];
            }
        }
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'];
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'];
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'];
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'];
            default:
                return $ret;
        }
    }

***REMOVED***
***REMOVED*** Set or reset instance properties.
***REMOVED***
***REMOVED*** Usage Example:
***REMOVED*** $page->set('X-Priority', '3');
***REMOVED***
***REMOVED*** @access public
***REMOVED*** @param string $name
***REMOVED*** @param mixed $value
***REMOVED*** NOTE: will not work with arrays, there are no arrays to set/reset
***REMOVED*** @throws phpmailerException
***REMOVED*** @return boolean
***REMOVED*** @TODO Should this not be using __set() magic function?
***REMOVED***/
    public function set($name, $value = '')
    {
        try {
            if (isset($this->$name)) {
                $this->$name = $value;
            } else {
                throw new phpmailerException($this->lang('variable_set') . $name, self::STOP_CRITICAL);
            }
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            if ($exc->getCode() == self::STOP_CRITICAL) {
                return false;
            }
        }
        return true;
    }

***REMOVED***
***REMOVED*** Strip newlines to prevent header injection.
***REMOVED*** @access public
***REMOVED*** @param string $str
***REMOVED*** @return string
***REMOVED***/
    public function secureHeader($str)
    {
        return trim(str_replace(array("\r", "\n"), '', $str));
    }

***REMOVED***
***REMOVED*** Normalize line breaks in a string.
***REMOVED*** Converts UNIX LF, Mac CR and Windows CRLF line breaks into a single line break format.
***REMOVED*** Defaults to CRLF (for message bodies) and preserves consecutive breaks.
***REMOVED*** @param string $text
***REMOVED*** @param string $breaktype What kind of line break to use, defaults to CRLF
***REMOVED*** @return string
***REMOVED*** @access public
***REMOVED*** @static
***REMOVED***/
    public static function normalizeBreaks($text, $breaktype = "\r\n")
    {
        return preg_replace('/(\r\n|\r|\n)/ms', $breaktype, $text);
    }


***REMOVED***
***REMOVED*** Set the public and private key files and password for S/MIME signing.
***REMOVED*** @access public
***REMOVED*** @param string $cert_filename
***REMOVED*** @param string $key_filename
***REMOVED*** @param string $key_pass Password for private key
***REMOVED***/
    public function sign($cert_filename, $key_filename, $key_pass)
    {
        $this->sign_cert_file = $cert_filename;
        $this->sign_key_file = $key_filename;
        $this->sign_key_pass = $key_pass;
    }

***REMOVED***
***REMOVED*** Quoted-Printable-encode a DKIM header.
***REMOVED*** @access public
***REMOVED*** @param string $txt
***REMOVED*** @return string
***REMOVED***/
    public function DKIM_QP($txt)
    {
        $line = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $ord = ord($txt[$i]);
            if (((0x21 <= $ord) && ($ord <= 0x3A)) || $ord == 0x3C || ((0x3E <= $ord) && ($ord <= 0x7E))) {
                $line .= $txt[$i];
            } else {
                $line .= '=' . sprintf('%02X', $ord);
            }
        }
        return $line;
    }

***REMOVED***
***REMOVED*** Generate a DKIM signature.
***REMOVED*** @access public
***REMOVED*** @param string $signHeader
***REMOVED*** @throws phpmailerException
***REMOVED*** @return string
***REMOVED***/
    public function DKIM_Sign($signHeader)
    {
        if (!defined('PKCS7_TEXT')) {
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('signing') . ' OpenSSL extension missing.');
            }
            return '';
        }
        $privKeyStr = file_get_contents($this->DKIM_private);
        if ($this->DKIM_passphrase != '') {
            $privKey = openssl_pkey_get_private($privKeyStr, $this->DKIM_passphrase);
        } else {
            $privKey = $privKeyStr;
        }
        if (openssl_sign($signHeader, $signature, $privKey)) {
            return base64_encode($signature);
        }
        return '';
    }

***REMOVED***
***REMOVED*** Generate a DKIM canonicalization header.
***REMOVED*** @access public
***REMOVED*** @param string $signHeader Header
***REMOVED*** @return string
***REMOVED***/
    public function DKIM_HeaderC($signHeader)
    {
        $signHeader = preg_replace('/\r\n\s+/', ' ', $signHeader);
        $lines = explode("\r\n", $signHeader);
        foreach ($lines as $key => $line) {
            list($heading, $value) = explode(':', $line, 2);
            $heading = strtolower($heading);
            $value = preg_replace('/\s+/', ' ', $value); // Compress useless spaces
            $lines[$key] = $heading . ':' . trim($value); // Don't forget to remove WSP around the value
        }
        $signHeader = implode("\r\n", $lines);
        return $signHeader;
    }

***REMOVED***
***REMOVED*** Generate a DKIM canonicalization body.
***REMOVED*** @access public
***REMOVED*** @param string $body Message Body
***REMOVED*** @return string
***REMOVED***/
    public function DKIM_BodyC($body)
    {
        if ($body == '') {
            return "\r\n";
        }
        // stabilize line endings
        $body = str_replace("\r\n", "\n", $body);
        $body = str_replace("\n", "\r\n", $body);
        // END stabilize line endings
        while (substr($body, strlen($body) - 4, 4) == "\r\n\r\n") {
            $body = substr($body, 0, strlen($body) - 2);
        }
        return $body;
    }

***REMOVED***
***REMOVED*** Create the DKIM header and body in a new message header.
***REMOVED*** @access public
***REMOVED*** @param string $headers_line Header lines
***REMOVED*** @param string $subject Subject
***REMOVED*** @param string $body Body
***REMOVED*** @return string
***REMOVED***/
    public function DKIM_Add($headers_line, $subject, $body)
    {
        $DKIMsignatureType = 'rsa-sha1'; // Signature & hash algorithms
        $DKIMcanonicalization = 'relaxed/simple'; // Canonicalization of header/body
        $DKIMquery = 'dns/txt'; // Query method
        $DKIMtime = time(); // Signature Timestamp = seconds since 00:00:00 - Jan 1, 1970 (UTC time zone)
        $subject_header = "Subject: $subject";
        $headers = explode($this->LE, $headers_line);
        $from_header = '';
        $to_header = '';
        $current = '';
        foreach ($headers as $header) {
            if (strpos($header, 'From:') === 0) {
                $from_header = $header;
                $current = 'from_header';
            } elseif (strpos($header, 'To:') === 0) {
                $to_header = $header;
                $current = 'to_header';
            } else {
                if ($current && strpos($header, ' =?') === 0) {
                    $current .= $header;
                } else {
                    $current = '';
                }
            }
        }
        $from = str_replace('|', '=7C', $this->DKIM_QP($from_header));
        $to = str_replace('|', '=7C', $this->DKIM_QP($to_header));
        $subject = str_replace(
            '|',
            '=7C',
            $this->DKIM_QP($subject_header)
        ); // Copied header fields (dkim-quoted-printable)
        $body = $this->DKIM_BodyC($body);
        $DKIMlen = strlen($body); // Length of body
        $DKIMb64 = base64_encode(pack('H*', sha1($body))); // Base64 of packed binary SHA-1 hash of body
        $ident = ($this->DKIM_identity == '') ? '' : ' i=' . $this->DKIM_identity . ';';
        $dkimhdrs = 'DKIM-Signature: v=1; a=' .
            $DKIMsignatureType . '; q=' .
            $DKIMquery . '; l=' .
            $DKIMlen . '; s=' .
            $this->DKIM_selector .
            ";\r\n" .
            "\tt=" . $DKIMtime . '; c=' . $DKIMcanonicalization . ";\r\n" .
            "\th=From:To:Subject;\r\n" .
            "\td=" . $this->DKIM_domain . ';' . $ident . "\r\n" .
            "\tz=$from\r\n" .
            "\t|$to\r\n" .
            "\t|$subject;\r\n" .
            "\tbh=" . $DKIMb64 . ";\r\n" .
            "\tb=";
        $toSign = $this->DKIM_HeaderC(
            $from_header . "\r\n" . $to_header . "\r\n" . $subject_header . "\r\n" . $dkimhdrs
        );
        $signed = $this->DKIM_Sign($toSign);
        return $dkimhdrs . $signed . "\r\n";
    }

***REMOVED***
***REMOVED*** Allows for public read access to 'to' property.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getToAddresses()
    {
        return $this->to;
    }

***REMOVED***
***REMOVED*** Allows for public read access to 'cc' property.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getCcAddresses()
    {
        return $this->cc;
    }

***REMOVED***
***REMOVED*** Allows for public read access to 'bcc' property.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getBccAddresses()
    {
        return $this->bcc;
    }

***REMOVED***
***REMOVED*** Allows for public read access to 'ReplyTo' property.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getReplyToAddresses()
    {
        return $this->ReplyTo;
    }

***REMOVED***
***REMOVED*** Allows for public read access to 'all_recipients' property.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getAllRecipientAddresses()
    {
        return $this->all_recipients;
    }

***REMOVED***
***REMOVED*** Perform a callback.
***REMOVED*** @param boolean $isSent
***REMOVED*** @param array $to
***REMOVED*** @param array $cc
***REMOVED*** @param array $bcc
***REMOVED*** @param string $subject
***REMOVED*** @param string $body
***REMOVED*** @param string $from
***REMOVED***/
    protected function doCallback($isSent, $to, $cc, $bcc, $subject, $body, $from)
    {
        if (!empty($this->action_function) && is_callable($this->action_function)) {
            $params = array($isSent, $to, $cc, $bcc, $subject, $body, $from);
            call_user_func_array($this->action_function, $params);
        }
    }
}

/**
 * PHPMailer exception handler
 * @package PHPMailer
 */
class phpmailerException extends Exception
{
***REMOVED***
***REMOVED*** Prettify error message output
***REMOVED*** @return string
***REMOVED***/
    public function errorMessage()
    {
        $errorMsg = '<strong>' . $this->getMessage() . "</strong><br />\n";
        return $errorMsg;
    }
}
