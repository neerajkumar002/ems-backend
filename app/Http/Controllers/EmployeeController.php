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


    public function store(Request $request)
    {
        $employee = Employee::create([
            "name" => $request->name,
            "email" => $request->email,
            "position" => $request->position,
            "salary" => $request->salary
        ]);

        return response()->json(["data" => $employee], 201);
    }



    public function update(Request $request, $id)
    {
        //find employee
        $employee = Employee::findOrFail($id);

        //update record
        $employee->update([
            "name" => $request->name,
            "email" => $request->email,
            "position" => $request->position,
            "salary" => $request->salary

        ]);

        return response()->json(["message" => "Employee updated successfully", "data" => $employee], 200);
    }

    //get employee by id

    public function show($id)
    {
        $employee = Employee::find($id);

        return response()->json(["data" => $employee], 200);
    }

    //delete employee by id

    public function destroy($id)
    {


        //find record
        $employee = Employee::findOrFail($id);

        //delete record
        $employee->delete();

        return response()->json(["message" => "employee successfuly deleted"], 200);
    }
}
