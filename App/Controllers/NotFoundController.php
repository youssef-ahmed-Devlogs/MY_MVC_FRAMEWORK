<?php

namespace App\Controllers;

use App\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __construct()
    {
        if (DEV_MODE) {
            view('errors.dev.controllerNotFound');
        }
    }
}
