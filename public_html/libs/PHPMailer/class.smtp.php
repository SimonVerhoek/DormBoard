***REMOVED***
/**
 * PHPMailer RFC821 SMTP email transport class.
 * PHP Version 5
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2014 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * PHPMailer RFC821 SMTP email transport class.
 * Implements RFC 821 SMTP commands and provides some utility methods for sending mail to an SMTP server.
 * @package PHPMailer
 * @author Chris Ryan <unknown@example.com>
 * @author Marcus Bointon <phpmailer@synchromedia.co.uk>
 */
class SMTP
{
***REMOVED***
***REMOVED*** The PHPMailer SMTP version number.
***REMOVED*** @type string
***REMOVED***/
    const VERSION = '5.2.8';

***REMOVED***
***REMOVED*** SMTP line break constant.
***REMOVED*** @type string
***REMOVED***/
    const CRLF = "\r\n";

***REMOVED***
***REMOVED*** The SMTP port to use if one is not specified.
***REMOVED*** @type integer
***REMOVED***/
    const DEFAULT_SMTP_PORT = 25;

***REMOVED***
***REMOVED*** The maximum line length allowed by RFC 2822 section 2.1.1
***REMOVED*** @type integer
***REMOVED***/
    const MAX_LINE_LENGTH = 998;

***REMOVED***
***REMOVED*** The PHPMailer SMTP Version number.
***REMOVED*** @type string
***REMOVED*** @deprecated Use the constant instead
***REMOVED*** @see SMTP::VERSION
***REMOVED***/
    public $Version = '5.2.8';

***REMOVED***
***REMOVED*** SMTP server port number.
***REMOVED*** @type integer
***REMOVED*** @deprecated This is only ever used as a default value, so use the constant instead
***REMOVED*** @see SMTP::DEFAULT_SMTP_PORT
***REMOVED***/
    public $SMTP_PORT = 25;

***REMOVED***
***REMOVED*** SMTP reply line ending.
***REMOVED*** @type string
***REMOVED*** @deprecated Use the constant instead
***REMOVED*** @see SMTP::CRLF
***REMOVED***/
    public $CRLF = "\r\n";

***REMOVED***
***REMOVED*** Debug output level.
***REMOVED*** Options:
***REMOVED*** * `0` No output
***REMOVED*** * `1` Commands
***REMOVED*** * `2` Data and commands
***REMOVED*** * `3` As 2 plus connection status
***REMOVED*** * `4` Low-level data output
***REMOVED*** @type integer
***REMOVED***/
    public $do_debug = 0;

***REMOVED***
***REMOVED*** How to handle debug output.
***REMOVED*** Options:
***REMOVED*** * `echo` Output plain-text as-is, appropriate for CLI
***REMOVED*** * `html` Output escaped, line breaks converted to <br>, appropriate for browser output
***REMOVED*** * `error_log` Output to error log as configured in php.ini
***REMOVED*** @type string
***REMOVED***/
    public $Debugoutput = 'echo';

***REMOVED***
***REMOVED*** Whether to use VERP.
***REMOVED*** @link http://en.wikipedia.org/wiki/Variable_envelope_return_path
***REMOVED*** @link http://www.postfix.org/VERP_README.html Info on VERP
***REMOVED*** @type boolean
***REMOVED***/
    public $do_verp = false;

***REMOVED***
***REMOVED*** The timeout value for connection, in seconds.
***REMOVED*** Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2
***REMOVED*** This needs to be quite high to function correctly with hosts using greetdelay as an anti-spam measure.
***REMOVED*** @link http://tools.ietf.org/html/rfc2821#section-4.5.3.2
***REMOVED*** @type integer
***REMOVED***/
    public $Timeout = 300;

***REMOVED***
***REMOVED*** The SMTP timelimit value for reads, in seconds.
***REMOVED*** @type integer
***REMOVED***/
    public $Timelimit = 30;

***REMOVED***
***REMOVED*** The socket for the server connection.
***REMOVED*** @type resource
***REMOVED***/
    protected $smtp_conn;

***REMOVED***
***REMOVED*** Error message, if any, for the last call.
***REMOVED*** @type array
***REMOVED***/
    protected $error = array();

***REMOVED***
***REMOVED*** The reply the server sent to us for HELO.
***REMOVED*** If null, no HELO string has yet been received.
***REMOVED*** @type string|null
***REMOVED***/
    protected $helo_rply = null;

***REMOVED***
***REMOVED*** The most recent reply received from the server.
***REMOVED*** @type string
***REMOVED***/
    protected $last_reply = '';

***REMOVED***
***REMOVED*** Output debugging info via a user-selected method.
***REMOVED*** @param string $str Debug string to output
***REMOVED*** @return void
***REMOVED***/
    protected function edebug($str)
    {
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n]+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . "<br>\n";
                break;
            case 'echo':
            default:
                echo gmdate('Y-m-d H:i:s')."\t".trim($str)."\n";
        }
    }

***REMOVED***
***REMOVED*** Connect to an SMTP server.
***REMOVED*** @param string $host SMTP server IP or host name
***REMOVED*** @param integer $port The port number to connect to
***REMOVED*** @param integer $timeout How long to wait for the connection to open
***REMOVED*** @param array $options An array of options for stream_context_create()
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function connect($host, $port = null, $timeout = 30, $options = array())
    {
        static $streamok;
        //This is enabled by default since 5.0.0 but some providers disable it
        //Check this once and cache the result
        if (is_null($streamok)) {
            $streamok = function_exists('stream_socket_client');
        }
        // Clear errors to avoid confusion
        $this->error = array();
        // Make sure we are __not__ connected
        if ($this->connected()) {
            // Already connected, generate error
            $this->error = array('error' => 'Already connected to a server');
            return false;
        }
        if (empty($port)) {
            $port = self::DEFAULT_SMTP_PORT;
        }
        // Connect to the SMTP server
        if ($this->do_debug >= 3) {
            $this->edebug("Connection: opening to $host:$port, t=$timeout, opt=".var_export($options, true));
        }
        $errno = 0;
        $errstr = '';
        if ($streamok) {
            $socket_context = stream_context_create($options);
            //Suppress errors; connection failures are handled at a higher level
            $this->smtp_conn = @stream_socket_client(
                $host . ":" . $port,
                $errno,
                $errstr,
                $timeout,
                STREAM_CLIENT_CONNECT,
                $socket_context
            );
        } else {
            //Fall back to fsockopen which should work in more places, but is missing some features
            if ($this->do_debug >= 3) {
                $this->edebug("Connection: stream_socket_client not available, falling back to fsockopen");
            }
            $this->smtp_conn = fsockopen(
                $host,
                $port,
                $errno,
                $errstr,
                $timeout
            );
        }
        // Verify we connected properly
        if (!is_resource($this->smtp_conn)) {
            $this->error = array(
                'error' => 'Failed to connect to server',
                'errno' => $errno,
                'errstr' => $errstr
            );
            if ($this->do_debug >= 1) {
                $this->edebug(
                    'SMTP ERROR: ' . $this->error['error']
                    . ": $errstr ($errno)"
                );
            }
            return false;
        }
        if ($this->do_debug >= 3) {
            $this->edebug('Connection: opened');
        }
        // SMTP server can take longer to respond, give longer timeout for first read
        // Windows does not have support for this timeout function
        if (substr(PHP_OS, 0, 3) != 'WIN') {
            $max = ini_get('max_execution_time');
            if ($max != 0 && $timeout > $max) { // Don't bother if unlimited
                @set_time_limit($timeout);
            }
            stream_set_timeout($this->smtp_conn, $timeout, 0);
        }
        // Get any announcement
        $announce = $this->get_lines();
        if ($this->do_debug >= 2) {
            $this->edebug('SERVER -> CLIENT: ' . $announce);
        }
        return true;
    }

***REMOVED***
***REMOVED*** Initiate a TLS (encrypted) session.
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function startTLS()
    {
        if (!$this->sendCommand('STARTTLS', 'STARTTLS', 220)) {
            return false;
        }
        // Begin encrypted connection
        if (!stream_socket_enable_crypto(
            $this->smtp_conn,
            true,
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        )) {
            return false;
        }
        return true;
    }

***REMOVED***
***REMOVED*** Perform SMTP authentication.
***REMOVED*** Must be run after hello().
***REMOVED*** @see hello()
***REMOVED*** @param string $username    The user name
***REMOVED*** @param string $password    The password
***REMOVED*** @param string $authtype    The auth type (PLAIN, LOGIN, NTLM, CRAM-MD5)
***REMOVED*** @param string $realm       The auth realm for NTLM
***REMOVED*** @param string $workstation The auth workstation for NTLM
***REMOVED*** @access public
***REMOVED*** @return boolean True if successfully authenticated.
***REMOVED***/
    public function authenticate(
        $username,
        $password,
        $authtype = 'LOGIN',
        $realm = '',
        $workstation = ''
    ) {
        if (empty($authtype)) {
            $authtype = 'LOGIN';
        }
        switch ($authtype) {
            case 'PLAIN':
                // Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH PLAIN', 334)) {
                    return false;
                }
                // Send encoded username and password
                if (!$this->sendCommand(
                    'User & Password',
                    base64_encode("\0" . $username . "\0" . $password),
                    235
                )
                ) {
                    return false;
                }
                break;
            case 'LOGIN':
                // Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH LOGIN', 334)) {
                    return false;
                }
                if (!$this->sendCommand("Username", base64_encode($username), 334)) {
                    return false;
                }
                if (!$this->sendCommand("Password", base64_encode($password), 235)) {
                    return false;
                }
                break;
            case 'NTLM':
                /*
       ***REMOVED*****REMOVED*** ntlm_sasl_client.php
       ***REMOVED*****REMOVED*** Bundled with Permission
       ***REMOVED*****REMOVED***
       ***REMOVED*****REMOVED*** How to telnet in windows:
       ***REMOVED*****REMOVED*** http://technet.microsoft.com/en-us/library/aa995718%28EXCHG.65%29.aspx
       ***REMOVED*****REMOVED*** PROTOCOL Docs http://curl.haxx.se/rfc/ntlm.html#ntlmSmtpAuthentication
       ***REMOVED*****REMOVED***/
                require_once 'extras/ntlm_sasl_client.php';
                $temp = new stdClass();
                $ntlm_client = new ntlm_sasl_client_class;
                //Check that functions are available
                if (!$ntlm_client->Initialize($temp)) {
                    $this->error = array('error' => $temp->error);
                    if ($this->do_debug >= 1) {
                        $this->edebug(
                            'You need to enable some modules in your php.ini file: '
                            . $this->error['error']
                        );
                    }
                    return false;
                }
                //msg1
                $msg1 = $ntlm_client->TypeMsg1($realm, $workstation); //msg1

                if (!$this->sendCommand(
                    'AUTH NTLM',
                    'AUTH NTLM ' . base64_encode($msg1),
                    334
                )
                ) {
                    return false;
                }
                //Though 0 based, there is a white space after the 3 digit number
                //msg2
                $challenge = substr($this->last_reply, 3);
                $challenge = base64_decode($challenge);
                $ntlm_res = $ntlm_client->NTLMResponse(
                    substr($challenge, 24, 8),
                    $password
                );
                //msg3
                $msg3 = $ntlm_client->TypeMsg3(
                    $ntlm_res,
                    $username,
                    $realm,
                    $workstation
                );
                // send encoded username
                return $this->sendCommand('Username', base64_encode($msg3), 235);
            case 'CRAM-MD5':
                // Start authentication
                if (!$this->sendCommand('AUTH CRAM-MD5', 'AUTH CRAM-MD5', 334)) {
                    return false;
                }
                // Get the challenge
                $challenge = base64_decode(substr($this->last_reply, 4));

                // Build the response
                $response = $username . ' ' . $this->hmac($challenge, $password);

                // send encoded credentials
                return $this->sendCommand('Username', base64_encode($response), 235);
        }
        return true;
    }

***REMOVED***
***REMOVED*** Calculate an MD5 HMAC hash.
***REMOVED*** Works like hash_hmac('md5', $data, $key)
***REMOVED*** in case that function is not available
***REMOVED*** @param string $data The data to hash
***REMOVED*** @param string $key  The key to hash with
***REMOVED*** @access protected
***REMOVED*** @return string
***REMOVED***/
    protected function hmac($data, $key)
    {
        if (function_exists('hash_hmac')) {
            return hash_hmac('md5', $data, $key);
        }

        // The following borrowed from
        // http://php.net/manual/en/function.mhash.php#27225

        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing

        $bytelen = 64; // byte length for md5
        if (strlen($key) > $bytelen) {
            $key = pack('H*', md5($key));
        }
        $key = str_pad($key, $bytelen, chr(0x00));
        $ipad = str_pad('', $bytelen, chr(0x36));
        $opad = str_pad('', $bytelen, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack('H*', md5($k_ipad . $data)));
    }

***REMOVED***
***REMOVED*** Check connection state.
***REMOVED*** @access public
***REMOVED*** @return boolean True if connected.
***REMOVED***/
    public function connected()
    {
        if (is_resource($this->smtp_conn)) {
            $sock_status = stream_get_meta_data($this->smtp_conn);
            if ($sock_status['eof']) {
                // the socket is valid but we are not connected
                if ($this->do_debug >= 1) {
                    $this->edebug(
                        'SMTP NOTICE: EOF caught while checking if connected'
                    );
                }
                $this->close();
                return false;
            }
            return true; // everything looks good
        }
        return false;
    }

***REMOVED***
***REMOVED*** Close the socket and clean up the state of the class.
***REMOVED*** Don't use this function without first trying to use QUIT.
***REMOVED*** @see quit()
***REMOVED*** @access public
***REMOVED*** @return void
***REMOVED***/
    public function close()
    {
        $this->error = array();
        $this->helo_rply = null;
        if (is_resource($this->smtp_conn)) {
            // close the connection and cleanup
            fclose($this->smtp_conn);
            if ($this->do_debug >= 3) {
                $this->edebug('Connection: closed');
            }
        }
    }

***REMOVED***
***REMOVED*** Send an SMTP DATA command.
***REMOVED*** Issues a data command and sends the msg_data to the server,
***REMOVED*** finializing the mail transaction. $msg_data is the message
***REMOVED*** that is to be send with the headers. Each header needs to be
***REMOVED*** on a single line followed by a <CRLF> with the message headers
***REMOVED*** and the message body being separated by and additional <CRLF>.
***REMOVED*** Implements rfc 821: DATA <CRLF>
***REMOVED*** @param string $msg_data Message data to send
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function data($msg_data)
    {
        if (!$this->sendCommand('DATA', 'DATA', 354)) {
            return false;
        }
        /* The server is ready to accept data!
    ***REMOVED*** According to rfc821 we should not send more than 1000 characters on a single line (including the CRLF)
    ***REMOVED*** so we will break the data up into lines by \r and/or \n then if needed we will break each of those into
    ***REMOVED*** smaller lines to fit within the limit.
    ***REMOVED*** We will also look for lines that start with a '.' and prepend an additional '.'.
    ***REMOVED*** NOTE: this does not count towards line-length limit.
    ***REMOVED***/

        // Normalize line breaks before exploding
        $lines = explode("\n", str_replace(array("\r\n", "\r"), "\n", $msg_data));

        /* To distinguish between a complete RFC822 message and a plain message body, we check if the first field
    ***REMOVED*** of the first line (':' separated) does not contain a space then it _should_ be a header and we will
    ***REMOVED*** process all lines before a blank line as headers.
    ***REMOVED***/

        $field = substr($lines[0], 0, strpos($lines[0], ':'));
        $in_headers = false;
        if (!empty($field) && strpos($field, ' ') === false) {
            $in_headers = true;
        }

        foreach ($lines as $line) {
            $lines_out = array();
            if ($in_headers and $line == '') {
                $in_headers = false;
            }
            // ok we need to break this line up into several smaller lines
            //This is a small micro-optimisation: isset($str[$len]) is equivalent to (strlen($str) > $len)
            while (isset($line[self::MAX_LINE_LENGTH])) {
                //Working backwards, try to find a space within the last MAX_LINE_LENGTH chars of the line to break on
                //so as to avoid breaking in the middle of a word
                $pos = strrpos(substr($line, 0, self::MAX_LINE_LENGTH), ' ');
                if (!$pos) { //Deliberately matches both false and 0
                    //No nice break found, add a hard break
                    $pos = self::MAX_LINE_LENGTH - 1;
                    $lines_out[] = substr($line, 0, $pos);
                    $line = substr($line, $pos);
                } else {
                    //Break at the found point
                    $lines_out[] = substr($line, 0, $pos);
                    //Move along by the amount we dealt with
                    $line = substr($line, $pos + 1);
                }
                /* If processing headers add a LWSP-char to the front of new line
       ***REMOVED*****REMOVED*** RFC822 section 3.1.1
       ***REMOVED*****REMOVED***/
                if ($in_headers) {
                    $line = "\t" . $line;
                }
            }
            $lines_out[] = $line;

            // Send the lines to the server
            foreach ($lines_out as $line_out) {
                //RFC2821 section 4.5.2
                if (!empty($line_out) and $line_out[0] == '.') {
                    $line_out = '.' . $line_out;
                }
                $this->client_send($line_out . self::CRLF);
            }
        }

        // Message data has been sent, complete the command
        return $this->sendCommand('DATA END', '.', 250);
    }

