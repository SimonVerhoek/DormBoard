***REMOVED***
/**
 * PHPMailer - language file tests
 * Requires PHPUnit 3.3 or later.
 *
 * PHP version 5.0.0
 *
 * @package PHPMailer
 * @author Andy Prevost
 * @author Marcus Bointon <phpmailer@synchromedia.co.uk>
 * @copyright 2004 - 2009 Andy Prevost
 * @copyright 2010 Marcus Bointon
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

require_once '../PHPMailerAutoload.php';

/**
 * PHPMailer - PHP email transport unit test class
 * Performs authentication tests
 */
class PHPMailerLangTest extends PHPUnit_Framework_TestCase
{
***REMOVED***
***REMOVED*** Holds a phpmailer instance.
***REMOVED*** @private
***REMOVED*** @var PHPMailer
***REMOVED***/
    public $Mail;

***REMOVED***
***REMOVED*** @var string Default include path
***REMOVED***/
    public $INCLUDE_DIR = '../';

***REMOVED***
***REMOVED*** Run before each test is started.
***REMOVED***/
    public function setUp()
    {
        $this->Mail = new PHPMailer;
    }

***REMOVED***
***REMOVED*** Test language files for missing and excess translations
***REMOVED*** All languages are compared with English
***REMOVED*** @group languages
***REMOVED***/
    public function testTranslations()
    {
        $this->Mail->setLanguage('en');
        $definedStrings = $this->Mail->getTranslations();
        $err = '';
        foreach (new DirectoryIterator('../language') as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            $matches = array();
            //Only look at language files, ignore anything else in there
            if (preg_match('/^phpmailer\.lang-([a-z_]{2,})\.php$/', $fileInfo->getFilename(), $matches)) {
                $lang = $matches[1]; //Extract language code
                $PHPMAILER_LANG = array(); //Language strings get put in here
                include $fileInfo->getPathname(); //Get language strings
                $missing = array_diff(array_keys($definedStrings), array_keys($PHPMAILER_LANG));
                $extra = array_diff(array_keys($PHPMAILER_LANG), array_keys($definedStrings));
                if (!empty($missing)) {
                    $err .= "\nMissing translations in $lang: " . implode(', ', $missing);
                }
                if (!empty($extra)) {
                    $err .= "\nExtra translations in $lang: " . implode(', ', $extra);
                }
            }
        }
        $this->assertEmpty($err, $err);
    }
}
