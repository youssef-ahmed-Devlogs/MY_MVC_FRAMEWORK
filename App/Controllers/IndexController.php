<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index.index');
    }

    public function add()
    {
        return view('index.add');
    }
}
