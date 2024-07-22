@extends('layouts.app')

@section('title', '| Companies')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col">
                    <h3>Company Details</h3>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{ route('dashboard') }}">
                        <button class="btn btn-outline-dark">Back</button>
                    </a>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body bg-white p-5">
                    <div class="mb-4">
                        @php
                            $logo = ((isset($company->logo) && file_exists(FileDestinations::COMPANY_LOGO . $company->logo)) ? 
                                    asset(FileDestinations::COMPANY_LOGO . $company->logo) : asset(FileDestinations::NO_IMAGE));
                        @endphp

                        <div class="view-logo mb-3 mx-auto">
                            <img src="{{ $logo }}" alt="" srcset="">
                        </div>

                        <h3 class="mb-3 text-center">{{ $company->name }}</h3>
                        <p class="mb-3 text-center">{{ $company->email }}</p>
                    </div>

                    <hr>

                    <div class="container mt-4">
                        <div class="col-12">
                            <h5>Employees</h5>

                            @if (count($company->employees) > 0)
                                <div class="mt-3">
                                    @foreach ($company->employees as $employee)
                                        <div class="row">
                                            <div class="col-md-1">
                                                {{ $loop->index + 1 . ') ' }}
                                            </div>
                                            <div class="col-md-3"> 
                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ $employee->email }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $employee->phone }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-3">
                                    <p class="text-center">No employees found!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection