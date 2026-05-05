<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {

        $employee = Employee::all();

        return response()->json(["data" => $employee], 200);
    }
}