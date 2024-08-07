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
        <div class="container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                    @if (session('error'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>Info!</h4>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header card-dark" >
                            <h3 class="card-title">Users</h3>
                            <div class="card-tools">
                            @if(auth()->user()->can('create-users'))
                                <a href="{{ url('/users/create') }}" >
                                    <button type="button" class="btn btn-secondary btn-sm" >
                                        <i class="fas fa-plus"></i>
                                        Add
                                        Data
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
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Action</th>
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
        </div>
    </div>
@endsection

@section('js')
    <script>
        var authUserCanEditUsers = @json(auth()->user()->can('edit-users'));
        var authUserCanDeleteUsers = @json(auth()->user()->can('delete-users'));
    </script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@push('js_in')
    <script src="{{ asset('assets/customjs/users/users.js') }}"></script>
@endpush
