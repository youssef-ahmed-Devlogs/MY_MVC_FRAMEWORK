<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\Helper;
use App\Lib\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    use Helper;

    public function index()
    {
        return $this->view('employee.index', [
            'id' => @$this->params[0],
            'name' => 'Youssef Ahmed',
            'age' => 21,
            'country' => 'Egypt'
        ]);
    }

    public function add()
    {
        return $this->view('employee.add');
    }

    public function insert()
    {
        $request = Request::post();

        if ($request) {
            $employee = new Employee;
            $employee->name = $request['name'];
            $employee->age = $request['age'];
            $employee->address = $request['address'];
            $employee->salary = $request['salary'];
            $employee->tax = $request['tax'];
            if ($employee->save()) {
                $this->redirect('/employee');
            }
        }
    }
}