***REMOVED***
***REMOVED*** Send an SMTP HELO or EHLO command.
***REMOVED*** Used to identify the sending server to the receiving server.
***REMOVED*** This makes sure that client and server are in a known state.
***REMOVED*** Implements RFC 821: HELO <SP> <domain> <CRLF>
***REMOVED*** and RFC 2821 EHLO.
***REMOVED*** @param string $host The host name or IP to connect to
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function hello($host = '')
    {
        // Try extended hello first (RFC 2821)
        return (boolean)($this->sendHello('EHLO', $host) or $this->sendHello('HELO', $host));
    }

***REMOVED***
***REMOVED*** Send an SMTP HELO or EHLO command.
***REMOVED*** Low-level implementation used by hello()
***REMOVED*** @see hello()
***REMOVED*** @param string $hello The HELO string
***REMOVED*** @param string $host The hostname to say we are
***REMOVED*** @access protected
***REMOVED*** @return boolean
***REMOVED***/
    protected function sendHello($hello, $host)
    {
        $noerror = $this->sendCommand($hello, $hello . ' ' . $host, 250);
        $this->helo_rply = $this->last_reply;
        return $noerror;
    }

***REMOVED***
***REMOVED*** Send an SMTP MAIL command.
***REMOVED*** Starts a mail transaction from the email address specified in
***REMOVED*** $from. Returns true if successful or false otherwise. If True
***REMOVED*** the mail transaction is started and then one or more recipient
***REMOVED*** commands may be called followed by a data command.
***REMOVED*** Implements rfc 821: MAIL <SP> FROM:<reverse-path> <CRLF>
***REMOVED*** @param string $from Source address of this message
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function mail($from)
    {
        $useVerp = ($this->do_verp ? ' XVERP' : '');
        return $this->sendCommand(
            'MAIL FROM',
            'MAIL FROM:<' . $from . '>' . $useVerp,
            250
        );
    }

***REMOVED***
***REMOVED*** Send an SMTP QUIT command.
***REMOVED*** Closes the socket if there is no error or the $close_on_error argument is true.
***REMOVED*** Implements from rfc 821: QUIT <CRLF>
***REMOVED*** @param boolean $close_on_error Should the connection close if an error occurs?
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function quit($close_on_error = true)
    {
        $noerror = $this->sendCommand('QUIT', 'QUIT', 221);
        $err = $this->error; //Save any error
        if ($noerror or $close_on_error) {
            $this->close();
            $this->error = $err; //Restore any error from the quit command
        }
        return $noerror;
    }

***REMOVED***
***REMOVED*** Send an SMTP RCPT command.
***REMOVED*** Sets the TO argument to $toaddr.
***REMOVED*** Returns true if the recipient was accepted false if it was rejected.
***REMOVED*** Implements from rfc 821: RCPT <SP> TO:<forward-path> <CRLF>
***REMOVED*** @param string $toaddr The address the message is being sent to
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function recipient($toaddr)
    {
        return $this->sendCommand(
            'RCPT TO',
            'RCPT TO:<' . $toaddr . '>',
            array(250, 251)
        );
    }

