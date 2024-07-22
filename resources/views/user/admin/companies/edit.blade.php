@extends('layouts.app')

@section('title', '| Companies')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bg-white p-5">
                    <h3 class="mb-3">Edit Company</h3>
                    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{ $company->name ?? old('name') }}">

                            @error('name')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email ?? old('email') }}">

                            @error('email')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" value="{{ $company->logo ?? old('logo') }}">

                            @if (isset($company->logo) && file_exists(FileDestinations::COMPANY_LOGO . $company->logo))
                                <div class="view-logo mt-3">
                                    <img src="{{ asset(FileDestinations::COMPANY_LOGO . $company->logo) }}" alt="" srcset="">
                                </div>
                            @endif

                            @error('logo')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ $company->website ?? old('website') }}">

                            @error('website')
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