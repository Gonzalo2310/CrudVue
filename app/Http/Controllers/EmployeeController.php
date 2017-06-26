<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function create(StoreEmployee $request)
    {
        $today = Carbon::now();
        $unknow = Carbon::createFromFormat('d-m-Y', $request->birthday);
        if ($unknow->diffInYears($today) < 18) {
            return [
                'date' => ['El empleado tiene que tener mas de 18 años']
            ];
        } else {
            $employee=new Employee();
            $employee->name=$request->name;
            $employee->lastname=$request->lastname;
            $employee->birthday=$unknow;
            $employee->email=$request->email;
            $employee->position_id=$request->position;
            $employee->save();
        }
    }

    public function delete($id)
    {
        Employee::find($id)->delete();
    }

    public function update(UpdateEmployee $request)
    {
        $today = Carbon::now();
        $unknow = Carbon::createFromFormat('d-m-Y', $request->birthday);
        if ($unknow->diffInYears($today) < 18) {
            return [
                'date' => ['El empleado tiene que tener mas de 18 años']
            ];
        } else {
            $employee=Employee::find($request->id);
            $employee->name=$request->name;
            $employee->lastname=$request->lastname;
            $employee->birthday=$unknow;
            $employee->email=$request->email;
            $employee->position_id=$request->position;
            $employee->save();
        }
    }
}
