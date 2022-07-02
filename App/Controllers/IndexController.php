<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\Request;

class IndexController extends Controller
{
    public function index()
    {
        return $this->view('index.index', ['title' => 'Home']);
    }

    public function add()
    {
        return $this->view('index.add');
    }
}
