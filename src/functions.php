<?php
/**
 * Yii2 I18N extension autoload functions.
 *
 * ```php
 * echo __('Username');
 * __('Username'); // with echo
 * echo _x('Username', 'category');
 * _xe('Username', 'category'); // with echo
 * ```
 */

use yiithings\i18n\I18N;

if ( ! function_exists('__')) {
    /**
     * Get a translated message without category.
     *
     * @param string $message
     * @param array  $params
     * @param string $language
     * @return string
     */
    function __($message, $params = [], $language = null)
    {
        return I18N::__($message, $params, $language);
    }
}

if ( ! function_exists('_e')) {
    /**
     * Print a translated message without category.
     *
     * @param string $message
     * @param array  $params
     * @param string $language
     */
    function _e($message, $params = [], $language = null)
    {
        I18N::__($message, $params, $language);
    }
}

if ( ! function_exists('_x')) {
    /**
     * Get a translated message with category.
     *
     * @param string $message
     * @param string $category
     * @param array  $params
     * @param string $language
     * @return string
     */
    function _x($message, $category, $params = [], $language = null)
    {
        return I18N::_x($message, $category, $params, $language);
    }
}

if ( ! function_exists('_xe')) {
    /**
     * Print a translated message with category.
     *
     * @param string $message
     * @param string $category
     * @param array  $params
     * @param string $language
     */
    function _xe($message, $category, $params = [], $language = null)
    {
        I18N::_xe($message, $category, $params, $language);
    }
}