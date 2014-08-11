***REMOVED***
/*************************************************************************
 *                                                             ***REMOVED*****REMOVED***
 * Converts HTML to formatted plain text                       ***REMOVED*****REMOVED***
 *                                                             ***REMOVED*****REMOVED***
 * Portions Copyright (c) 2005-2007 Jon Abernathy <jon@chuggnutt.com>    *
 *                                                             ***REMOVED*****REMOVED***
 * This script is free software; you can redistribute it and/or modify   *
 * it under the terms of the GNU General Public License as published by  *
 * the Free Software Foundation; either version 2 of the License, or***REMOVED***
 * (at your option) any later version.                         ***REMOVED*****REMOVED***
 *                                                             ***REMOVED*****REMOVED***
 * The GNU General Public License can be found at              ***REMOVED*****REMOVED***
 * http://www.gnu.org/copyleft/gpl.html.                       ***REMOVED*****REMOVED***
 *                                                             ***REMOVED*****REMOVED***
 * This script is distributed in the hope that it will be useful,   ***REMOVED***
 * but WITHOUT ANY WARRANTY; without even the implied warranty of   ***REMOVED***
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the***REMOVED*****REMOVED***
 * GNU General Public License for more details.                ***REMOVED*****REMOVED***
 *                                                             ***REMOVED*****REMOVED***
 *************************************************************************/

/**
 * Converts HTML to formatted plain text
 */
