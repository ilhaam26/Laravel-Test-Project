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
                            <h3 class="card-title">Permission</h3>
                            <div class="card-tools">
                            @if (auth()->user()->can('create-permission'))
                             	<button type="button" class="btn btn-secondary " data-toggle="modal"
                                    data-target="#modal-default">
                                    <i class="fas fa-plus"></i>
                                    Add
                                    Data
                                </button>
                            @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Permission Name</th>
                                            <th>Permission Grub</th>
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
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data Permission</h4>
                </div>
                <form action="{{ url('/permission') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission</label>
                            <input type="text" class="form-control" name="permission" required>
                        </div>
                        <div class="form-group">
                            <label>Permission Grub</label>
                            <input type="text" class="form-control" name="permission_grub">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Permission</h4>
                </div>
                <form action="#" method="post" id="editform">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission</label>
                            <input type="text" class="form-control" name="permission" id="permission" required>
                        </div>
                        <div class="form-group">
                            <label for="">Permission Grup</label>
                            <input type="text" class="form-control" name="permission_grub" id="permission_grub">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-dark">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-exel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Export Excel</h4>
                </div>
                a
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        var authUserCanEditPermission = @json(auth()->user()->can('edit-permission'));
        var authUserCanDeletePermission = @json(auth()->user()->can('delete-permission'));
    </script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@push('js_in')
    <script src="{{ asset('assets/customjs/permission/permission.js') }}"></script>
@endpush
