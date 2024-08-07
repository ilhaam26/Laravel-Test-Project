@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('template_title')
    Roles
@endsection

@section('content')
    <div class="content">
        <div class="container-fluit">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-dark" >
                        <div class="card-header card-dark" >
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{ url('roles/' . $role->id) }}">
                            <input type="hidden" name="_method" value="put">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role Name</label>
                                    <input type="text" class="form-control" value="{{ $role->name }}" name="nama"
                                        required autofocus>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Select Permission</label>
                                        <hr>
                                    </div>
                                    @foreach ($permission as $row_data_permission)
                                        <div class="col-md-3">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">{{ $row_data_permission->permission_grub }}</h3>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $data_detail_permission = DB::table('permissions')
                                                            ->where('permission_grub', $row_data_permission->permission_grub)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($data_detail_permission as $row_detail_permission)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox"
                                                                    name="permission[]"
                                                                    @foreach ($rolePermissions as $row_rolePermissions)
                                                @if ($row_detail_permission->id == $row_rolePermissions->permission_id)
                                            checked
                                            @endif @endforeach
                                                                    id="customCheckbox{{ $row_detail_permission->id }}"
                                                                    value="{{ $row_detail_permission->id }}">
                                                                <label for="customCheckbox{{ $row_detail_permission->id }}"
                                                                    class="custom-control-label">{{ $row_detail_permission->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox"
                                            @if (count($permission) == count($rolePermissions)) checked @endif id="checkall">
                                        <label for="checkall" class="custom-control-label">Select All</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-secondary">Back</button>
                                <button type="submit" class="btn btn-dark float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@push('js_in')
    <script>
        $('#checkall').on('click', function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