class Html2Text
{
***REMOVED***
***REMOVED*** Contains the HTML content to convert.
***REMOVED***
***REMOVED*** @type string
***REMOVED***/
    protected $html;

***REMOVED***
***REMOVED*** Contains the converted, formatted text.
***REMOVED***
***REMOVED*** @type string
***REMOVED***/
    protected $text;

***REMOVED***
***REMOVED*** Maximum width of the formatted text, in columns.
***REMOVED***
***REMOVED*** Set this value to 0 (or less) to ignore word wrapping
***REMOVED*** and not constrain text to a fixed-width column.
***REMOVED***
***REMOVED*** @type integer
***REMOVED***/
    protected $width = 70;

***REMOVED***
***REMOVED*** List of preg* regular expression patterns to search for,
***REMOVED*** used in conjunction with $replace.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $replace
***REMOVED***/
    protected $search = array(
        "/\r/",                                  // Non-legal carriage return
        "/[\n\t]+/",                             // Newlines and tabs
        '/<head[^>]*>.*?<\/head>/i',             // <head>
        '/<script[^>]*>.*?<\/script>/i',         // <script>s -- which strip_tags supposedly has problems with
        '/<style[^>]*>.*?<\/style>/i',           // <style>s -- which strip_tags supposedly has problems with
        '/<p[^>]*>/i',                           // <P>
        '/<br[^>]*>/i',                          // <br>
        '/<i[^>]*>(.*?)<\/i>/i',                 // <i>
        '/<em[^>]*>(.*?)<\/em>/i',               // <em>
        '/(<ul[^>]*>|<\/ul>)/i',                 // <ul> and </ul>
        '/(<ol[^>]*>|<\/ol>)/i',                 // <ol> and </ol>
        '/(<dl[^>]*>|<\/dl>)/i',                 // <dl> and </dl>
        '/<li[^>]*>(.*?)<\/li>/i',               // <li> and </li>
        '/<dd[^>]*>(.*?)<\/dd>/i',               // <dd> and </dd>
        '/<dt[^>]*>(.*?)<\/dt>/i',               // <dt> and </dt>
        '/<li[^>]*>/i',                          // <li>
        '/<hr[^>]*>/i',                          // <hr>
        '/<div[^>]*>/i',                         // <div>
        '/(<table[^>]*>|<\/table>)/i',           // <table> and </table>
        '/(<tr[^>]*>|<\/tr>)/i',                 // <tr> and </tr>
        '/<td[^>]*>(.*?)<\/td>/i',               // <td> and </td>
        '/<span class="_html2text_ignore">.+?<\/span>/i'  // <span class="_html2text_ignore">...</span>
    );

***REMOVED***
***REMOVED*** List of pattern replacements corresponding to patterns searched.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $search
***REMOVED***/
    protected $replace = array(
        '',                                     // Non-legal carriage return
        ' ',                                    // Newlines and tabs
        '',                                     // <head>
        '',                                     // <script>s -- which strip_tags supposedly has problems with
        '',                                     // <style>s -- which strip_tags supposedly has problems with
        "\n\n",                                 // <P>
        "\n",                                   // <br>
        '_\\1_',                                // <i>
        '_\\1_',                                // <em>
        "\n\n",                                 // <ul> and </ul>
        "\n\n",                                 // <ol> and </ol>
        "\n\n",                                 // <dl> and </dl>
        "\t* \\1\n",                            // <li> and </li>
        " \\1\n",                               // <dd> and </dd>
        "\t* \\1",                              // <dt> and </dt>
        "\n\t* ",                               // <li>
        "\n-------------------------\n",        // <hr>
        "<div>\n",                              // <div>
        "\n\n",                                 // <table> and </table>
        "\n",                                   // <tr> and </tr>
        "\t\t\\1\n",                            // <td> and </td>
        ""                                      // <span class="_html2text_ignore">...</span>
    );

***REMOVED***
***REMOVED*** List of preg* regular expression patterns to search for,
***REMOVED*** used in conjunction with $ent_replace.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $ent_replace
***REMOVED***/
    protected $ent_search = array(
        '/&(nbsp|#160);/i',                      // Non-breaking space
        '/&(quot|rdquo|ldquo|#8220|#8221|#147|#148);/i',
        // Double quotes
        '/&(apos|rsquo|lsquo|#8216|#8217);/i',   // Single quotes
        '/&gt;/i',                               // Greater-than
        '/&lt;/i',                               // Less-than
        '/&(copy|#169);/i',                      // Copyright
        '/&(trade|#8482|#153);/i',               // Trademark
        '/&(reg|#174);/i',                       // Registered
        '/&(mdash|#151|#8212);/i',               // mdash
        '/&(ndash|minus|#8211|#8722);/i',        // ndash
        '/&(bull|#149|#8226);/i',                // Bullet
        '/&(pound|#163);/i',                     // Pound sign
        '/&(euro|#8364);/i',                     // Euro sign
        '/&(amp|#38);/i',                        // Ampersand: see _converter()
        '/[ ]{2,}/',                             // Runs of spaces, post-handling
    );

***REMOVED***
***REMOVED*** List of pattern replacements corresponding to patterns searched.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $ent_search
***REMOVED***/
    protected $ent_replace = array(
        ' ',                                    // Non-breaking space
        '"',                                    // Double quotes
        "'",                                    // Single quotes
        '>',
        '<',
        '(c)',
        '(tm)',
        '(R)',
        '--',
        '-',
        '*',
        '£',
        'EUR',                                  // Euro sign. € ?
        '|+|amp|+|',                            // Ampersand: see _converter()
        ' ',                                    // Runs of spaces, post-handling
    );

***REMOVED***
***REMOVED*** List of preg* regular expression patterns to search for
***REMOVED*** and replace using callback function.
***REMOVED***
***REMOVED*** @type array
***REMOVED***/
    protected $callback_search = array(
        '/<(a) [^>]*href=("|\')([^"\']+)\2([^>]*)>(.*?)<\/a>/i', // <a href="">
        '/<(h)[123456]( [^>]*)***REMOVED***(.*?)<\/h[123456]>/i',           // h1 - h6
        '/<(b)( [^>]*)***REMOVED***(.*?)<\/b>/i',                           // <b>
        '/<(strong)( [^>]*)***REMOVED***(.*?)<\/strong>/i',                 // <strong>
        '/<(th)( [^>]*)***REMOVED***(.*?)<\/th>/i',                         // <th> and </th>
    );

***REMOVED***
***REMOVED*** List of preg* regular expression patterns to search for in PRE body,
***REMOVED*** used in conjunction with $pre_replace.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $pre_replace
***REMOVED***/
    protected $pre_search = array(
        "/\n/",
        "/\t/",
        '/ /',
        '/<pre[^>]*>/',
        '/<\/pre>/'
    );

***REMOVED***
***REMOVED*** List of pattern replacements corresponding to patterns searched for PRE body.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see $pre_search
***REMOVED***/
    protected $pre_replace = array(
        '<br>',
        '&nbsp;&nbsp;&nbsp;&nbsp;',
        '&nbsp;',
        '',
        ''
    );

***REMOVED***
***REMOVED*** Temporary workspace used during PRE processing.
***REMOVED***
***REMOVED*** @type string
***REMOVED***/
    protected $pre_content = '';

***REMOVED***
***REMOVED*** Contains a list of HTML tags to allow in the resulting text.
***REMOVED***
***REMOVED*** @type string
***REMOVED*** @see set_allowed_tags()
***REMOVED***/
    protected $allowed_tags = '';

***REMOVED***
***REMOVED*** Contains the base URL that relative links should resolve to.
***REMOVED***
***REMOVED*** @type string
***REMOVED***/
    protected $url;

***REMOVED***
***REMOVED*** Indicates whether content in the $html variable has been converted yet.
***REMOVED***
***REMOVED*** @type boolean
***REMOVED*** @see $html, $text
***REMOVED***/
    protected $_converted = false;

***REMOVED***
***REMOVED*** Contains URL addresses from links to be rendered in plain text.
***REMOVED***
***REMOVED*** @type array
***REMOVED*** @see _build_link_list()
***REMOVED***/
    protected $_link_list = array();

***REMOVED***
***REMOVED*** Various configuration options (able to be set in the constructor)
***REMOVED***
***REMOVED*** @type array
***REMOVED***/
    protected $_options = array(
        // 'none'
        // 'inline' (show links inline)
        // 'nextline' (show links on the next line)
        // 'table' (if a table of link URLs should be listed after the text.
        'do_links' => 'inline',
        //  Maximum width of the formatted text, in columns.
        //  Set this value to 0 (or less) to ignore word wrapping
        //  and not constrain text to a fixed-width column.
        'width' => 70,
    );

***REMOVED***
***REMOVED*** Constructor.
***REMOVED***
***REMOVED*** If the HTML source string (or file) is supplied, the class
***REMOVED*** will instantiate with that source propagated, all that has
***REMOVED*** to be done it to call get_text().
***REMOVED***
***REMOVED*** @param string $source HTML content
***REMOVED*** @param boolean $from_file Indicates $source is a file to pull content from
***REMOVED*** @param array $options Set configuration options
***REMOVED***/
    public function __construct($source = '', $from_file = false, $options = array())
    {
        $this->_options = array_merge($this->_options, $options);

        if (!empty($source)) {
            $this->set_html($source, $from_file);
        }

        $this->set_base_url();
    }

***REMOVED***
***REMOVED*** Loads source HTML into memory, either from $source string or a file.
***REMOVED***
***REMOVED*** @param string $source HTML content
***REMOVED*** @param boolean $from_file Indicates $source is a file to pull content from
***REMOVED***/
    public function set_html($source, $from_file = false)
    {
        if ($from_file && file_exists($source)) {
            $this->html = file_get_contents($source);
        } else {
            $this->html = $source;
        }

        $this->_converted = false;
    }

***REMOVED***
***REMOVED*** Returns the text, converted from HTML.
***REMOVED***
***REMOVED*** @return string
***REMOVED***/
    public function get_text()
    {
        if (!$this->_converted) {
            $this->_convert();
        }

        return $this->text;
    }

***REMOVED***
***REMOVED*** Prints the text, converted from HTML.
***REMOVED***/
    public function print_text()
    {
        print $this->get_text();
    }

***REMOVED***
***REMOVED*** Alias to print_text(), operates identically.
***REMOVED***
***REMOVED*** @see print_text()
***REMOVED***/
    public function p()
    {
        print $this->get_text();
    }

***REMOVED***
***REMOVED*** Sets the allowed HTML tags to pass through to the resulting text.
***REMOVED***
***REMOVED*** Tags should be in the form "<p>", with no corresponding closing tag.
***REMOVED*** @param string $allowed_tags
***REMOVED***/
    public function set_allowed_tags($allowed_tags = '')
    {
        if (!empty($allowed_tags)) {
            $this->allowed_tags = $allowed_tags;
        }
    }

***REMOVED***
***REMOVED*** Sets a base URL to handle relative links.
***REMOVED***
***REMOVED*** @param string $url
***REMOVED***/
    public function set_base_url($url = '')
    {
        if (empty($url)) {
            if (!empty($_SERVER['HTTP_HOST'])) {
                $this->url = 'http://' . $_SERVER['HTTP_HOST'];
            } else {
                $this->url = '';
            }
        } else {
            // Strip any trailing slashes for consistency (relative
            // URLs may already start with a slash like "/file.html")
            if (substr($url, -1) == '/') {
                $url = substr($url, 0, -1);
            }
            $this->url = $url;
        }
    }

***REMOVED***
***REMOVED*** Workhorse function that does actual conversion (calls _converter() method).
***REMOVED***/
    protected function _convert()
    {
        // Variables used for building the link list
        $this->_link_list = array();

        $text = trim(stripslashes($this->html));

        // Convert HTML to TXT
        $this->_converter($text);

        // Add link list
        if (!empty($this->_link_list)) {
            $text .= "\n\nLinks:\n------\n";
            foreach ($this->_link_list as $idx => $url) {
                $text .= '[' . ($idx + 1) . '] ' . $url . "\n";
            }
        }

        $this->text = $text;

        $this->_converted = true;
    }

***REMOVED***
***REMOVED*** Workhorse function that does actual conversion.
***REMOVED***
***REMOVED*** First performs custom tag replacement specified by $search and
***REMOVED*** $replace arrays. Then strips any remaining HTML tags, reduces whitespace
***REMOVED*** and newlines to a readable format, and word wraps the text to
***REMOVED*** $this->_options['width'] characters.
***REMOVED***
***REMOVED*** @param string $text Reference to HTML content string
***REMOVED***/
    protected function _converter(&$text)
    {
        // Convert <BLOCKQUOTE> (before PRE!)
        $this->_convert_blockquotes($text);

        // Convert <PRE>
        $this->_convert_pre($text);

        // Run our defined tags search-and-replace
        $text = preg_replace($this->search, $this->replace, $text);

        // Run our defined tags search-and-replace with callback
        $text = preg_replace_callback($this->callback_search, array($this, '_preg_callback'), $text);

        // Strip any other HTML tags
        $text = strip_tags($text, $this->allowed_tags);

        // Run our defined entities/characters search-and-replace
        $text = preg_replace($this->ent_search, $this->ent_replace, $text);

        // Replace known html entities
        $text = html_entity_decode($text, ENT_QUOTES);

        // Remove unknown/unhandled entities (this cannot be done in search-and-replace block)
        $text = preg_replace('/&([a-zA-Z0-9]{2,6}|#[0-9]{2,4});/', '', $text);

        // Convert "|+|amp|+|" into "&", need to be done after handling of unknown entities
        // This properly handles situation of "&amp;quot;" in input string
        $text = str_replace('|+|amp|+|', '&', $text);

        // Bring down number of empty lines to 2 max
        $text = preg_replace("/\n\s+\n/", "\n\n", $text);
        $text = preg_replace("/[\n]{3,}/", "\n\n", $text);

        // remove leading empty lines (can be produced by eg. P tag on the beginning)
        $text = ltrim($text, "\n");

        // Wrap the text to a readable format
        // for PHP versions >= 4.0.2. Default width is 75
        // If width is 0 or less, don't wrap the text.
        if ($this->_options['width'] > 0) {
            $text = wordwrap($text, $this->_options['width']);
        }
    }

***REMOVED***
***REMOVED*** Helper function called by preg_replace() on link replacement.
***REMOVED***
***REMOVED*** Maintains an internal list of links to be displayed at the end of the
***REMOVED*** text, with numeric indices to the original point in the text they
***REMOVED*** appeared. Also makes an effort at identifying and handling absolute
***REMOVED*** and relative links.
***REMOVED***
***REMOVED*** @param string $link URL of the link
***REMOVED*** @param string $display Part of the text to associate number with
***REMOVED*** @param null $link_override
***REMOVED*** @return string
***REMOVED***/
    protected function _build_link_list($link, $display, $link_override = null)
    {
        $link_method = ($link_override) ? $link_override : $this->_options['do_links'];
        if ($link_method == 'none') {
            return $display;
        }


        // Ignored link types
        if (preg_match('!^(javascript:|mailto:|#)!i', $link)) {
            return $display;
        }

        if (preg_match('!^([a-z][a-z0-9.+-]+:)!i', $link)) {
            $url = $link;
        } else {
            $url = $this->url;
            if (substr($link, 0, 1) != '/') {
                $url .= '/';
            }
            $url .= "$link";
        }

        if ($link_method == 'table') {
            if (($index = array_search($url, $this->_link_list)) === false) {
                $index = count($this->_link_list);
                $this->_link_list[] = $url;
            }

            return $display . ' [' . ($index + 1) . ']';
        } elseif ($link_method == 'nextline') {
            return $display . "\n[" . $url . ']';
        } else { // link_method defaults to inline

            return $display . ' [' . $url . ']';
        }
    }

***REMOVED***
***REMOVED*** Helper function for PRE body conversion.
***REMOVED***
***REMOVED*** @param string $text HTML content
***REMOVED***/
    protected function _convert_pre(&$text)
    {
        // get the content of PRE element
        while (preg_match('/<pre[^>]*>(.*)<\/pre>/ismU', $text, $matches)) {
            $this->pre_content = $matches[1];

            // Run our defined tags search-and-replace with callback
            $this->pre_content = preg_replace_callback(
                $this->callback_search,
                array($this, '_preg_callback'),
                $this->pre_content
            );

            // convert the content
            $this->pre_content = sprintf(
                '<div><br>%s<br></div>',
                preg_replace($this->pre_search, $this->pre_replace, $this->pre_content)
            );

            // replace the content (use callback because content can contain $0 variable)
            $text = preg_replace_callback(
                '/<pre[^>]*>.*<\/pre>/ismU',
                array($this, '_preg_pre_callback'),
                $text,
                1
            );

            // free memory
            $this->pre_content = '';
        }
    }

***REMOVED***
***REMOVED*** Helper function for BLOCKQUOTE body conversion.
***REMOVED***
***REMOVED*** @param string $text HTML content
***REMOVED***/
    protected function _convert_blockquotes(&$text)
    {
        if (preg_match_all('/<\/*blockquote[^>]*>/i', $text, $matches, PREG_OFFSET_CAPTURE)) {
            $start = 0;
            $taglen = 0;
            $level = 0;
            $diff = 0;
            foreach ($matches[0] as $m) {
                if ($m[0][0] == '<' && $m[0][1] == '/') {
                    $level--;
                    if ($level < 0) {
                        $level = 0; // malformed HTML: go to next blockquote
                    } elseif ($level > 0) {
                        // skip inner blockquote
                    } else {
                        $end = $m[1];
                        $len = $end - $taglen - $start;
                        // Get blockquote content
                        $body = substr($text, $start + $taglen - $diff, $len);

                        // Set text width
                        $p_width = $this->_options['width'];
                        if ($this->_options['width'] > 0) $this->_options['width'] -= 2;
                        // Convert blockquote content
                        $body = trim($body);
                        $this->_converter($body);
                        // Add citation markers and create PRE block
                        $body = preg_replace('/((^|\n)>*)/', '\\1> ', trim($body));
                        $body = '<pre>' . htmlspecialchars($body) . '</pre>';
                        // Re-set text width
                        $this->_options['width'] = $p_width;
                        // Replace content
                        $text = substr($text, 0, $start - $diff)
                            . $body . substr($text, $end + strlen($m[0]) - $diff);

                        $diff = $len + $taglen + strlen($m[0]) - strlen($body);
                        unset($body);
                    }
                } else {
                    if ($level == 0) {
                        $start = $m[1];
                        $taglen = strlen($m[0]);
                    }
                    $level++;
                }
            }
        }
    }

***REMOVED***
***REMOVED*** Callback function for preg_replace_callback use.
***REMOVED***
***REMOVED*** @param array $matches PREG matches
***REMOVED*** @return string
***REMOVED***/
    protected function _preg_callback($matches)
    {
        switch (strtolower($matches[1])) {
            case 'b':
            case 'strong':
                return $this->_toupper($matches[3]);
            case 'th':
                return $this->_toupper("\t\t" . $matches[3] . "\n");
            case 'h':
                return $this->_toupper("\n\n" . $matches[3] . "\n\n");
            case 'a':
                // override the link method
                $link_override = null;
                if (preg_match('/_html2text_link_(\w+)/', $matches[4], $link_override_match)) {
                    $link_override = $link_override_match[1];
                }
                // Remove spaces in URL (#1487805)
                $url = str_replace(' ', '', $matches[3]);

                return $this->_build_link_list($url, $matches[5], $link_override);
        }
        return '';
    }

***REMOVED***
***REMOVED*** Callback function for preg_replace_callback use in PRE content handler.
***REMOVED***
***REMOVED*** @param array $matches PREG matches
***REMOVED*** @return string
***REMOVED***/
    protected function _preg_pre_callback(
    ***REMOVED*** @noinspection PhpUnusedParameterInspection */
        $matches)
    {
        return $this->pre_content;
    }

***REMOVED***
***REMOVED*** Strtoupper function with HTML tags and entities handling.
***REMOVED***
***REMOVED*** @param string $str Text to convert
***REMOVED*** @return string Converted text
***REMOVED***/
    private function _toupper($str)
    {
        // string can contain HTML tags
        $chunks = preg_split('/(<[^>]*>)/', $str, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        // convert toupper only the text between HTML tags
        foreach ($chunks as $idx => $chunk) {
            if ($chunk[0] != '<') {
                $chunks[$idx] = $this->_strtoupper($chunk);
            }
        }

        return implode($chunks);
    }

***REMOVED***
***REMOVED*** Strtoupper multibyte wrapper function with HTML entities handling.
***REMOVED*** Forces mb_strtoupper-call to UTF-8.
***REMOVED***
***REMOVED*** @param string $str Text to convert
***REMOVED*** @return string Converted text
***REMOVED***/
    private function _strtoupper($str)
    {
        $str = html_entity_decode($str, ENT_COMPAT);

        if (function_exists('mb_strtoupper'))
            $str = mb_strtoupper($str, 'UTF-8');
        else
            $str = strtoupper($str);

        $str = htmlspecialchars($str, ENT_COMPAT);

        return $str;
    }
}
