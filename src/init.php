<?php

namespace utf8;

// Check whether PCRE has been compiled with UTF-8 support
$UTF8_ar = array();
if (preg_match('/^.{1}$/u', "ñ", $UTF8_ar) !== 1) {
    trigger_error('PCRE is not compiled with UTF-8 support', E_USER_ERROR);
}

unset($UTF8_ar);

// Constant: PHP_UTF_8_DIR
// Holds the current directory.
if (!defined('PHP_UTF_8_DIR')) {
    define('PHP_UTF_8_DIR', dirname(__FILE__));
}

// Constant: PHP_UTF_8_MODE
// Will be 'native' or 'mbstring'.
if (!defined('PHP_UTF_8_MODE')) {
    if (extension_loaded('mbstring')) {
        define('PHP_UTF_8_MODE', 'mbstring');
    } else {
        define('PHP_UTF_8_MODE', 'native');
    }
}

// Load core functions
if (PHP_UTF_8_MODE == 'mbstring') {
    // If string overloading is active, it will break many of the native implementations
    if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING) {
        trigger_error('String functions are overloaded by mbstring, must be ' . 'set to 0, 1 or 4 in php.ini for php-utf-8 to work.',
            E_USER_ERROR);
    }

    // Also need to check we have the correct internal mbstring encoding.
    // The Mbstring functions assume mbstring internal encoding is set to UTF-8.
    mb_language('uni');
    mb_internal_encoding('UTF-8');

    require_once PHP_UTF_8_DIR . '/core/mbstring.php';
} elseif (PHP_UTF_8_MODE == 'native') {
    require_once PHP_UTF_8_DIR . '/core/native.php';
}

// Load the native implementation of utf8_trim
require_once PHP_UTF_8_DIR . '/functions/trim.php';

