<?php

namespace MikrotikAPI\Util;


abstract class Validation
{
    protected static $_pattern = [
        'hostname' => '(?:[_\p{L}0-9][-_\p{L}0-9]*\.)*(?:[\p{L}0-9][-\p{L}0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})'
    ];


    /**
     * Validation of an IP address.
     *
     * @param string $check The string to test.
     * @param string $type The IP Protocol version to validate against
     * @return bool Success
     */
    public static function ip($check, $type = 'both')
    {
        $type = strtolower($type);
        $flags = 0;
        if ($type === 'ipv4') {
            $flags = FILTER_FLAG_IPV4;
        }
        if ($type === 'ipv6') {
            $flags = FILTER_FLAG_IPV6;
        }

        return (bool)filter_var($check, FILTER_VALIDATE_IP, ['flags' => $flags]);
    }

    /**
     * Checks if a value is numeric.
     *
     * @param string $check Value to check
     * @return bool Success
     */
    public static function numeric($check)
    {
        return is_numeric($check);
    }

    /**
     * Checks that a string contains something other than whitespace
     *
     * Returns true if string contains something other than whitespace
     *
     * $check can be passed as an array:
     * array('check' => 'valueToCheck');
     *
     * @param string|array $check Value to check
     * @return bool Success
     */
    public static function notBlank($check)
    {
        if (is_array($check)) {
            extract(static::_defaults($check));
        }
        if (empty($check) && (string)$check !== '0') {
            return false;
        }
        return static::_check($check, '/[^\s]+/m');
    }

    /**
     * Boolean validation, determines if value passed is a boolean integer or true/false.
     *
     * @param string $check a valid boolean
     * @return bool Success
     */
    public static function boolean($check)
    {
        $booleanList = [0, 1, '0', '1', true, false];
        return in_array($check, $booleanList, true);
    }

    /**
     * Runs a regular expression match.
     *
     * @param string $check Value to check against the $regex expression
     * @param string $regex Regular expression
     * @return bool Success of match
     */
    protected static function _check($check, $regex)
    {
        if (is_string($regex) && preg_match($regex, $check)) {
            return true;
        }
        return false;
    }

    /**
     * Get the values to use when value sent to validation method is
     * an array.
     *
     * @param array $params Parameters sent to validation method
     * @return void
     */
    protected static function _defaults($params)
    {
        $defaults = [
            'check'   => null,
            'regex'   => null,
            'country' => null,
            'deep'    => false,
            'type'    => null
        ];
        $params += $defaults;
        if ($params['country'] !== null) {
            $params['country'] = mb_strtolower($params['country']);
        }

        return $params;
    }

    /**
     * Lazily populate the IP address patterns used for validations
     *
     * @return void
     */
    protected static function _populateIp()
    {
        if (!isset(static::$_pattern['IPv6'])) {
            $pattern = '((([0-9A-Fa-f]{1,4}:){7}(([0-9A-Fa-f]{1,4})|:))|(([0-9A-Fa-f]{1,4}:){6}';
            $pattern .= '(:|((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})';
            $pattern .= '|(:[0-9A-Fa-f]{1,4})))|(([0-9A-Fa-f]{1,4}:){5}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})';
            $pattern .= '(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:)';
            $pattern .= '{4}(:[0-9A-Fa-f]{1,4}){0,1}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2}))';
            $pattern .= '{3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:){3}(:[0-9A-Fa-f]{1,4}){0,2}';
            $pattern .= '((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|';
            $pattern .= '((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:){2}(:[0-9A-Fa-f]{1,4}){0,3}';
            $pattern .= '((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2}))';
            $pattern .= '{3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:)(:[0-9A-Fa-f]{1,4})';
            $pattern .= '{0,4}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)';
            $pattern .= '|((:[0-9A-Fa-f]{1,4}){1,2})))|(:(:[0-9A-Fa-f]{1,4}){0,5}((:((25[0-5]|2[0-4]';
            $pattern .= '\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4})';
            $pattern .= '{1,2})))|(((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})))(%.+)?';
            static::$_pattern['IPv6'] = $pattern;
        }
        if (!isset(static::$_pattern['IPv4'])) {
            $pattern = '(?:(?:25[0-5]|2[0-4][0-9]|(?:(?:1[0-9])?|[1-9]?)[0-9])\.){3}(?:25[0-5]|2[0-4][0-9]|(?:(?:1[0-9])?|[1-9]?)[0-9])';
            static::$_pattern['IPv4'] = $pattern;
        }
    }

}