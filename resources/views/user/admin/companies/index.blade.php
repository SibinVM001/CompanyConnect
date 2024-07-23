@extends('layouts.app')

@section('title', '| Companies')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <div class="row d-flex justify-content-between mb-3">
                    <div class="col">
                        <h3>Company List</h3>
                    </div>
                    <div class="col d-flex justify-content-end gap-3">
                        <a href="{{ route('companies.create') }}">
                            <button class="btn btn-primary">Add New Company</button>
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
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
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
                ajax: "{{ route('companies.index') }}",
                columns: [
                    { data: 'id', nmae: 'id' },
                    { data: 'logo', name: 'logo' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { 
                        data: "website",
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