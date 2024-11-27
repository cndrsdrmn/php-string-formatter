<?php

namespace Cndrsdrmn\PhpStringFormatter;

class StringFormatter
{
    /**
     * Replace both `#` with random digits and `?` with random lowercase letters.
     * Replaces `*` with either `#` or `?`.
     */
    public static function bothify(string $string): string
    {
        // Replace '*' with either '#' or '?'
        $string = static::replaceWildcard($string, '*', fn (): string => mt_rand(0, 1) === 1 ? '#' : '?');

        // Apply numerify and lexify to replace '#' with digits and '?' with letters
        return static::lexify(static::numerify($string));
    }

    /**
     * Replace `?` with random lowercase letters.
     */
    public static function lexify(string $string): string
    {
        return static::replaceWildcard($string, '?', fn (): string => chr(mt_rand(97, 122)));
    }

    /**
     * Replace `#` with random digits and `%` with random digits between 1 and 9.
     */
    public static function numerify(string $string): string
    {
        // Replace `#` with random digits
        $string = static::replaceWildcard($string, '#', fn (): int => mt_rand(0, 9));

        // Replace `%` with random digits between 1 and 9
        return static::replaceWildcard($string, '%', fn (): int => mt_rand(1, 9));
    }

    /**
     * Replace all occurrences of a given wildcard in the string with a value generated by the provided callback.
     */
    protected static function replaceWildcard(string $string, string $wildcard, callable $callback): string
    {
        $length = strlen($string);
        $result = '';

        // Iterate through the string and replace wildcards
        for ($i = 0; $i < $length; $i++) {
            $char = $string[$i];
            if ($char === $wildcard) {
                $result .= call_user_func($callback);
            } else {
                $result .= $char;
            }
        }

        return $result;
    }
}