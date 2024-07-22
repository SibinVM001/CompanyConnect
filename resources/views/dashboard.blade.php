@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body d-flex bg-white p-5 gap-3">
                <a class="col-md-6 text-center bg-primary p-5 text-white text-decoration-none" href="{{ route('companies.index') }}">
                    <h2>Companies</h2>

                    <h5 class="mt-3">Total Count: {{ $companiesCount }}</h5>
                </a>
                <a class="col-md-6 text-center bg-secondary p-5 text-white text-decoration-none" href="{{ route('employees.index') }}">
                    <h2>Employees</h2>

                    <h5 class="mt-3">Total Count: {{ $employeesCount }}</h5>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection