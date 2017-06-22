<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
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
                'fecha' => ['EL empleado tiene que tener mas de 18 años']
            ];
        }
    }

    public function delete($id)
    {

    }

    public function update(Request $request)
    {

    }
}
