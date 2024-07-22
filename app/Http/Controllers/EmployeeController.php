<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::select(['id', 'first_name', 'last_name', 'email', 'phone', 'company'])->with('employer');

            return DataTables::of($employees)
                        ->addColumn('company', function($row) {
                            return $row->employer->name;
                        })
                        ->addColumn('action', function($row) {
                            $viewBtn = '<a href="' . route("employees.show", $row->id). '" class="show btn btn-secondary">View</a>';
                            $editBtn = '<a href="' . route("employees.edit", $row->id). '" class="edit btn btn-success mx-2">Edit</a>';
                            // $deleteBtn = ' <a href="' . route("employees.destroy", $row->id). '" class="delete btn btn-danger">Delete</a>';
                            $deleteBtn = '<form action="' . route("employees.destroy", $row->id) . '" method="POST">'
                                            . '<input type="hidden" name="_method" value="DELETE">'
                                            . '<input type="hidden" name="_token" value="' . csrf_token() .'">'
                                            . '<button type="submit" class="btn btn-danger">Delete</button>'
                                        . '</form>';

                            return '<div class="d-inline-flex">' .  $viewBtn . $editBtn . $deleteBtn . '</div>';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('user.admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('user.admin.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try {
            Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone ?? NULL,
            ]);

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Employee created successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('user.admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();

        return view('user.admin.employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone ?? NULL,
            ]);

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Employee details updated successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Employee deleted successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->route('employees.index');
    }
}
