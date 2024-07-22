@extends('layouts.app')

@section('title', '| Employees')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col">
                    <h3>Employee Details</h3>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{ route('employees.index') }}">
                        <button class="btn btn-outline-dark">Back</button>
                    </a>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body bg-white p-5">
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col">
                            @php
                                $logo = ((isset($employee->employer->logo) && file_exists(FileDestinations::COMPANY_LOGO . $employee->employer->logo)) ? 
                                        asset(FileDestinations::COMPANY_LOGO . $employee->employer->logo) : asset(FileDestinations::NO_IMAGE));
                            @endphp
                            
                            <div class="view-logo">
                                <img src="{{ $logo }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col text-end">
                            <h1>{{ $employee->employer->name }}</h1>
                            <p>{{ $employee->employer->email }}</p>
                            <p>{{ $employee->employer->website }}</p>
                        </div>
                    </div>

                    <h3 class="mb-3 text-center">{{ $employee->first_name . ' ' . $employee->last_name }}</h3>
                    <p class="mb-3 text-center">{{ $employee->email }}</p>
                    <p class="mb-3 text-center">{{ $employee->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection