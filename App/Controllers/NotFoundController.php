<?php

namespace App\Controllers;

use App\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __construct()
    {
        if (DEV_MODE) {
            $this->view('errors.dev.controllerNotFound');
        }
    }
}
