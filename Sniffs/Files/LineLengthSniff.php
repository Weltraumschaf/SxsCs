<?php
/**
 * Generic_Sniffs_Files_LineLengthSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: LineLengthSniff.php 261688 2008-06-27 01:58:38Z squiz $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Generic_Sniffs_Files_LineLengthSniff.
 *
 * Checks all lines in the file, and throws warnings if they are over 80
 * characters in length and errors if they are over 100. Both these
 * figures can be changed by extending this sniff in your own standard.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.2.1
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Sxs_Sniffs_Files_LineLengthSniff extends Generic_Sniffs_Files_LineLengthSniff
{

    /**
     * The limit that the length of a line should not exceed.
     *
     * @var int
     */
    protected $lineLimit = 100;

    /**
     * The limit that the length of a line must not exceed.
     *
     * Set to zero (0) to disable.
     *
     * @var int
     */
    protected $absoluteLineLimit = 120;

    /**
     * Checks if a line is too long.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int $stackPtr The token at the end of the line.
     * @param string $lineContent The content of the line.
     * @return void
     */
    protected function checkLineLength(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $lineContent)
    {
        // Ugly hack to exclude class/interface and
        // function/method declarations.
        $process = true;
        $tokens = @token_get_all('<?php ' . $lineContent);

        if (count($tokens) > 2) {
            foreach ($tokens as $token) {
                if (is_array($token)) {
                    if ($token[0] == T_CLASS ||
                        $token[0] == T_FUNCTION ||
                        $token[0] == T_INTERFACE) {
                        $process = false;
                    }
                }
            }
        }

        // If the content is a CVS or SVN id in a version tag, or it is
        // a license tag with a name and URL, there is nothing the
        // developer can do to shorten the line, so don't throw errors.
        if ($process &&
            preg_match('|@version[^\$]+\$Id|', $lineContent) === 0 &&
            preg_match('|@license|', $lineContent) === 0) {
            $lineLength = strlen($lineContent);

            if ($this->absoluteLineLimit > 0 && $lineLength > $this->absoluteLineLimit) {
                $error  = 'Line exceeds maximum limit of '.$this->absoluteLineLimit;
                $error .= " characters; contains $lineLength characters";
                $phpcsFile->addError($error, $stackPtr);
            }

            else if ($lineLength > $this->lineLimit) {
                $warning  = 'Line exceeds '.$this->lineLimit;
                $warning .= " characters; contains $lineLength characters";
                $phpcsFile->addWarning($warning, $stackPtr);
            }
        }
    }
}//end class