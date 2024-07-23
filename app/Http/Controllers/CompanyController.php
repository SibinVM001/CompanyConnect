<?php

namespace App\Http\Controllers;

use App\Http\Constants\FileDestinations;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companies = Company::select(['id', 'logo', 'name', 'email', 'website'])->paginate(10);

            $data = collect($companies->items());

            return DataTables::of($data)
                        ->addColumn('action', function($row) {
                            $viewBtn = '<a href="' . route("companies.show", $row->id). '" class="show btn btn-secondary">View</a>';
                            $editBtn = '<a href="' . route("companies.edit", $row->id). '" class="edit btn btn-success mx-2">Edit</a>';
                            $deleteBtn = '<form action="' . route("companies.destroy", $row->id) . '" method="POST">'
                                            . '<input type="hidden" name="_method" value="DELETE">'
                                            . '<input type="hidden" name="_token" value="' . csrf_token() .'">'
                                            . '<button type="submit" class="btn btn-danger">Delete</button>'
                                        . '</form>';
            

                            return '<div class="d-inline-flex">' . $viewBtn . $editBtn . $deleteBtn . '</div>';
                        })
                        ->addColumn('logo', function($row) {
                            $logo = ((isset($row->logo) && file_exists(FileDestinations::COMPANY_LOGO . $row->logo)) ? 
                                    asset(FileDestinations::COMPANY_LOGO . $row->logo) : asset(FileDestinations::NO_IMAGE));
                            $img = '<div class="view-logo"><img src="' . $logo . '" alt="" srcset="" width="100"></div>';

                            return $img;
                        })
                        ->with([
                            'recordsTotal' => $companies->total(),
                            'recordsFiltered' => $companies->total()
                        ])
                        ->rawColumns(['action', 'logo'])
                        ->make(true);
        }

        return view('user.admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        try {
            $company = Company::create([
                            'name' => $request->name,
                            'email' => $request->email,
                            'website' => $request->website ?? NULL,
                        ]);

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $filename = time() . '_' . Str::random(10) . '_' . $logo->getClientOriginalName();
                $logo->move(FileDestinations::COMPANY_LOGO, $filename, 'public');

                $company->logo = $filename;
                $company->save();
            }

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Company created successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('user.admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('user.admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website ?? NULL,
            ]);

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $filename = time() . '_' . Str::random(10) . '_' . $logo->getClientOriginalName();
                $logo->move(FileDestinations::COMPANY_LOGO, $filename, 'public');

                if (isset($company->logo) && file_exists(FileDestinations::COMPANY_LOGO . $company->logo)) {
                    unlink(FileDestinations::COMPANY_LOGO . $company->logo);
                }

                $company->logo = $filename;
                $company->save();
            }

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Company details has been updated successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            if (isset($company->logo) && file_exists(FileDestinations::COMPANY_LOGO . $company->logo)) {
                unlink(FileDestinations::COMPANY_LOGO . $company->logo);
            }

            $company->delete();

            Session::flash('alert-type', 'success');
            Session::flash('alert-message', 'Company deleted successfully.');
        } catch (Exception $ex) {
            Session::flash('alert-type', 'danger');
            Session::flash('alert-message', 'Something went wrong!');
        }

        return redirect()->route('companies.index');
    }
}
