<?php

namespace App\Controllers;

use App\Controllers\Controller;

class LanguageController extends Controller
{
    public function ar()
    {
        $_SESSION['lang'] = 'ar';

        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: /');
        }
        exit;
    }

    public function en()
    {
        $_SESSION['lang'] = 'en';

        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: /');
        }
        exit;
    }
}
