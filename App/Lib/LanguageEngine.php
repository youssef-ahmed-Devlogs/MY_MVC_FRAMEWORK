<?php

namespace App\Lib;

class LanguageEngine
{
    private $dictionary = [];

    public function load($path)
    {

        $defaultLanguage = isset($_SESSION['lang']) ? $_SESSION['lang'] :  APP_LANG;

        $lang_file = LANGUAGE_PATH . $defaultLanguage . DS . strtolower(str_replace(".", DS, $path)) . '.php';

        if (file_exists($lang_file)) {
            $lang_file = require_once $lang_file;

            foreach ($lang_file as $key => $value) {
                $this->dictionary[$key] = $value;
            }
        } else {
            if (DEV_MODE) {
                trigger_error("Language file [ $lang_file ] is not exists.", E_USER_WARNING);
                exit;
            }
        }
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }
}
