<?php

/**
 * @package   	JCE
 * @copyright 	Copyright (c) 2009-2013 Ryan Demmer. All rights reserved.
 * @license   	GNU/GPL 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('_JEXEC') or die('RESTRICTED');

abstract class WFUtility {

    public static function getExtension($path) {
        $dot = strrpos($path, '.') + 1;
        return substr($path, $dot);
    }

    public static function stripExtension($path) {
        $dot = strrpos($path, '.');
        return substr($path, 0, $dot);
    }

    public static function cleanPath($path, $ds = DIRECTORY_SEPARATOR, $prefix = '') {
        $path = trim(urldecode($path));
        
        // check for UNC path on IIS and set prefix
        if ($ds == '\\' && $path[0] == '\\' && $path[1] == '\\') {
            $prefix = "\\";
        }
        // clean path, removing double slashes, replacing back/forward slashes with DIRECTORY_SEPARATOR
        $path = preg_replace('#[/\\\\]+#', $ds, $path);
        
        // return path with prefix if any
        return $prefix . $path;
    }

    /**
     * Append a DIRECTORY_SEPARATOR to the path if required.
     * @param string $path the path
     * @param string $ds optional directory seperator
     * @return string path with trailing DIRECTORY_SEPARATOR
     */
    public static function fixPath($path, $ds = DIRECTORY_SEPARATOR) {
        return self::cleanPath($path . $ds);
    }

    private static function checkCharValue($string) {
        if (preg_match('#([^\w\.\-~\/\\\\\s ])#i', $string, $matches)) {            
            foreach ($matches as $match) {
                // not a safe UTF-8 character
                if (ord($match) < 127) {
                    return false;
                }
            }
        }

        return true;
    }

    public static function checkPath($path) {
        $path = urldecode($path);

        if (self::checkCharValue($path) === false || strpos($path, '..') !== false) {
            JError::raiseError(403, 'INVALID PATH'); // don't translate
            exit();
        }
    }

    /**
     * Concat two paths together. Basically $a + $b
     * @param string $a path one
     * @param string $b path two
     * @param string $ds optional directory seperator
     * @return string $a DIRECTORY_SEPARATOR $b
     */
    public static function makePath($a, $b, $ds = DIRECTORY_SEPARATOR) {
        return self::cleanPath($a . $ds . $b, $ds);
    }

    private static function utf8_latin_to_ascii($subject) {

        static $CHARS = NULL;

        if (is_null($CHARS)) {
            $CHARS = array(
                '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'AE',
                '??' => 'C', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I',
                '??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
                '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 's',
                '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'ae',
                '??' => 'c', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i',
                '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
                '??' => 'y', '??' => 'y', '??' => 'A', '??' => 'a', '??' => 'A', '??' => 'a', '??' => 'A', '??' => 'a',
                '??' => 'C', '??' => 'c', '??' => 'C', '??' => 'c', '??' => 'C', '??' => 'c', '??' => 'C', '??' => 'c', '??' => 'D', '??' => 'd', '??' => 'D', '??' => 'd',
                '??' => 'E', '??' => 'e', '??' => 'E', '??' => 'e', '??' => 'E', '??' => 'e', '??' => 'E', '??' => 'e', '??' => 'E', '??' => 'e',
                '??' => 'G', '??' => 'g', '??' => 'G', '??' => 'g', '??' => 'G', '??' => 'g', '??' => 'G', '??' => 'g', '??' => 'H', '??' => 'h', '??' => 'H', '??' => 'h',
                '??' => 'I', '??' => 'i', '??' => 'I', '??' => 'i', '??' => 'I', '??' => 'i', '??' => 'I', '??' => 'i', '??' => 'I', '??' => 'i',
                '??' => 'IJ', '??' => 'ij', '??' => 'J', '??' => 'j', '??' => 'K', '??' => 'k', '??' => 'L', '??' => 'l', '??' => 'L', '??' => 'l', '??' => 'L', '??' => 'l', '??' => 'L', '??' => 'l', '??' => 'l', '??' => 'l',
                '??' => 'N', '??' => 'n', '??' => 'N', '??' => 'n', '??' => 'N', '??' => 'n', '??' => 'n', '??' => 'O', '??' => 'o', '??' => 'O', '??' => 'o', '??' => 'O', '??' => 'o', '??' => 'OE', '??' => 'oe',
                '??' => 'R', '??' => 'r', '??' => 'R', '??' => 'r', '??' => 'R', '??' => 'r', '??' => 'S', '??' => 's', '??' => 'S', '??' => 's', '??' => 'S', '??' => 's', '??' => 'S', '??' => 's',
                '??' => 'T', '??' => 't', '??' => 'T', '??' => 't', '??' => 'T', '??' => 't', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u',
                '??' => 'W', '??' => 'w', '??' => 'Y', '??' => 'y', '??' => 'Y', '??' => 'Z', '??' => 'z', '??' => 'Z', '??' => 'z', '??' => 'Z', '??' => 'z', '??' => 's', '??' => 'f', '??' => 'O', '??' => 'o', '??' => 'U', '??' => 'u',
                '??' => 'A', '??' => 'a', '??' => 'I', '??' => 'i', '??' => 'O', '??' => 'o', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u', '??' => 'U', '??' => 'u',
                '??' => 'A', '??' => 'a', '??' => 'AE', '??' => 'ae', '??' => 'O', '??' => 'o'
            );
        }

        return str_replace(array_keys($CHARS), array_values($CHARS), $subject);
    }

    /**
     * Makes file name safe to use
     * @param mixed The name of the file (not full path)
     * @return mixed The sanitised string or array
     */
    public static function makeSafe($subject, $mode = 'utf-8', $allowspaces = false) {
        $search = array();

        // replace spaces with underscore
        if (!$allowspaces) {
            $subject = preg_replace('#[\s ]#', '_', $subject);
        }

        switch ($mode) {
            default:
            case 'utf-8':                
                $search[] = '#[^a-zA-Z0-9_\.\-~\p{L}\p{N}\s ]#u';
                $mode = 'utf-8';
                break;
            case 'ascii':
                $subject = self::utf8_latin_to_ascii($subject);                
                $search[] = '#[^a-zA-Z0-9_\.\-~\s ]#';
                break;
        }
        
        // remove multiple . characters
        $search[] = '#(\.){2,}#';

        // strip leading period
        $search[] = '#^\.#';
        
        // strip trailing period
        $search[] = '#\.$#';

        // strip whitespace
        $search[] = '#^\s*|\s*$#';

        // only for utf-8 to avoid PCRE errors - PCRE must be at least version 5
        if ($mode == 'utf-8') {
            try {                
                $result = preg_replace($search, '', $subject);                
            } catch (Exception $e) {
                // try ascii
                return self::makeSafe($subject, 'ascii');
            }
            
            // try ascii
            if (is_null($result) || $result === false) {                
                return self::makeSafe($subject, 'ascii');
            }

            return $result;
        }

        return preg_replace($search, '', $subject);
    }

    /**
     * Format the file size, limits to Mb.
     * @param int $size the raw filesize
     * @return string formated file size.
     */
    public static function formatSize($size) {
        if ($size < 1024) {
            return $size . ' ' . WFText::_('WF_LABEL_BYTES');
        } else if ($size >= 1024 && $size < 1024 * 1024) {
            return sprintf('%01.2f', $size / 1024.0) . ' ' . WFText::_('WF_LABEL_KB');
        } else {
            return sprintf('%01.2f', $size / (1024.0 * 1024)) . ' ' . WFText::_('WF_LABEL_MB');
        }
    }

    /**
     * Format the date.
     * @param int $date the unix datestamp
     * @return string formated date.
     */
    public static function formatDate($date, $format = "%d/%m/%Y, %H:%M") {
        return strftime($format, $date);
    }

    /**
     * Get the modified date of a file
     *
     * @return Formatted modified date
     * @param string $file Absolute path to file
     */
    public static function getDate($file) {
        return self::formatDate(@filemtime($file));
    }

    /**
     * Get the size of a file
     *
     * @return Formatted filesize value
     * @param string $file Absolute path to file
     */
    public static function getSize($file) {
        return self::formatSize(@filesize($file));
    }

    public static function isUtf8($string) {
        if (!function_exists('mb_detect_encoding')) {
            // From http://w3.org/International/questions/qa-forms-utf-8.html 
            return preg_match('%^(?: 
	              [\x09\x0A\x0D\x20-\x7E]          	 # ASCII 
	            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte 
	            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs 
	            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte 
	            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates 
	            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3 
	            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15 
	            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16 
	        )*$%xs', $string);
        }

        return mb_detect_encoding($string, 'UTF-8', true);
    }

    /**
     * Convert size value to bytes
     */
    public static function convertSize($value) {
        // Convert to bytes
        switch (strtolower($value{strlen($value) - 1})) {
            case 'g':
                $value = intval($value) * 1073741824;
                break;
            case 'm':
                $value = intval($value) * 1048576;
                break;
            case 'k':
                $value = intval($value) * 1024;
                break;
        }

        return $value;
    }

}

?>