***REMOVED***
***REMOVED*** Send an SMTP RSET command.
***REMOVED*** Abort any transaction that is currently in progress.
***REMOVED*** Implements rfc 821: RSET <CRLF>
***REMOVED*** @access public
***REMOVED*** @return boolean True on success.
***REMOVED***/
    public function reset()
    {
        return $this->sendCommand('RSET', 'RSET', 250);
    }

***REMOVED***
***REMOVED*** Send a command to an SMTP server and check its return code.
***REMOVED*** @param string $command       The command name - not sent to the server
***REMOVED*** @param string $commandstring The actual command to send
***REMOVED*** @param integer|array $expect     One or more expected integer success codes
***REMOVED*** @access protected
***REMOVED*** @return boolean True on success.
***REMOVED***/
    protected function sendCommand($command, $commandstring, $expect)
    {
        if (!$this->connected()) {
            $this->error = array(
                'error' => "Called $command without being connected"
            );
            return false;
        }
        $this->client_send($commandstring . self::CRLF);

        $reply = $this->get_lines();
        $code = substr($reply, 0, 3);

        if ($this->do_debug >= 2) {
            $this->edebug('SERVER -> CLIENT: ' . $reply);
        }

        if (!in_array($code, (array)$expect)) {
            $this->last_reply = null;
            $this->error = array(
                'error' => "$command command failed",
                'smtp_code' => $code,
                'detail' => substr($reply, 4)
            );
            if ($this->do_debug >= 1) {
                $this->edebug(
                    'SMTP ERROR: ' . $this->error['error'] . ': ' . $reply
                );
            }
            return false;
        }

        $this->last_reply = $reply;
        $this->error = array();
        return true;
    }

***REMOVED***
***REMOVED*** Send an SMTP SAML command.
***REMOVED*** Starts a mail transaction from the email address specified in $from.
***REMOVED*** Returns true if successful or false otherwise. If True
***REMOVED*** the mail transaction is started and then one or more recipient
***REMOVED*** commands may be called followed by a data command. This command
***REMOVED*** will send the message to the users terminal if they are logged
***REMOVED*** in and send them an email.
***REMOVED*** Implements rfc 821: SAML <SP> FROM:<reverse-path> <CRLF>
***REMOVED*** @param string $from The address the message is from
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function sendAndMail($from)
    {
        return $this->sendCommand('SAML', "SAML FROM:$from", 250);
    }

***REMOVED***
***REMOVED*** Send an SMTP VRFY command.
***REMOVED*** @param string $name The name to verify
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function verify($name)
    {
        return $this->sendCommand('VRFY', "VRFY $name", array(250, 251));
    }

***REMOVED***
***REMOVED*** Send an SMTP NOOP command.
***REMOVED*** Used to keep keep-alives alive, doesn't actually do anything
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function noop()
    {
        return $this->sendCommand('NOOP', 'NOOP', 250);
    }

***REMOVED***
***REMOVED*** Send an SMTP TURN command.
***REMOVED*** This is an optional command for SMTP that this class does not support.
***REMOVED*** This method is here to make the RFC821 Definition complete for this class
***REMOVED*** and _may_ be implemented in future
***REMOVED*** Implements from rfc 821: TURN <CRLF>
***REMOVED*** @access public
***REMOVED*** @return boolean
***REMOVED***/
    public function turn()
    {
        $this->error = array(
            'error' => 'The SMTP TURN command is not implemented'
        );
        if ($this->do_debug >= 1) {
            $this->edebug('SMTP NOTICE: ' . $this->error['error']);
        }
        return false;
    }

***REMOVED***
***REMOVED*** Send raw data to the server.
***REMOVED*** @param string $data The data to send
***REMOVED*** @access public
***REMOVED*** @return integer|boolean The number of bytes sent to the server or false on error
***REMOVED***/
    public function client_send($data)
    {
        if ($this->do_debug >= 1) {
            $this->edebug("CLIENT -> SERVER: $data");
        }
        return fwrite($this->smtp_conn, $data);
    }

