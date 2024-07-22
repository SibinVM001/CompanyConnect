@extends('layouts.app')

@section('title', '| Employees')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col">
                    <h3>Edit Employee Details</h3>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{ route('employees.index') }}">
                        <button class="btn btn-outline-dark">Back</button>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body bg-white p-5">
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $employee->first_name ?? old('first_name') }}">

                            @error('first_name')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"  value="{{ $employee->last_name ?? old('last_name') }}">

                            @error('last_name')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <select class="form-select" aria-label="Default select example" id="company" name="company" value="{{ old('company') }}">
                                <option>Select a Company</option>

                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ (isset($employee->company)) ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>

                            @error('company')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email ?? old('email') }}">

                            @error('email')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone ?? old('phone') }}">

                            @error('phone')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection