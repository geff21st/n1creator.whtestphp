<?php

namespace App\Services;

class StringService
{
    /**
     * Convert underscore_strings to camelCase (medial capitals).
     *
     * @param string $string
     * @param false  $capitalizeFirstCharacter
     * @param string $dashCharacter
     *
     * @return array|string|string[]
     */
    public static function snakeToCamelCase(
        string $string,
        bool   $capitalizeFirstCharacter = false,
        string $dashCharacter = '_'
    ) {
        if (stripos($string, $dashCharacter) === false) {
            return $string;
        }

        $str = str_replace($dashCharacter, '', ucwords($string, $dashCharacter));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Convert camelCase to underscore_strings
     *
     * @param        $string
     * @param string $dashCharacter
     *
     * @return string
     */
    public static function camelCaseToSnake(
        $string,
        string $dashCharacter = '_'
    ): string {
        return strtolower(
            preg_replace(
                [
                    '/([a-z\d])([A-Z])/',
                    '/([^' . $dashCharacter . '])([A-Z][a-z])/',
                ],
                '$1' . $dashCharacter . '$2',
                $string
            )
        );
    }
}
