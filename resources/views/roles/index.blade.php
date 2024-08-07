@extends('layouts/app')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluit">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header card-dark" >
                            <h3 class="card-title">Roles</h3>
                            <div class="card-tools">
                                @if(auth()->user()->can('create-roles'))
                                    <a href="{{ url('/roles/create') }}">
                                        <button type="button" class="btn btn-secondary btn-sm" >
                                            <i class="fas fa-plus"></i> 
                                            Add Data
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Role</th>
                                            <th>Permission</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('js')
    <script>
        var authUserCanEditRoles = @json(auth()->user()->can('edit-roles'));
        var authUserCanDeleteRoles = @json(auth()->user()->can('delete-roles'));
    </script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@push('js_in')
    <script src="{{ asset('assets/customjs/roles/roles.js') }}"></script>
@endpush
