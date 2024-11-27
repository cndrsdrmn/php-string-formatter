<?php

namespace Cndrsdrmn\PhpStringFormatter;

class StringFormatter
{
    /**
     * The callback that should be used to generate bothify strings.
     *
     * @var callable|null
     */
    protected static $bothifyFactory;

    /**
     * The callback that should be used to generate lexify strings.
     *
     * @var callable|null
     */
    protected static $lexifyFactory;

    /**
     * The callback that should be used to generate numerify strings.
     *
     * @var callable|null
     */
    protected static $numerifyFactory;

    /**
     * Replace both `#` with random digits and `?` with random lowercase letters.
     * Replaces `*` with either `#` or `?`.
     */
    public static function bothify(string $string): string
    {
        return (static::$bothifyFactory ?? function ($string): string {
            // Replace '*' with either '#' or '?'
            $string = static::replaceWildcard($string, '*', fn (): string => mt_rand(0, 1) === 1 ? '#' : '?');

            // Apply numerify and lexify to replace '#' with digits and '?' with letters
            return static::lexify(static::numerify($string));
        })($string);
    }

    /**
     * Set the callback that will be used to generate bothify strings.
     */
    public static function createBothifyUsing(callable $callable): void
    {
        static::$bothifyFactory = $callable;
    }

    /**
     * Indicate that bothify strings should be created normally and not using a custom factory.
     */
    public static function createBothifyNormally(): void
    {
        static::$bothifyFactory = null;
    }

    /**
     * Set the callback that will be used to generate lexify strings.
     */
    public static function createLexifyUsing(callable $callable): void
    {
        static::$lexifyFactory = $callable;
    }

    /**
     * Indicate that lexify strings should be created normally and not using a custom factory.
     */
    public static function createLexifyNormally(): void
    {
        static::$lexifyFactory = null;
    }

    /**
     * Set the callback that will be used to generate numerify strings.
     */
    public static function createNumerifyUsing(callable $callable): void
    {
        static::$numerifyFactory = $callable;
    }

    /**
     * Indicate that numerify strings should be created normally and not using a custom factory.
     */
    public static function createNumerifyNormally(): void
    {
        static::$numerifyFactory = null;
    }

    /**
     * Replace `?` with random lowercase letters.
     */
    public static function lexify(string $string): string
    {
        return (static::$lexifyFactory ?? fn (string $string): string => static::replaceWildcard($string, '?', fn (): string => chr(mt_rand(97, 122))))($string);
    }

    /**
     * Replace `#` with random digits and `%` with random digits between 1 and 9.
     */
    public static function numerify(string $string): string
    {
        return (static::$numerifyFactory ?? function (string $string): string {
            // Replace `#` with random digits
            $string = static::replaceWildcard($string, '#', fn (): int => mt_rand(0, 9));

            // Replace `%` with random digits between 1 and 9
            return static::replaceWildcard($string, '%', fn (): int => mt_rand(1, 9));
        })($string);
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
