<?php namespace App\Helpers;

class Helpers
{
    /**
     * @param string $input
     * @return string
     */
    static function splitAndLowercase(string $input): string
    {
        // Разделение строки на слова по заглавным буквам
        $output = preg_replace('/([a-z])([A-Z])/', '$1 $2', $input);
        $output = preg_replace('/([A-Z])([A-Z][a-z])/', '$1 $2', $output);

        // Преобразование всех букв в строчные
        return strtolower($output);
    }

    static function replaceEnter(string $str): string
    {
        return str_replace("\n", "", $str);
    }
}
