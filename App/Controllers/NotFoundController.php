<?php

namespace App\Controllers;

use App\Controllers\Controller;

class NotFoundController extends Controller
{
    public function __construct()
    {
        devError('This controller is not exist.', '/index/notFound');
    }
}