***REMOVED***
***REMOVED*** Get the latest error.
***REMOVED*** @access public
***REMOVED*** @return array
***REMOVED***/
    public function getError()
    {
        return $this->error;
    }

***REMOVED***
***REMOVED*** Get the last reply from the server.
***REMOVED*** @access public
***REMOVED*** @return string
***REMOVED***/
    public function getLastReply()
    {
        return $this->last_reply;
    }

***REMOVED***
***REMOVED*** Read the SMTP server's response.
***REMOVED*** Either before eof or socket timeout occurs on the operation.
***REMOVED*** With SMTP we can tell if we have more lines to read if the
***REMOVED*** 4th character is '-' symbol. If it is a space then we don't
***REMOVED*** need to read anything else.
***REMOVED*** @access protected
***REMOVED*** @return string
***REMOVED***/
    protected function get_lines()
    {
        // If the connection is bad, give up straight away
        if (!is_resource($this->smtp_conn)) {
            return '';
        }
        $data = '';
        $endtime = 0;
        stream_set_timeout($this->smtp_conn, $this->Timeout);
        if ($this->Timelimit > 0) {
            $endtime = time() + $this->Timelimit;
        }
        while (is_resource($this->smtp_conn) && !feof($this->smtp_conn)) {
            $str = @fgets($this->smtp_conn, 515);
            if ($this->do_debug >= 4) {
                $this->edebug("SMTP -> get_lines(): \$data was \"$data\"");
                $this->edebug("SMTP -> get_lines(): \$str is \"$str\"");
            }
            $data .= $str;
            if ($this->do_debug >= 4) {
                $this->edebug("SMTP -> get_lines(): \$data is \"$data\"");
            }
            // If 4th character is a space, we are done reading, break the loop, micro-optimisation over strlen
            if ((isset($str[3]) and $str[3] == ' ')) {
                break;
            }
            // Timed-out? Log and break
            $info = stream_get_meta_data($this->smtp_conn);
            if ($info['timed_out']) {
                if ($this->do_debug >= 4) {
                    $this->edebug(
                        'SMTP -> get_lines(): timed-out (' . $this->Timeout . ' sec)'
                    );
                }
                break;
            }
            // Now check if reads took too long
            if ($endtime and time() > $endtime) {
                if ($this->do_debug >= 4) {
                    $this->edebug(
                        'SMTP -> get_lines(): timelimit reached ('.
                        $this->Timelimit . ' sec)'
                    );
                }
                break;
            }
        }
        return $data;
    }

***REMOVED***
***REMOVED*** Enable or disable VERP address generation.
***REMOVED*** @param boolean $enabled
***REMOVED***/
    public function setVerp($enabled = false)
    {
        $this->do_verp = $enabled;
    }

***REMOVED***
***REMOVED*** Get VERP address generation mode.
***REMOVED*** @return boolean
***REMOVED***/
    public function getVerp()
    {
        return $this->do_verp;
    }

***REMOVED***
***REMOVED*** Set debug output method.
***REMOVED*** @param string $method The function/method to use for debugging output.
***REMOVED***/
    public function setDebugOutput($method = 'echo')
    {
        $this->Debugoutput = $method;
    }

***REMOVED***
***REMOVED*** Get debug output method.
***REMOVED*** @return string
***REMOVED***/
    public function getDebugOutput()
    {
        return $this->Debugoutput;
    }

***REMOVED***
***REMOVED*** Set debug output level.
***REMOVED*** @param integer $level
***REMOVED***/
    public function setDebugLevel($level = 0)
    {
        $this->do_debug = $level;
    }

***REMOVED***
***REMOVED*** Get debug output level.
***REMOVED*** @return integer
***REMOVED***/
    public function getDebugLevel()
    {
        return $this->do_debug;
    }

***REMOVED***
***REMOVED*** Set SMTP timeout.
***REMOVED*** @param integer $timeout
***REMOVED***/
    public function setTimeout($timeout = 0)
    {
        $this->Timeout = $timeout;
    }

***REMOVED***
***REMOVED*** Get SMTP timeout.
***REMOVED*** @return integer
***REMOVED***/
    public function getTimeout()
    {
        return $this->Timeout;
    }
}
