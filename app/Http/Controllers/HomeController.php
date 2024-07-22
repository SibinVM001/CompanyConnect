<?php

namespace App\Http\Controllers;

use App\Models\{Company, Employee};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companiesCount = Company::count();
        $employeesCount = Employee::count();

        return view('dashboard', compact('companiesCount', 'employeesCount'));
    }
}
