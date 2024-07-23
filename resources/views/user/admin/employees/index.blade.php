@extends('layouts.app')

@section('title', '| Employees')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <div class="row d-flex justify-content-between mb-3">
                    <div class="col">
                        <h3>Employees List</h3>
                    </div>
                    <div class="col d-flex justify-content-end gap-3">
                        <a href="{{ route('employees.create') }}">
                            <button class="btn btn-primary">Add New Employee</button>
                        </a>
                        <a href="{{ route('dashboard') }}">
                            <button class="btn btn-outline-dark">Back</button>
                        </a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="companies-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>First Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            table = $('#companies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees.index') }}",
                columns: [
                    { data: 'id', nmae: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'company', name: 'company' },
                    { data: 'email', name: 'email' },
                    { 
                        data: "phone",
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                pageLength: 10,
                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).html(table.page.info().start + index + 1);
                }
            });
        });
    </script>
@endpush